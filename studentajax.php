<?php
	include 'core/init.php';

	$type = $_POST['type'];
	$student_id = $_POST['id'];
	if ($type == "year") {
		if (empty($student_id)) {
			return "";
		}
		else{
		// $classname =$_GET['classname'];
		$students = $student->getStudent($student_id);

		$studentN = $students->student_name;
		
		// return $studentId.'-'.$roll_no.'-'.$curr_year;
		echo $studentN;
		}

	}
	
?>