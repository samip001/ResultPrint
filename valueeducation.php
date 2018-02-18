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

if (isset($_POST['valueeducation'])) {
	if($others->checkSameResult('value_education',$_POST['resultid']) > 0){
		$error = "Same Result for Attendace Already Exists. Try Next One";
	}else{
		$fields = array('result_id' =>$_POST['resultid'],'discipline'=>$_POST['discipline'],'punctuality'=>$_POST['punctual'],'communication_skill'=>$_POST['communication'],'cleanliness'=>$_POST['cleanliness'],'sports'=>$_POST['sports'] ,'interpersonal'=>$_POST['interpersonal'],'verbal'=>$_POST['verbal'],'creativity'=>$_POST['creativity'],'assignment'=>$_POST['assignment'],'motivation'=>$_POST['motivation']);
		$others->saveStudentOthersResult('value_education',$fields);

		header('Location:listresult.php?classname='.$classname.'&terminal='.$terminal.'&year='.$year);	
		exit();
	}
}

?>
<title>Value Education for <?php if(isset($_GET['classname'])){echo("Class ".$_GET['classname']);
						} ?></title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-xs-1 col-md-3">
			
		</div>

		<div class="col-xs-10 col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					Education for Class: <?php if(isset($_GET['classname'])){echo($_GET['classname']);
						} ?>
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

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Discipline: </label>
								<input type="text" name="discipline" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Punctuality: </label>
								<input type="text" name="punctual" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Communication Skill: </label>
								<input type="text" name="communication" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Cleanliness & Smartness: </label>
								<input type="text" name="cleanliness" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Assignment Attempt: </label>
								<input type="text" name="assignment" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Interpersonal Skill: </label>
								<input type="text" name="interpersonal" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Motivation: </label>
								<input type="text" name="motivation" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Sports / ECA: </label>
								<input type="text" name="sports" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Verbal-Linguistic Skill: </label>
								<input type="text" name="verbal" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Creativity in Performance: </label>
								<input type="text" name="creativity" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required>
							</div>
						</div>
					</div>

					<input type="submit" name="valueeducation" class="btn btn-md btn-danger btn-block" value="Value Education for <?php if(isset($_GET['classname'])){echo($_GET['classname']);
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