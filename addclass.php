<?php
	include 'core/init.php';
	
if (isset($_POST['addclass'])) {
	$classname = $_POST['classname'];

	if($class->checkClass($classname)){
		$error = "Already Exists Class: ".$classname;
	}
	else{
		$class->insertNewClass($classname);
		header('Location:listsubject.php?classname='.$classname);
		exit();
	}
}

?>
<title>Add Class</title>
<?php include 'includes/header.php';?>

<div class="container">
	<div class="row">
		<?php include 'includes/classlist.php';?>

		<div class="col-xs-10 col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					Add New Class
				</div>
				<div class="panel-body">
				<?php
					include 'includes/error.php';
				?>

				<form method="post">
					<div class="form-group">
						<label>Class: </label>
						<input type="text" name="classname" class="form-control" required>
					</div>
					<input type="submit" name="addclass" class="btn btn-md btn-danger btn-block" value="Add Class">
					
				</form>
				</div>
			</div>
			
		</div>
	</div>

</div>