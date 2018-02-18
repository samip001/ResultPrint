<?php

	include 'core/init.php';


$classname = $result->getStudentFromResult($_GET['resultid'])->class_name;;
$terminal = $result->getStudentFromResult($_GET['resultid'])->terminal_id;;
$year = $result->getStudentFromResult($_GET['resultid'])->year;;
$creative = null;

//for loading value in form
if (isset($_GET['resultid'])) {
	if (!empty($_GET['resultid'])) {
		$creative = $result->getOthersGradeDetails('creativity',$_GET['resultid']);
            
	}
	else{
		header('Location:listresult.php');
		exit();
	}
}

// for updating value education
if (isset($_POST['editcreative'])) {
	$others->updateCreativity($_POST['drawing'],$_POST['handwriting'],$_POST['dance'],$_POST['music'],$_POST['result_id']);

	header('Location:listresult.php?classname='.$classname.'&terminal='.$terminal.'&year='.$year);	
	exit();
	
}
?>
<title>Edit Cretive: <?php echo $student->getStudent($result->getStudentFromResult($_GET['resultid'])->student_id)->student_name; ?></title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-xs-1 col-md-3">
			
		</div>

		<div class="col-xs-10 col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Creativity for Class: <?php echo $result->getStudentFromResult($_GET['resultid'])->class_name; ?></h3>
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
						<label>Drawing: </label>
						<input type="text" name="drawing" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $creative->drawing;?>">
					</div>

					<div class="form-group">
						<label>Handwriting: </label>
						<input type="text" name="handwriting" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $creative->handwriting;?>">
					</div>

					<div class="form-group">
						<label>Dance: </label>
						<input type="text" name="dance" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $creative->dance;?>">
					</div>

					<div class="form-group">
						<label>Music/Vocal: </label>
						<input type="text" name="music" class="form-control" pattern="[A-E]{1}" title="Only A To E Value Accepted" required value="<?php echo $creative->music;?>">
					</div>
					

					<input type="submit" name="editcreative" class="btn btn-md btn-danger btn-block" value="Creativity for <?php echo $student->getStudent($result->getStudentFromResult($_GET['resultid'])->student_id)->student_name; ?> ">
					
				</form>
				</div>
			</div>
			
		</div>
	</div>

</div>