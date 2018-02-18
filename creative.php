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

if (isset($_POST['creative'])) {
	$resultid = $_POST['resultid'];
	if($others->checkSameResult('creativity',$_POST['resultid']) > 0){
		$error = "Same Result for Creativity Already Exists. Try Next Student";
	}
	else{
		$fields = array('result_id' =>$_POST['resultid'],'drawing'=>$_POST['drawing'],'handwriting'=>$_POST['handwriting'],'dance'=>$_POST['dance'],'music'=>$_POST['music'] );
		$others->saveStudentOthersResult('creativity',$fields);

		header('Location:print.php?result='.$resultid);
		exit();	
	}
}

?>
<title>Add Class</title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-xs-1 col-md-3">
			
		</div>

		<div class="col-xs-10 col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Creativity for Class: <?php if(isset($_GET['classname'])){echo($_GET['classname']);
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
						<label>Drawing: </label>
						<input type="text" name="drawing" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
					</div>

					<div class="form-group">
						<label>Handwriting: </label>
						<input type="text" name="handwriting" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
					</div>

					<div class="form-group">
						<label>Dance: </label>
						<input type="text" name="dance" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
					</div>

					<div class="form-group">
						<label>Music/Vocal: </label>
						<input type="text" name="music" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
					</div>
					

					<input type="submit" name="creative" class="btn btn-md btn-danger btn-block" value="Creativity for <?php if(isset($_GET['classname'])){echo($_GET['classname']);
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