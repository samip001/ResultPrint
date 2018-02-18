<?php

	include 'core/init.php';
	
	if(isset($_POST['addsubject'])){
		$subjectname = $_POST['subjectname'];
		$classname = $_POST['classname'];
		$practical = ($validator->checkPractical($_POST['practical']));
		$thoerymarks = intval($_POST['thoerymarks']);
		$practicalmarks =intval($_POST['practicalmarks']);
		$totalmarks = intval($_POST['totalmarks']);
		$credit = intval($_POST['credithr']);

		if($totalmarks == 100 || $totalmarks == 50){
			//CHECK REPEAT OF SUBJECT AND CLASS
			if($subject->checkSubjectandClass($subjectname,$classname)){
				$error = $subjectname." Subject For Class ".$classname." is Already Exist.";
			}
			else{
				//INSERTING SUBJECT IF NO REPEAT SUBJECT FOUND
			$fields = array('subject_name' => $subjectname,'subject_slug'=>$validator->getSlug($subjectname),'class_name'=>$classname,'practical'=>$practical,'theory_mark'=>$thoerymarks,'practical_mark'=>$practicalmarks,'total_mark'=>$totalmarks,'credit_hrs'=>$credit);
			
			$subject->insertSubjectDetails('subject',$fields);
    		
    		header('Location:listsubject.php?classname='.$classname);
    		exit();
	        		
			}	
		}
		else{
			$error = "Unacceptable Theory and Practical Marks";
		}
	}
?>
<title>Add Subject</title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<?php include 'includes/classlist.php';?>

		<div class="col-xs-10 col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading">
					Add New Subject
				</div>
				<div class="panel-body">
				<?php
					include 'includes/error.php';
				?>

				<form method="post">
					<div class="form-group">
						<label>Subject Name: </label>
						<input type="text" name="subjectname" class="form-control" required>
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
								<input type="text" name="thoerymarks" class="form-control marks" id="th" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" id="pracMarks" style="display: none;">
								<label>Practical Marks: </label>
								<input type="number" name="practicalmarks" class="form-control marks" id="pr" required max="50" min="0">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>Total Marks:</label>
						<input type="number" id="ttm" name="totalmarks" class="form-control" required readonly>		
					</div>

					<div class="form-group">
						<label>Credit Hrs:</label>
						<input type="number" name="credithr" class="form-control" max="4" min="1" required>
					</div>

					<div class="row">
							<div class="col-md-4">
							</div>
							<div class="col-md-6">
								<input type="submit" name="addsubject" class="btn btn-danger" value="Add Subject">
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