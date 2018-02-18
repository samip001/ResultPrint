<?php
	include 'core/init.php';
	
	$stud = null; 

	//for updating
	if (isset($_POST['updatestudent'])) {
		$id = $_POST['studentid'];
		$studentname =$_POST['studentname'];
		$classname = $_POST['class'];
		$rollno = intval($_POST['rollno']);
		$section = $_POST['section']; 
		$year = $_POST['year'];

		if ($student->checkClassStudentRollNo($classname,$rollno,$section)) {
			$error = 'Rollnumber '.$rollno.' in Section '.$section.'Already exists';
		}
		else{
			if($student->updateStudent($id,$studentname,$classname,$rollno,$section,$year)){
			header('Location:liststudent.php?classname='.$classname.'&year='.$year);
			exit();
			}
			else{
				$error= "Please Try Again With Valid Information!!";
			}
		}
		
	}

	//for loading value in form
	if(!empty($_GET['classname'] && !empty($_GET['id']))){
		$id= intval($_GET['id']);
		$stud = $student->editStudent($_GET['classname'],$id);
	}
?>
<title>EDIT Student: <?php echo "$stud->student_name"; ?></title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-xs-1 col-md-3">
			
		</div>

		<div class="col-xs-10 col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
						<h4>Edit Student : <?php echo "$stud->student_name"; ?></h4>
				</div>
				<div class="panel-body">
					<?php
					include 'includes/error.php';
					?>
					<form method="post">
						<div class="form-group">
							<input type="hidden" name="studentid" value="<?php echo "$stud->id"; ?>">
							<label>Student Name: </label>
							<input type="text" name="studentname" class="form-control" required value="<?php echo "$stud->student_name"; ?>">
						</div>

						<div class="form-group">
							<label>Class: </label>
							<input type="text" name="class" class="form-control" readonly value="<?php echo "$stud->class_name"; ?>">
						</div>

						<div class="form-group">
							<label>Roll No: </label>
							<input type="number" name="rollno" class="form-control" min="1" max="100" value="<?php echo "$stud->roll_no"; ?>" required>
						</div>

						<div class="form-group">
							<label>Section: </label>
							<input type="text" name="section" class="form-control" required pattern="[A-E]{1}" title="Only A To E Value Accepted" value="<?php echo "$stud->section"; ?>">
						</div>
						
						<div class="form-group">
							<label>Current Year:</label>
							<select name="year" class="form-control" required>
								<option><?php echo 	$stud->current_year;?></option>
								<?php
									$years = $validator->getYear();
									foreach ($years as $year) {
										if ($year !== $stud->current_year) {
											echo "<option>".$year."</option>";	
										}
									}
								?>
							</select>
						</div>

						<div class="row">
								<div class="col-md-3">
								</div>
								<div class="col-md-5">
									<input type="submit" name="updatestudent" class="btn btn-danger" value="Update Student Details">
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