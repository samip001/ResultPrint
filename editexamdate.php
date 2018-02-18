<?php
include 'core/init.php';
session_start();

$resultid;
if (isset($_GET['result'])) {
    if (!empty($_GET['result'])) {
        $resultid= $_GET['result'];
    }
}

//for showing in form
$resultdate = $_SESSION['resultdate'];
$resultdate= (explode("/",$resultdate));
$year = $resultdate[0];
$month = $resultdate[1];
$day = $resultdate[2];

// editing result date 
if (isset($_POST['editexamdate'])) {
	$year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];

    // setting new reult date
    $examdate =  $year."/".$month."/".$day;
    $_SESSION['resultdate'] = $examdate;	

    header('Location:print.php?result='.$resultid);
    exit();
}

?>

<title>Result Date</title>
<?php include 'includes/header.php';?>
<div class="row">
    <div class="col-md-4"></div>

    <div class="col-md-4">
    	<div class="panel panel-default">
    		<div class="panel-heading">
    			<h3>Edit Result Date: <b><?php echo $_SESSION['resultdate'];?></b></h3>
    		</div>

    		<div class="panel-body">
    			<form method="POST">
			        <div class="form-group">
			            <label>Year: </label>
			            <input type="number" name="year" class="form-control" pattern="[0-9]{4}" title="Only Number Accepted" required min="2073" max="3000" value="<?php echo($year);?>">
			        </div>
        
			        <div class="form-group">
			            <label>Month: </label>
			            <input type="number" name="month" class="form-control" pattern="[0-9]{2}" title="Only Number Accepted" required min="1" max="12" value="<?php echo($month);?>">
			        </div>
			        
			        <div class="form-group">
			            <label>Day: </label>
			            <input type="number" name="day" class="form-control" pattern="[0-9]{2}" title="Only Number Accepted" required min="1" max="31" value="<?php echo($day);?>">
			        </div>

        			<input type="submit" name="editexamdate" class="btn btn-md btn-danger btn-block" value="Edit Exam Date">
     			</form>
    		</div>
    	</div>
    </div>
    
    <div class="col-md-4"></div>    
</div>
  


