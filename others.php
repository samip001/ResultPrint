<?php

	include 'core/init.php';

if (isset($_POST['selected'])) {
	if ($_POST['options'] == 1) {
		header('Location:valueeducation.php?classname='.$_POST['classname'].'&terminal='.$_POST['terminal'].'&year='.$_POST['year']);
		exit();
	}
	elseif ($_POST['options'] == 2) {
		header('Location:attendance.php?classname='.$_POST['classname'].'&terminal='.$_POST['terminal'].'&year='.$_POST['year']);
		exit();	
	}
	else{
		header('Location:creative.php?classname='.$_POST['classname'].'&terminal='.$_POST['terminal'].'&year='.$_POST['year']);
		exit();
	}
}

?>

<title>Others</title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="col-md-3">
		
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Others</h4>
			</div>

			<div class="panel-body">
				<form method="POST">
						<div class="form-group">
							<label>Options:</label>
							<select name="options" class="form-control" required>
								<option></option>
								<option value="1">Value Education</option>
								<option value="2">Attendance</option>
								<option value="3">Creative Section</option>
							</select>
						</div>

						<div class="form-group">
							<label>Class: </label>
							<select name="classname" class="form-control" required>
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

						<input type="submit" class="btn btn-block btn-danger" name="selected" value="Proceed" />
					</form>
			</div>
		</div>
	</div>
</div>