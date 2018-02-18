<?php
	include 'core/init.php';

$classname = $result->getStudentFromResult($_GET['resultid'])->class_name;;
$terminal = $result->getStudentFromResult($_GET['resultid'])->terminal_id;;
$year = $result->getStudentFromResult($_GET['resultid'])->year;;
$valueedu = null;

//for loading value in form
if (isset($_GET['resultid'])) {
	if (!empty($_GET['resultid'])) {
		$valueedu = $result->getOthersGradeDetails('value_education',$_GET['resultid']);
            
	}
	else{
		header('Location:listresult.php');
		exit();
	}
}


//for updating value education
if (isset($_POST['editvalueeducation'])) {
	$others->updateValueEducation($_POST['discipline'],$_POST['punctual'],$_POST['communication'],$_POST['cleanliness'],$_POST['sports'],$_POST['interpersonal'],$_POST['verbal'],$_POST['creativity'],$_POST['assignment'],$_POST['motivation'],$_POST['result_id']);

	header('Location:listresult.php?classname='.$classname.'&terminal='.$terminal.'&year='.$year);	
	exit();
	
}

?>
<title><?php echo $student->getStudent($result->getStudentFromResult($_GET['resultid'])->student_id)->student_name; ?>Edit Value Education</title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-xs-1 col-md-3">
			
		</div>

		<div class="col-xs-10 col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Education for Class: <?php echo $result->getStudentFromResult($_GET['resultid'])->class_name; ?></h3>
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

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Discipline: </label>
								<input type="text" name="discipline" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $valueedu->discipline;?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Punctuality: </label>
								<input type="text" name="punctual" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $valueedu->punctuality;?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Communication Skill: </label>
								<input type="text" name="communication" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $valueedu->communication_skill;?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Cleanliness & Smartness: </label>
								<input type="text" name="cleanliness" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $valueedu->cleanliness;?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Assignment Attempt: </label>
								<input type="text" name="assignment" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $valueedu->assignment;?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Interpersonal Skill: </label>
								<input type="text" name="interpersonal" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $valueedu->interpersonal;?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Motivation: </label>
								<input type="text" name="motivation" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $valueedu->motivation;?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Sports / ECA: </label>
								<input type="text" name="sports" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $valueedu->sports;?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Verbal-Linguistic Skill: </label>
								<input type="text" name="verbal" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $valueedu->verbal;?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Creativity in Performance: </label>
								<input type="text" name="creativity" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $valueedu->creativity;?>">
							</div>
						</div>
					</div>

					<input type="submit" name="editvalueeducation" class="btn btn-md btn-danger btn-block" value="Edit Value Education for <?php echo $student->getStudent($result->getStudentFromResult($_GET['resultid'])->student_id)->student_name; ?> ">
					
				</form>
				</div>
			</div>
			
		</div>
	</div>

</div>