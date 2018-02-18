<?php
	include 'core/init.php';
	
	if (isset($_POST['button'])) {

		if($result->checkSameStudentResult($_POST['studentid'],$_POST['class'],$_POST['terminal']) == 0){
			//insert into result and get last inserted row
			$fields = array('student_id' =>$_POST['studentid'],
							'class_name'=>$_POST['class'],
							'terminal_id'=>$_POST['terminal'],
							'year'=>$_POST['examyear']);

			//for getting result id based on last inserted
			$resultId = $result->insertResult('result',$fields);
			// $resultId=1;
			//for M:M relation between Result and Subject
			$subjects = $subject->getSubjects($_POST['class']);
			
			foreach ($subjects as $sub) {
				//for declaring 0 in both 
				$theorMarks = 0;
				$pracMarks =0;
				$thgpa = ' ';
				$prgpa = ' ';
				$total = 0;

				//getting value from form for thoery marks
				$theorMarks =$_POST[$sub->subject_slug.'th'];
				if ($validator->checkGainMarks($theorMarks)) {
					$thgpa =  $validator->calculateGrading($sub->theory_mark,$theorMarks);
					$total = $theorMarks;
				}

				// pratical marks
				if($sub->practical){
					$pracMarks = $_POST[$sub->subject_slug.'pr'];
					if ($validator->checkGainMarks($pracMarks)) {
						$prgpa =  $validator->calculateGrading($sub->practical_mark,$pracMarks);
						$total = $total + $pracMarks;
					}
				}
				
				$totalgpa =$validator->calculateGrading($sub->total_mark,$total);
				
				// echo($sub->theory_mark."<<Total>>>>>Th Marks: ".$theorMarks." TheorGPA".$thgpa)."<br>";
				// echo($sub->practical_mark."<<Total>>>>>Pr Marks:".$pracMarks." PracGPA".$prgpa)."<br>";
				// echo"Total is ".$total."Total Gpa".($totalgpa)."<br>";
				
				//inserting into student_subject with refrence result id
				$studetresultfields = array('result_id' => intval($resultId),'subject_id'=>intval($sub->subject_id),'theory_mark'=>$theorMarks,'th_gpa'=>$thgpa,'practical_mark'=>$pracMarks,'pr_gpa'=>$prgpa,'total'=>intval($total),'total_gpa'=>$totalgpa );

				// var_dump($studetresultfields);
				$result->saveStudentResult('student_result',$studetresultfields);
				$studetresultfields = null;
				
			}
			
			header('Location:print.php?result='.$resultId);
			exit();	
		}
		else{
			// for displaying error
			$error = $terminal->getTerminalName($_POST['terminal'])." Result already exist of ".$student->getStudent($_POST['studentid'])->student_name.".<br> Select Valid Student or Terminal Type.";
		}
		
	}
?>
<title>Result <?php if(isset($_GET['classname'])){echo 'Class '.$_GET['classname'];}?></title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-xs-1 col-md-3"></div>

		<div class="col-xs-10 col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php 
						if(isset($_GET['classname'])){
							echo "<h4>Class: ".$_GET['classname']."</h4>";	
						}
					?>
				</div>
				
				<div class="panel-body">
					<?php
						include 'includes/error.php';
					?>
					<form method="post">
						<div class="form-group">
							<label>Student Name: </label>
							<select name="studentid" id="studentname" class="form-control" required>
								<option></option>
								<?php
									$students = $student->getStudents($_GET['classname']);
									foreach ($students as $student) {
										echo "<option value='$student->id'>".$student->student_name."</option>";	
									}
								?>
							</select>
						</div>

						<div class="form-group">
							<label>Class: </label>
							<input type="text" name="class" class="form-control" required readonly
								value="<?php echo $_GET['classname'];?>" 
							>
						</div>

						<div class="form-group">
							<label>Exam Date Year: </label>
							<input type="text" name="examyear" class="form-control examyear" required readonly value="<?php echo $_GET['year'];?>">
						</div>

						<div class="form-group">
							<label>Terminal Type: </label>
							<select name="terminal" class="form-control" required>
								<option></option>
								<?php
									$terminalType = $terminal->getAllTerminal();
									foreach ($terminalType as $terminals) {
										echo "<option value='$terminals->terminal_id'>".$terminals->terminal_name."</option>";
									}
								?>
							</select>
						</div>

						<div class="form-group">
						<?php
							if($subjects = $subject->getSubjects($_GET['classname'])){
								$i=1;
								foreach ($subjects as $sub) {
									$practical = $sub->practical;
									$column = "col-md-12";
									if ($practical) {
										$column = "col-md-6";
									}
									echo "<label>".$sub->subject_name."</label>";
									echo '<div class="row">';
									echo '<div class="'.$column.'">';
									echo '<input type="text" id="th'.$i.'" name="'.$sub->subject_slug.'th" class="form-control ontheoryleave" placeholder="Theory Marks Valid between 1 to '.$sub->theory_mark.'" required pattern="[AT0-9*]{1,3}" title="Enter *A,*T or Number."><br>';
									echo '</div>';
									if($sub->practical){
									echo '<div class="'.$column.'">';
									echo '<input type="text" id="pr'.$i.'" name="'.$sub->subject_slug.'pr" class="form-control" placeholder="Practical Marks Valid between 1 to '.$sub->practical_mark.'" required pattern="[AP0-9*]{1,2}" title="PLease Enter *A,*P or Numbers."><br>';
									echo '</div>';
									}
									echo '</div>';
									$i++;
								}
								echo '<div>
										<input type="submit" name="button" class="btn btn-danger btn-block" value="Get Result">
									</div>';
							}
							else{
								echo '<div class="badge form-group">
										<label class="badge">No Subject Available.</label>
										<a href="addsubject.php" class="btn btn-xs btn-warning">Add Subject</a>
										</div>';
							}
						?>
						</div>
					</form>
				</div>
		</div>
			
		</div>

	</div>

</div>