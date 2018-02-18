<?php
	
	include 'core/init.php';
	
	$schoolInfo = $schoolinfo->getSchoolInfo();

	if (isset($_POST['editschool'])) {
		$schoolname = $_POST['schoolname'];
		$add = $_POST['address'];
		$cit = $_POST['city'];
		$con = $_POST['contact'];
		$ema = $_POST['email'];

		$check = $schoolinfo->updateSchoolInfo($schoolname,$add,$cit,$con,$ema);
		if ($check) {
			header('Location:schoolinfo.php');
			exit();
		}
		else{
			$error="Some Thing Gone Wrong";
		}
	}

?>



<title>Edit: <?php echo $schoolInfo->school_name;?> Details</title>
<?php include 'includes/header.php';?>
<div class="container">
	<?php include 'includes/classlist.php';?>

	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>School Info</h2>
			</div>

			<div class="panel-body">
				<?php
					include 'includes/error.php';
				?>
				<form method="post">
					<div class="form-group">
						<label>School Name: </label>
						<input type="text" name="schoolname" class="form-control" required value="<?php echo $schoolInfo->school_name; ?>">
					</div>

					<div class="form-group">
						<label>Address: </label>
						<input type="text" name="address" class="form-control" required value="<?php echo $schoolInfo->address; ?>">
					</div>

					<div class="form-group">
						<label>City: </label>
						<input type="text" name="city" class="form-control" required value="<?php echo $schoolInfo->city; ?>">
					</div>

					
					<div class="form-group">
						<label>Contact: </label>
						<input type="text" name="contact" class="form-control" required value="<?php echo $schoolInfo->contact; ?>">
					</div>
					
					<div class="form-group"">
						<label>Email: </label>
						<input type="text" name="email" class="form-control" required value="<?php echo $schoolInfo->email; ?>">
					</div>
					
					<div class="row">
							<div class="col-md-4">
							</div>
							<div class="col-md-6">
								<input type="submit" name="editschool" class="btn btn-danger" value="Edit School Information">
							</div>
					</div>
				</form>
				
			</div>

		</div>
	</div>
	
</div>
