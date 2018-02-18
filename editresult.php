<?php
	include 'core/init.php';
$id=null;
$subjectid = null;
$resultid = null;

$subjects = null;
$results = null;

//for redirecting afer sucess
$classname = $result->getStudentFromResult($_GET['resultid'])->class_name;
$terminal = $result->getStudentFromResult($_GET['resultid'])->terminal_id;
$year = $result->getStudentFromResult($_GET['resultid'])->year;


// for loading value in form
if(isset($_GET['id']) && isset($_GET['subjectid']) && isset($_GET['resultid'])){
	if (!empty($_GET['id']) && !empty($_GET['subjectid']) &&!empty($_GET['id'])) {
		$id = $_GET['id'];
		$subjectid =  $_GET['subjectid'];
		$resultid = $_GET['resultid'];
		$subjects =  $subject->getSubjectDetails($subjectid);
		$results= $result->getDetailsSubjectResult($id); 
	}
	else{
		header('Location:listresult.php');
		exit();
	}
}


// for updating value
if (isset($_POST['updateresult'])) {
	$subjectTotal = $subjects->total_mark;
	$theoryTotal = $subjects->theory_mark;
	$practicalTotal = $subjects->practical_mark;
	$thoeryGainMark = 0;
	$praticalGainMark = 0;
	$total = 0;
	$thGainGpa = " ";
	$prGainGpa = " ";

	//getting value from form for thoery marks
	$thoeryGainMark = $_POST['theorymark'];
	if ($validator->checkGainMarks($thoeryGainMark)) {
		$thGainGpa =  $validator->calculateGrading($theoryTotal,$thoeryGainMark);
		$total = $thoeryGainMark;
	}
	
	// pratical marks from form
	if($subjects->practical){
		$praticalGainMark= $_POST['practicalmark'];
			
		if ($validator->checkGainMarks($praticalGainMark)) {
			$prGainGpa =  $validator->calculateGrading($practicalTotal,$praticalGainMark);
			$total = $total + $praticalGainMark;
		}
	}

	$totalGpa =$validator->calculateGrading($subjectTotal,$total);

	//update here;
	$others->updateStudentResult($thoeryGainMark,$thGainGpa,$praticalGainMark,$prGainGpa,$total,$totalGpa,$id,$resultid,$subjectid);

	header('Location:print.php?result='.$resultid);
	exit();
}

?>
<title>Edit Result: <?php echo $student->getStudent($result->getStudentFromResult($_GET['resultid'])->student_id)->student_name; ?></title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-xs-1 col-md-3">
			
		</div>

		<div class="col-xs-10 col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Edit Result of : <?php echo $subjects->subject_name;?></h3>
				</div>
				<div class="panel-body">
				<?php
					include 'includes/error.php';
				?>
				<form method="POST">
					<input type="hidden" name="result_id" value="<?php echo $_GET['resultid'];?>">
					<div class="form-group">
						<label>Student Name: </label>
						<input type="text" name="student_name" class="form-control" readonly value="<?php echo $student->getStudent($result->getStudentFromResult($_GET['resultid'])->student_id)->student_name; ?>">
					</div>
					<div class="form-group">
						<label>Subject Name: </label>
						<input type="text" name="subject_name" class="form-control" readonly value="<?php echo $subjects->subject_name;?>">
						
					</div>

					<div class="form-group">
						<label>Thoery Marks: </label>
						<input type="text" name="theorymark" class="form-control" value="<?php echo $results->theory_mark;?>" placeholder ="Previous Thoery Marks: <?php echo $results->theory_mark;?>" required pattern="[APT0-9*]{1,3}" title="Enter *A, *P, *T or Number.">
						
					</div>

					<?php
						if ($subjects->practical == 1 ) {
							echo '<div class="form-group">
									<label>Practical Marks: </label>
									<input type="text" name="practicalmark" class="form-control" value="'.$results->practical_mark.'" placeholder ="Previous Practical Marks: '.$results->practical_mark.'" required pattern="[APT0-9*]{1,3}" title="Enter *A, *P, *T or Number.">
								</div>';
				
					}
					?>
					<input type="submit" name="updateresult" class="btn btn-md btn-danger btn-block" value="Update Marks of <?php echo $subjects->subject_name;?>">


				</form>
				
				</div>
			</div>
			
		</div>
	</div>

</div>