<?php

	include 'core/init.php';
	

$students = null;
$stud =NULL;

	if(isset($_GET['classname'])){
		$stud = $student->getStudents($_GET['classname']);
		$students = $student->getStudentThroughYear($_GET['classname'],$_GET['year']);
	}	
	
	if(isset($_GET['selectclass'])){
		header('Location:liststudent.php?classname='.$_GET['classname'].'&year='.$_GET['year']);
		exit();
	}

	if(isset(($_GET['command']))){
		$classname = $_GET['classname'];
		$id = $_GET['id'];
		
		if ($_GET['command'] == 'UPGRADE') {
			$classlist = array();
			$classes = $class->getAllClasses();
			$i=0;
			foreach ($classes as $class) {
				$classlist[$i] = $class->class_name;
				$i++;
			}

			$year = $_GET['year'];

			$upgradeClass = $validator->upgradeClass($classlist,$classname);
			$upgradeYear = $validator->upgradeYear($validator->getYear(),$year);
			if($upgradeYear != null || !$upgradeClass != null){
					$student->upgradeStudent($upgradeClass,$upgradeYear,$id);
				header('Location:liststudent.php?classname='.$upgradeClass.'&year='.$upgradeYear);
				exit();
			}
			else{
				$error = "Upgrade is Unavailable";
				header('Location:liststudent.php?classname='.$classname.'&year='.$year);
				exit();
			}
		}

		if ($_GET['command'] == 'UPGRADEALL') {
			$year = $_GET['year'];

			$classlist = array();
			$classes = $class->getAllClasses();
			$i=0;
			foreach ($classes as $class) {
				$classlist[$i] = $class->class_name;
				$i++;
			}

			foreach ($students as $stlist) {
				$upgradeClass = $validator->upgradeClass($classlist,$stlist->class_name);
				$upgradeYear = $validator->upgradeYear($validator->getYear(),$stlist->current_year);
				if($upgradeYear != null || !$upgradeClass != null){
					$student->upgradeStudent($upgradeClass,$upgradeYear,$stlist->id);
				}
			}

			header('Location:liststudent.php?classname='.$classname.'&year='.$year);
			exit();
		}

		if ($_GET['command'] == 'EDIT') {
			header('Location:editstudent.php?classname='.$classname.'&id='.$id);
			exit();
		}


		if ($_GET['command'] == 'DELETE') {
			$year = $_GET['year'];
			$student->deleteStident($_GET['id']);
			header('Location:liststudent.php?classname='.$classname.'&year='.$year);
			exit();
		}
	}

?>
<title>Student List: <?php if(isset($_GET['classname'])){echo 'Class '.$_GET['classname'];} else{echo "Class Not Found";}?></title>
<?php include 'includes/header.php';?>

<div class="container">
	<?php include 'includes/classlist.php';?>

	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php 
				if(isset($_GET['classname']))
					echo 'Student List of Class: '.$_GET['classname'];
				else
					echo "Select Class"
				?>
				<div class="pull-right">
					<form method="get">
						<label>Class: </label>
						<select name="classname" required>
							<option></option>
							<?php
								// call from classlist.php
								//$classes = $class->getAllClasses();
								foreach ($classes as $class) {
									echo "<option>".$class->class_name."</option>";
								}
							?>
						</select>
						<label>Year:</label>
							<select name="year" required>
								<option></option>
								<?php
									$years = $validator->getYear();
									foreach ($years as $year) {
										echo "<option>".$year."</option>";
									}
								?>
							</select>

						<input type="submit" name="selectclass" class="btn btn-xs btn-danger" value="Show">
					</form>
				</div>
			</div>

			

			<div class="panel-body">
				<table class="table table-hover">
					<thead>
						<th>S/N</th>
						<th>Student Name</th>
						<th>Roll No</th>
						<th>Current Year</th>
						<th>Class Upgrade</th>
						<th>Edit</th>
						<th>Delete</th>	
					</thead>
					<tbody>
						<?php
						if(isset($_GET['classname'])){
							if($students){
								$i=1;
								foreach ($students as $student) {
									echo '<tr>
											<td>'.$i.'.</td>
											<td>'.$student->student_name.'</td>
											<td>'.$student->roll_no.'</td>
											<td>'.$student->current_year.'</td>
											<td><a href="liststudent.php?command=UPGRADE&classname='.$_GET['classname'].'&id='.$student->id.'&year='.$_GET['year'].'"><span class="glyphicon glyphicon-circle-arrow-up"></span></td>
											<td><a href="liststudent.php?command=EDIT&classname='.$_GET['classname'].'&id='.$student->id.'"><span class="glyphicon glyphicon-pencil"></span></td>
											<td><a href="liststudent.php?command=DELETE&classname='.$_GET['classname'].'&id='.$student->id.'&year='.$_GET['year'].'"><span class="glyphicon glyphicon-trash" style="color:red"></span></td>
										</tr>';
										$i++;
								}

							}
							else{
								echo '<tr><td colspan="7" class="text-danger">Student Not Found</td></tr>';
							}
						}
						else{
							echo '<tr><td colspan="7" class="text-danger">Select Class and Year</td></tr>';
						}
						
						?>
					</tbody>
				</table>
			</div>

			<div class="panel-footer">
				<?php
					if(isset($_GET['classname']) && isset($_GET['year'])){
						if (!empty($_GET['classname']) && !empty($_GET['year'])) {
							echo '<a href="result.php?classname='.$_GET['classname'].'&year='.$_GET['year'].'" class="btn btn-sm btn-danger" style="margin-right: 5px;">Create Result</a>';
						}
					}

					if($stud){
						echo '<a href="liststudent.php?command=UPGRADEALL&classname='.$_GET['classname'].'&year='.$_GET['year'].'" class="btn btn-sm btn-danger">Upgrade Whole Student</a>';
					}
				?>
				<a href="addstudent.php" class="btn btn-sm btn-danger">Add New Student</a>
			</div>
		</div>
	</div>
	
</div>
