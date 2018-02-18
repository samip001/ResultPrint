<?php
	
	include 'core/init.php';

	$schoolInfo = $schoolinfo->getSchoolInfo();
?>

<title>
	<?php 
		echo $schoolInfo->school_name;
	?>
</title>

<?php 
	include 'includes/header.php';

?>

<div class="container">
	<?php
		include 'includes/classlist.php';
	?>

	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>School Information</h2>
			</div>

			<div class="panel-body text-center">
				<h1><?php echo $schoolInfo->school_name;?></h1>
				<p><?php echo $schoolInfo->address;?></p>
				<p><?php echo $schoolInfo->city;?></p>
				<p><?php echo $schoolInfo->contact;?></p>
				<p><?php echo $schoolInfo->email;?></p>
			</div>

			<div class="panel-footer">
				<a href="editschoolinfo.php" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-edit"></i> Edit School Info</a>
				<br>
			</div>
		</div>
	</div>
	
</div>
