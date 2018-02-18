<?php

	include 'core/init.php';
	
	if(isset($_GET['selectclass']) && !empty($_GET['classname'])){
		header('Location:listsubject.php?classname='.$_GET['classname']);
		exit();
	}

	
	if(isset($_GET['command'])){
		$classname =$_GET['classname'];
		$id = $_GET['id'];
		if($_GET['command'] == 'DELETE'){
			$subject->deleteSubject(intval($_GET['id']))	;
			header('Location:listsubject.php?classname='.$classname);
			exit();

		}
		if($_GET['command'] == 'EDIT'){
			header('Location:editsubject.php?classname='.$classname.'&id='.$id);
			exit();
		}

	}
?>
<title>Subject List: <?php if(isset($_GET['classname'])){echo 'Class '.$_GET['classname'];} else{echo "Class Not Found";}?></title>
<?php include 'includes/header.php';?>
<div class="container">
	<div class="row">
		<?php include 'includes/classlist.php';?>

		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php 
					if(isset($_GET['classname']))
						echo 'Subject List of Class: '.$_GET['classname'];
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
											echo "<option value='$class->class_name'>".$class->class_name."</option>";
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
							<th>Subject Name</th>
							<th>Total Marks</th>
							<th>Practical</th>
							<th>Credit Hrs</th>
							<th>Edit</th>
							<th>Delete</th>	
						</thead>
						<tbody>
							<?php
							if(isset($_GET['classname'])){
								if($subjects = $subject->getSubjects($_GET['classname'])){
									$i=1;
									foreach ($subjects as $subject) {
										echo '<tr>
												<td>'.$i.'.</td>
												<td>'.$subject->subject_name.'</td>
												<td>'.$subject->total_mark.'</td>
												<td>'.$validator->numberToAlphaPractical($subject->practical).'</td>
												<td>'.$subject->credit_hrs.'</td>
												<td><a href="listsubject.php?classname='.$_GET['classname'].'&command=EDIT&id='.$subject->subject_id.'"><span class="glyphicon glyphicon-pencil"></span></td>
												<td><a href="listsubject.php?classname='.$_GET['classname'].'&command=DELETE&id='.$subject->subject_id.'"><span class="glyphicon glyphicon-trash" style="color: red"></span></td>
											</tr>';
											$i++;
									}
								}
								else{
									echo '<tr><td colspan="7" class="text-danger">No Subject Found</td></tr>';
								}
							}
							else
								echo '<tr><td colspan="7" class="text-danger">Class not Selected</td></tr>';
							
							?>
						</tbody>
					</table>
				</div>

				<div class="panel-footer">
					<a href="addsubject.php" class="btn btn-sm btn-danger">Add New Subject</a>
				</div>
			</div>
		</div>
	</div>
</div>
