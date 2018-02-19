<?php
    include 'core/init.php';
    
    if (isset($_POST['classselect'])) {
       header("Location:result.php?classname=".$_POST['classname'].'&year='.$_POST['year']);
       exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $schoolinfo->getSchoolInfo()->school_name;?></title>
    <link rel="icon" type="image/x-icon" href="assets/image/favico.ico">
    <?php include 'includes/style.php'; ?>
</head>
<body>
   <div id="background">
        <div id="inputContainer">
            <div style="height: 600px;">
                    <div class="checkdiv">
                         <a href="listresult.php" class="btn btn-danger"><span class="glyphicon glyphicon-eye-open"></span> View Result</a>
                          <a href="addstudent.php" class="btn btn-danger pad1"><span class="glyphicon glyphicon-plus"></span> Register Student</a>  
                         <button class="btn btn-danger" data-toggle="modal" data-target="#modalOn"><span class="glyphicon glyphicon-user"></span>  Create Result</button>
                    </div>
            </div>
        </div>
    </div>

    <!-- Data modal start for class selection-->
    <div id="modalOn" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4>Select Class</h4>
                </div>
                
                <div class="modal-body">
                    <form action="index.php" method="POST">
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
                        
                        <div class="form-group">
                            <input class="btn btn-danger" type="submit" name="classselect" value="Ok Procced">
                        </div>  
                    </form>
                    
                </div>
                   
                
            </div>
        </div>
    </div><!-- Data modal End-->
</body>
<?php include 'includes/script.php'; ?>
</html>


