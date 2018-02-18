<?php

	include 'core/init.php';
	
	$sub = null; 

	//for updating
	if (isset($_POST['updatesubject'])) {
		$id = $_POST['subjectid'];
		$subjectname =$_POST['subjectname'];
		$classname = $_POST['class'];
		$practical = ($validator->checkPractical($_POST['practical']));
		$thoerymarks = intval($_POST['thoerymarks']);
		$practicalmarks =intval($_POST['practicalmarks']);
		$totalmarks = intval($_POST['totalmarks']);
		$credit = intval($_POST['credithr']);

		// echo $id." ".$subjectname." ".$classname." ".$practical." ".$thoerymarks." ".$practicalmarks." ".$totalmarks." ".$credit;

		if($totalmarks == 100 || $totalmarks == 50){
			if($subject->updateSubject($id,$subjectname,$classname,$practical,$thoerymarks,$practicalmarks,$totalmarks,$credit)){
				
				header('Location:listsubject.php?classname='.$classname);
				exit();
			}
			else{
				$error= "Please Try Again With Valid Information!!";
			}
		}
		else{
			$error = "Unacceptable Theory and Practical Marks";
		}
	}	
	
	//for loading value in form
	if(!empty($_GET['classname'] && !empty($_GET['id']))){
		$id= intval($_GET['id']);
		$sub = $subject->editSubject($_GET['classname'],$id);
	}


?>
<title>Update Subject: <?php echo $sub->subject_name.' for Class '. $sub->class_name; ?></title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-xs-1 col-md-3">
			
		</div>

		<div class="col-xs-10 col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Update Subject: <?php echo $sub->subject_name.' for Class '. $sub->class_name; ?></h4>
				</div>
				<div class="panel-body">
				<?php
					include 'includes/error.php';
				?>

				<form method="post">
					<div class="form-group">
						<input type="hidden" name="subjectid" value="<?php echo $sub->subject_id; ?>">
						<label>Subject Name: </label>
						<input type="text" name="subjectname" class="form-control" value ="<?php echo $sub->subject_name; ?>" required>
					</div>

					<div class="form-group">
							<label>Class: </label>
							<select name="class" class="form-control" required>
								<option></option>
								<?php
									$classes = $class->getAllClasses();
									foreach ($classes as $class) {
										echo "<option value='$class->class_name'>".$class->class_name."</option>";
									}
								?>
							</select>
						</div>

					<div class="form-group">
						<label>Practical: </label>
						<select name="practical" id="prac" class="form-control" required>
							<option></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Thoery Marks: </label>
								<input type="text" name="thoerymarks" class="form-control marks" id="th" required value="<?php echo $sub->theory_mark; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" id="pracMarks" style="<?php if (!$sub->practical) {
								echo "display: none;";
							}?>">
								<label>Practical Marks: </label>
								<input type="number" name="practicalmarks" class="form-control marks" id="pr" required max="50" min="0" value="<?php echo $sub->practical_mark; ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>Total Marks:</label>
						<input type="number" id="ttm" name="totalmarks" class="form-control" required readonly value="<?php echo $sub->total_mark; ?>">		
					</div>


					<div class="form-group">
						<label>Credit Hrs:</label>
						<input type="number" name="credithr" class="form-control" max="4" min="1" required value="<?php echo $sub->credit_hrs; ?>">
					</div>

					<div class="row">
							<div class="col-md-4">
							</div>
							<div class="col-md-6">
								<input type="submit" name="updatesubject" class="btn btn-danger" value="Update Subject">
							</div>
							<div class="col-md-2">
							</div>
					</div>
				</form>
				</div>
			</div>
			
		</div>
	</div>

</div>