<?php
	include 'core/init.php';
	
	if (isset($_POST['button'])) {
		if (count($student->getStudentThroughYear($_POST['classname'],$_POST['year'])) > 0) {
			header('Location:result.php?classname='.$_POST['classname'].'&year='.$_POST['year']);
			exit();
    	}
    	else{
    		$error = "No Student Found. Try Next class or Year";
    	}
		
    }
?>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<?php include 'includes/classlist.php';?>

		<div class="col-xs-10 col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Select Class and Year </h3>
				</div>
				<div class="panel-body">
					<?php
					include 'includes/error.php';
					?>
					<form method="post">
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
							<label>Exam Year:</label>
							<select name="year" class="form-control" required>
								<option></option>
								<?php
									$years = $validator->getYear();
									foreach ($years as $year) {
										echo "<option>".$year."</option>";
									}
								?>
							</select>
						</div>

						<input type="submit" name="button" class="btn btn-danger pull-right" value="Next">	
					</form>
				</div>
		</div>
			
		</div>

		<div class="col-xs-1 col-md-3" >
			
		</div>
	</div>

</div>