<?php
	include 'core/init.php';
	
$classname = $result->getStudentFromResult($_GET['resultid'])->class_name;;
$terminal = $result->getStudentFromResult($_GET['resultid'])->terminal_id;;
$year = $result->getStudentFromResult($_GET['resultid'])->year;;
$attendance = null;

//for loading value in form
if (isset($_GET['resultid'])) {
	if (!empty($_GET['resultid'])) {
		$attendance = $result->getOthersGradeDetails('attendance',$_GET['resultid']);
            
	}
	else{
		header('Location:listresult.php');
		exit();
	}
}


// for updating value education
if (isset($_POST['editattendance'])) {
	$others->updateAttendance($_POST['workday'],$_POST['absentday'],$_POST['result_id']);

	header('Location:listresult.php?classname='.$classname.'&terminal='.$terminal.'&year='.$year);	
	exit();
}

?>
<title>Edit Attendance: <?php echo $student->getStudent($result->getStudentFromResult($_GET['resultid'])->student_id)->student_name; ?></title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-xs-1 col-md-3">
			
		</div>

		<div class="col-xs-10 col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					Attendance for Class: <?php echo $result->getStudentFromResult($_GET['resultid'])->class_name; ?>
				</div>
				<div class="panel-body">
				<?php
					include 'includes/error.php';
				?>

				<form method="post">
					<input type="hidden" name="result_id" value="<?php echo $_GET['resultid'];?>">
					<div class="form-group">
						<label>Student Name: </label>
						<input type="text" name="student_name" class="form-control" readonly value="<?php echo $student->getStudent($result->getStudentFromResult($_GET['resultid'])->student_id)->student_name; ?>">
						</select>
					</div>
					<div class="form-group">
						<label>Present Days: </label>
						<input type="number" name="workday" class="form-control" required min="1" max="99" required value="<?php echo $attendance->present_day;?>">
					</div>

					<div class="form-group">
						<label>Absent Days: </label>
						<input type="number" name="absentday" class="form-control" required min="1" max="99" required value="<?php echo $attendance->absent_day;?>">
					</div>
					

					<input type="submit" name="editattendance" class="btn btn-md btn-danger btn-block" value="Edit Attendance for <?php echo $student->getStudent($result->getStudentFromResult($_GET['resultid'])->student_id)->student_name; ?> ">
					
				</form>
				</div>
			</div>
			
		</div>
	</div>

</div>