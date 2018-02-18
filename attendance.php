<?php
	include 'core/init.php';
	
$stud = null;
$classname = null;
$terminal = null;
$year = null;
if (isset($_GET['classname']) && isset($_GET['terminal']) && isset($_GET['year']) ) {
	if(!empty($_GET['classname']) && !empty($_GET['terminal']) && !empty($_GET['year'])){
		$classname = $_GET['classname'];
		$terminal = $_GET['terminal'];
		$year = $_GET['year'];
		$stud = $result->getStudentResultForOthers($classname,$terminal,$year);
	}
	else{
		header('Location:others.php');
		exit();
	}
}
else{
	header('Location:others.php');
	exit();
}	

if (isset($_POST['attendance'])) {
	$resultid = $_POST['resultid'];
	if($others->checkSameResult('attendance',$_POST['resultid']) > 0){
		$error = "Same Result for Attendace Already Exists. Try Next One";
	}
	else{
		$fields = array('result_id' =>$_POST['resultid'],'present_day'=>$_POST['workday'],'absent_day'=>$_POST['absentday'] );
		$others->saveStudentOthersResult('attendance',$fields);

		header('Location:print.php?result='.$resultid);
		exit();	
	}
}

?>
<title>Attendance of Class: <?php echo $_GET['classname'];?></title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-xs-1 col-md-3">
			
		</div>

		<div class="col-xs-10 col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Attendance for Class: <?php if(isset($_GET['classname'])){echo($_GET['classname']);
						} ?></h3>
				</div>
				<div class="panel-body">
				<?php
					include 'includes/error.php';
				?>

				<?php
					if(count($stud) > 0){
				?>
				<form method="post">
					<div class="form-group">
						<label>Student Name: </label>
						<select name="resultid" class="form-control" required>
							<option></option>
							<?php
								foreach ($stud as $studentres) {
									echo "<option value='$studentres->result_id'>".$student->getStudent($studentres->student_id)->student_name."</option>";	
								}
							?>
						</select>
					</div>

					<div class="form-group">
						<label>Present Days: </label>
						<input type="number" name="workday" class="form-control" required min="1" max="99" required>
					</div>

					<div class="form-group">
						<label>Absent Days: </label>
						<input type="number" name="absentday" class="form-control" required min="1" max="99" required>
					</div>
					

					<input type="submit" name="attendance" class="btn btn-md btn-danger btn-block" value="Add Attendance for <?php if(isset($_GET['classname'])){echo($_GET['classname']);
						} ?>">
					
				</form>
				<?php
					}
					else{
						echo "<h3>No Student Found</h3>";
						echo '<a href="classselect.php" class="btn btn-block btn-danger">Add Student to Result</a>';
					}
				?>
				</div>
			</div>
			
		</div>
	</div>

</div>