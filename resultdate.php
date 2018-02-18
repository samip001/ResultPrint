<?php
include 'core/init.php';
$resultid;
if (isset($_GET['result'])) {
    if (!empty($_GET['result'])) {
        $resultid= $_GET['result'];
    }
}

if (isset($_POST['examdate'])) {
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];

    $examdate =  $year."/".$month."/".$day;
    
    session_start();
    
    $_SESSION['resultdate'] = $examdate;
    
    header('Location:print.php?result='.$resultid);
    exit();
}

?>

<title>Result Date</title>
<?php include 'includes/header.php';?>
<div>
    <div class="row">
        <div class="col-md-4"></div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Result Date
                </div>

                <div class="panel-body">
                    <form method="POST">
                        <div class="form-group">
                            <label>Year: </label>
                            <input type="number" name="year" class="form-control" pattern="[0-9]{4}" title="Only Number Accepted" required min="2073" max="3000">
                        </div>
            
                        <div class="form-group">
                            <label>Month: </label>
                            <input type="number" name="month" class="form-control" pattern="[0-9]{2}" title="Only Number Accepted" required min="1" max="12">
                        </div>
                        
                        <div class="form-group">
                            <label>Day: </label>
                            <input type="number" name="day" class="form-control" pattern="[0-9]{2}" title="Only Number Accepted" required min="1" max="31">
                        </div>

                        <input type="submit" name="examdate" class="btn btn-md btn-danger btn-block" value="Add Exam Date">
                    </form>
                </div>
            </div>
        </div>
    
        <div class="col-md-4"></div> 

    </div>
  
</div>
