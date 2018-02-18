<?php

	include 'core/init.php';
	
	if(isset($_POST['register'])){
		if($student->checkStudent($_POST['classname'],$_POST['rollno'],strtoupper($_POST['section']))){
			$error='Student Already Exists in Class '.$_POST['classname'].' with Same Roll number and Section';
		}
		else{
			$column = array('student_name' =>$_POST['studentname'] ,'class_name'=>$_POST['classname'],
				 		'roll_no'=>intval($_POST['rollno']),'section'=>strtoupper($_POST['section']),'current_year'=>$_POST['year']);

			$student->insertStudent('student',$column);
			header('Location:liststudent.php?classname='.$_POST['classname'].'&year='.$_POST['year']);
			exit();
		}
	}

?>
<title>Add Student</title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<?php include 'includes/classlist.php';?>

		<div class="col-md-7 col-xs-10 ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Register Student</h3>
				</div>
				<div class="panel-body">
					<?php
					include 'includes/error.php';
					?>
					<form method="post">
						<div class="form-group">
							<label>Student Name: </label>
							<input type="text" name="studentname" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Class: </label>
							<select name="classname" class="form-control" required>
								<option></option>
								<?php
									foreach ($classes as $class) {
										echo "<option value='$class->class_name'>".$class->class_name."</option>";
									}
								?>
							</select>
						</div>

						<div class="form-group">
							<label>Roll No: </label>
							<input type="number" name="rollno" class="form-control" min="1" max="100" required>
						</div>

						<div class="form-group">
							<label>Section: </label>
							<input type="text" name="section" class="form-control" required pattern="[A-E]{1}" title="Only A To E Value Accepted" value="A">
						</div>

						<div class="form-group">
							<label>Current Year:</label>
							<select name="year" class="form-control" required>
								<option></option>
								<?php
									$years = $validator->getYear();
									foreach ($years as $year) {
										echo "<option>".$year."</option>";
									}
								?>
							</select>

						</div>

						<div class="row">
								<div class="col-md-4">
								</div>
								<div class="col-md-6">
									<input type="submit" name="register" class="btn btn-danger" value="Register Student">
								</div>
								<div class="col-md-2">
								</div>
						</div>
					</form>
				</div>
		</div>
			
		</div>

		<div class="col-xs-1 col-md-3" >
			
		</div>
	</div>

</div>