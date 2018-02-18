<?php

	include 'core/init.php';
	
	$results =NULL;
	
	if(isset($_GET['selectclass'])){
		header("Location:listresult.php?classname=".$_GET['classname']."&terminal=".$_GET['terminal']."&year=".$_GET['year']);
		exit();
	}

	if(isset(($_GET['command']))){
		if ($_GET['command'] == 'DELETE') {
			if($result->deleteResult($_GET['resultid'])){
				// header("Location:listresult.php?classname=".$_GET['classname']."&terminal=".$_GET['terminal']."&year=".$_GET['year']);
				// exit();	
				header("Location:listresult.php?classname=".$_GET['classname']."&terminal=".$_GET['terminal']."&year=".$_GET['year']);
				exit();
			}
			
		}
	}

	if(isset($_GET['classname']) && isset($_GET['terminal']) && isset($_GET['year']) ){
		$results = $result->getStudentResultForOthers($_GET['classname'],$_GET['terminal'],$_GET['year']);
	}	

?>
<title>Student Result: <?php if(isset($_GET['classname'])){echo 'Class '.$_GET['classname'];} else{echo "Class Not Found";}?></title>

<?php 
	include 'includes/header.php';
?>

<div class="container">
	<?php include 'includes/classlist.php';?>

	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php 
				if(isset($_GET['classname']))
					echo '<h4>Result Class: '.$_GET['classname'].'</h4>';
				else
					echo "<h4>Select Class, Terminal and Year to filter Result</h4>";
				?>
			</div>

			<div class="panel-body">
				<table class="table table-hover">
					<thead>
						<th>S/N</th>
						<th>Student Name</th>
						<th>Roll No</th>
						<th>Exam Terminal</th>
						<th>View</th>
						<th>Delete</th>	
					</thead>
					<tbody>
					<?php
					if(count($results) > 0){
						$i = 1;
						foreach ($results as $res) {
							echo '<tr>
									<td>'.$i.'.</td>
									<td>'.$student->getStudent($res->student_id)->student_name.'</td>
									<td>'.$student->getStudent($res->student_id)->roll_no.'</td>
									<td>'.$terminal->getTerminalName(intval($res->terminal_id)).'</td>
									<td><a href="print.php?result='.$res->result_id.'"><span class="glyphicon glyphicon-eye-open" style="color:green"></span></td>
									<td><a href="listresult.php?command=DELETE&classname='.$_GET['classname'].'&terminal='.$res->terminal_id.'&year='.$_GET['year'].'&resultid='.$res->result_id.'"><span class="glyphicon glyphicon-trash" style="color:red"></span></td>
								</tr>';
							$i++;
						}
					}
					else{
						echo '<tr>
							<td colspan="6" class="text-danger">Result Not Found. Try Filtering Student</td>
							</tr>';
					}
					?>

						
					</tbody>
				</table>
			</div>

			<div class="panel-footer">

				<div class="container">
					<h4>Filter By:</h4>
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

						<label>Terminal Type: </label>
							<select name="terminal" required>
								<option></option>
								<?php
									$terminalType = $terminal->getAllTerminal();
									foreach ($terminalType as $terminals) {
										echo "<option value='$terminals->terminal_id'>".$terminals->terminal_name."</option>";
									}
								?>
							</select>

						<label>Year: </label>
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
		</div>
	</div>
	
</div>
