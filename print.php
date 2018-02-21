<?php
    include 'core/init.php';

$studentResults = null;
$attendance= null;
$creativity = null;
$valueedu = null;
$resultid = null;
$gpa = array();

// checking VE, Attendance and creativity
$ve = false;
$att = false;
$cr= false;

// for loading school info
$schoolInfo = $schoolinfo->getSchoolInfo();

// loading value 
if (isset($_GET['result']) ) {

    if (!empty($_GET['result']) ) {
        $resultid = $_GET['result'];
        $studentResults = $result->getDetailsStudentResult($resultid);
        
        $attendance= $result->getOthersGradeDetails('attendance',$resultid);
        $creativity = $result->getOthersGradeDetails('creativity',$resultid);
        $valueedu = $result->getOthersGradeDetails('value_education',$resultid);

        $ve = $others->checkSameResult('value_education',$resultid)== intval(1) ? true:false ;
        $att = $others->checkSameResult('attendance',$resultid)== intval(1) ? true:false;
        $cr = $others->checkSameResult('creativity',$resultid) == intval(1) ? true:false;
    }
    else{
        header('Location:listresult.php');
        exit();
    }
    
}


//for editiing value education
if (isset($_POST['editvalueedu'])) {
    header('Location:editvalueeducation.php?resultid='.$_POST['valueresultid']);
}
// editing attendance
if (isset($_POST['editattendance'])) {
    header('Location:editattendance.php?resultid='.$_POST['valueresultid']);
}

// editing creative section
if (isset($_POST['editcreativity'])) {
    header('Location:editcreative.php?resultid='.$_POST['valueresultid']);
}

// for exam date 
$sessionstatus = false;

session_start();
if (isset($_SESSION['resultdate'])) {
    if (!empty($_SESSION['resultdate'])) {
        $sessionstatus= true;
    }
}

?>
 <title><?php echo $student->getStudent($result->getStudentFromResult($_GET['result'])->student_id)->student_name;?> <?php echo $terminal->getTerminalName($result->getStudentFromResult($_GET['result'])->terminal_id).' - '.$result->getStudentFromResult($_GET['result'])->year;?> Result</title>
<?php include 'includes/header.php';?>

<div class="text-center">
    <h3><b><?php echo $terminal->getTerminalName($result->getStudentFromResult($_GET['result'])->terminal_id).' - '.$result->getStudentFromResult($_GET['result'])->year;?></b></h3>
    <h4>Student Name: <?php echo $student->getStudent($result->getStudentFromResult($_GET['result'])->student_id)->student_name;?></h4>
    <h4>Class: <?php echo $result->getStudentFromResult($_GET['result'])->class_name;?></h4>

    <h5>Roll No: <?php echo $student->getStudent($result->getStudentFromResult($_GET['result'])->student_id)->roll_no;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Section: <?php echo $student->getStudent($result->getStudentFromResult($_GET['result'])->student_id)->section;?></h5>

    
   <?php
        if ($sessionstatus) {
            echo '<b>Result Date: '.$_SESSION['resultdate'].'</b>'; // session date
            echo '<br><a href="editexamdate.php?result='.$_GET['result'].'" class="btn btn-xs btn-danger">Edit Exam Date</a><br>';
            if (!count($studentResults) >0 || !$ve || !$att || !$cr) {
                echo '<button class="btn btn-xs btn-default disabled"><i class="glyphicon glyphicon-print"></i> Print  Unavailable</button>';
            }
            else{
                echo '<button id="printphp" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-print"></i> Print</button><br>
                ';
            }   
        }

        else{
            echo('<b>Result Date is Missing</b> <br>
                <a href="resultdate.php?result='.$_GET['result'].'" class="btn btn-xs btn-danger">Add Exam Date</a><br>');
            echo '<button class="btn btn-xs btn-default disabled"><i class="glyphicon glyphicon-print"></i> Print  Unavailable</button>';
        }
   ?>
</div>
<br>
<br>

<div class="container" style="border: 3px solid black;">
    <div class="table-responsive" >
        <table  class="table table-hover">
            <thead>
                <tr>
                    <th colspan="2"></th>                    
                    <th colspan="3"></th>                    
                    <th colspan="2"></th>                    
                    <th colspan="6">Obtained Grade</th>                    
                    <th colspan="6">Obtained Marks</th>
                    
                </tr>
                <tr>
                    <th colspan="2">S/N</th>                    
                    <th colspan="3">Subjects</th>                    
                    <th colspan="2">Credit Hour</th>                    
                    <th colspan="2">Theory Grade</th>                    
                    <th colspan="2">Practical Grade</th> 
                    <th colspan="2">Total Grade</th> 
                    <th colspan="2">Theory Marks</th>                    
                    <th colspan="2">Practical Marks</th> 
                    <th colspan="2">Total Marks</th>
                    <th colspan="2">Grade Point</th> 
                    <th>Edit</th>
                </tr>
                    
            </thead>
            
            <tbody>
            <?php
                if(count($studentResults) > 0){
                    $i = 1;
                    foreach ($studentResults as $sturesult) {

                        //check practical yes or no
                        $practical = " ";
                        if($subject->getSubjectDetails($sturesult->subject_id)->practical == 1){
                            $practical = $sturesult->practical_mark;
                        }
                        echo '<tr>
                                <td colspan="2">'.$i.'.</td>
                                <td colspan="3">'.$subject->getSubjectDetails($sturesult->subject_id)->subject_name.'</td>
                                <td colspan="2">'.$subject->getSubjectDetails($sturesult->subject_id)->credit_hrs.'</td>
                                <td colspan="2">'.$sturesult->th_gpa.'</td>
                                <td colspan="2">'.$sturesult->pr_gpa.'</td>
                                <td colspan="2">'.$sturesult->total_gpa.'</td>
                                <td colspan="2">'.$sturesult->theory_mark.'</td>
                                <td colspan="2">'.$practical.'</td>
                                <td colspan="2">'.$validator->calculateTotalToForm($sturesult->theory_mark,$sturesult->practical_mark).'</td>
                                <td colspan="2">'.$validator->getGradePoint($sturesult->total_gpa).'</td>
                                <td><a href="editresult.php?id='.$sturesult->id.'&subjectid='.$sturesult->subject_id.'&resultid='.$sturesult->result_id.'"><span class="glyphicon glyphicon-pencil"></span></a>
                                </td>
                            </tr>';
                        //storing value for Calculating gpa
                        $gpa[$i-1] = $validator->getGradePoint($sturesult->total_gpa); 
                        $i++;
                    }
                }
                else{
                    echo '<tr>
                        <td colspan="7"></td>
                        <td colspan="9" class="text-danger">Result Not Found</td>
                        <td colspan="6"></td>
                        </tr>';
                }
            ?>
            </tbody>

            <tfoot>
            <?php
            if(count($studentResults) > 0){
             $gpavalue = $validator->getGPA($gpa);
             echo'       <tr>
                        <td colspan="8"></td>
                        <td colspan="6"><b>Grade Point Average (GPA): '.$gpavalue.'</b></td>
                    </tr>';
                }
            ?>
            </tfoot>
        </table>
    </div>

    <section id="valueeducation">
    <div class="container">
        <div class="col-md-4" style="margin-right: 2px;">
            <table class="table" border="3">
                <thead>
                <tr>
                    <th colspan="8">Value Education</th>
                </tr>
                <tr>
                    <th>S.N</th>
                    <th colspan="6">Criteria</th>
                    <th>Grades</th>
                </tr>
                </thead>
       

                <tbody>
                     <?php
                        if ($ve) {?>
                    <tr>
                        <td>1.</td>
                        <td colspan="6">Discipline</td>
                        <td><?php echo $valueedu->discipline;?></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td colspan="6">Punctuality</td>
                        <td><?php echo $valueedu->punctuality;?></td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td colspan="6">Communicative Skill & Functions</td>
                        <td><?php echo $valueedu->communication_skill;?></td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td colspan="6">Cleanliness & Smartness</td>
                        <td><?php echo $valueedu->cleanliness;?></td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td colspan="6">Sports / ECA</td>
                        <td><?php echo $valueedu->sports;?></td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td colspan="6">Interpersonal Skills</td>
                        <td><?php echo $valueedu->interpersonal;?></td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td colspan="6">Verbal-Linguistic Skill</td>
                        <td><?php echo $valueedu->verbal;?></td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td colspan="6">Creativity in Performance</td>
                        <td><?php echo $valueedu->creativity;?></td>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td colspan="6">Assinment Attempt</td>
                        <td><?php echo $valueedu->assignment;?></td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td colspan="6">Motivation</td>
                        <td><?php echo $valueedu->motivation;?></td>
                    </tr>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                        <form method="POST">
                            <input type="hidden" name="valueresultid" value="<?php echo($resultid); ?>">
                            <button class="btn btn-block btn-xs btn-danger" name="editvalueedu">Edit</button>
                        </form>
                        </td>
                    </tr>
                </tfoot>
                <?php
                    }
                else{
                    echo '<tbody>
                            <tr>
                                <td colspan="8" class="text-danger">Value Education Result Not Found</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                            <td colspan="8">
                            <a href="valueeducation.php?classname='.$result->getStudentFromResult($_GET['result'])->class_name.'&terminal='.$result->getStudentFromResult($_GET['result'])->terminal_id.'&year='.$result->getStudentFromResult($_GET['result'])->year.'" class="btn btn-block btn-xs btn-danger">Add Value Education Result</a>
                            </td>
                            </tr>
                        </tfoot>' ;
                }
                ?>


            </table>
        </div>



        <div class="col-md-4">
            <table border="3" class="table">
                <thead>
                <tr>
                    <th colspan="4">Details of Grade Sheet</th>
                </tr>
                <tr>
                    <th>S.N.</th>
                    <th>Interval in Percent</th>
                    <th>Grade</th>
                    <th>Point</th>
                </tr>
                </thead>
                <tbody>
                 <tr>
                        <td>1.</td>
                        <td colspan="1">90 to 100</td>
                        <td>A+</td>
                        <td>4.0</td>

                    </tr>
                    <tr>
                        <td>2.</td>
                        <td colspan="1">80 to Below 90</td>
                        <td>A</td>
                        <td>3.6</td>
                    </tr>
                     <tr>
                        <td>3.</td>
                        <td colspan="1">70 to Below 80</td>
                        <td>B+</td>
                        <td>3.2</td>

                    </tr>
                    <tr>
                        <td>4.</td>
                        <td colspan="1">60 to Below 70</td>
                        <td>B</td>
                        <td>2.8</td>
                    </tr> 
                    <tr>
                        <td>5.</td>
                        <td colspan="1">50 to Below 60</td>
                        <td>C+</td>
                        <td>2.4</td>

                    </tr>
                    <tr>
                        <td>6.</td>
                        <td colspan="1">40 to Below 30</td>
                        <td>C</td>
                        <td>2.0</td>
                    </tr> 
                    <tr>
                        <td>7.</td>
                        <td colspan="1">30 to Below 40</td>
                        <td>D+</td>
                        <td>1.6</td>

                    </tr>
                    <tr>
                        <td>8.</td>
                        <td colspan="1">20 to Below 30</td>
                        <td>D</td>
                        <td>0.8</td>
                    </tr> 
                    <tr>
                        <td>9.</td>
                        <td colspan="1">0 to Below 20</td>
                        <td>E</td>
                        <td>0</td>

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-3" style="margin-left: 2px;">
            <table border="3" class="table">
                <thead>
                    <th colspan="8">Attendance</th>
                </thead>

                <tbody>
                <?php if ($att) {?>
                    <tr>
                        <td>Present Days: </td>
                        <td colspan="7"><?php echo $attendance->present_day;?></td>
                    </tr>
                     <tr>
                        <td>Absent Days: </td>
                        <td colspan="7"><?php echo $attendance->absent_day;?></td>
                    </tr>
                     <tr>
                        <td>Working Days: </td>
                        <td colspan="7"><?php echo intval($attendance->present_day+$attendance->absent_day);?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                        <form method="POST">
                            <input type="hidden" name="valueresultid" value="<?php echo($resultid); ?>">
                            <button class="btn btn-block btn-xs btn-danger" name="editattendance">Edit</button>
                        </form>
                        </td>
                    </tr>
                </tfoot>
                 <?php
                    }
                else{
                    echo '<tbody>
                            <tr>
                                <td colspan="8" class="text-danger">Attendance Result Not Found</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                            <td colspan="8">
                            <a href="attendance.php?classname='.$result->getStudentFromResult($_GET['result'])->class_name.'&terminal='.$result->getStudentFromResult($_GET['result'])->terminal_id.'&year='.$result->getStudentFromResult($_GET['result'])->year.'" class="btn btn-block btn-xs btn-danger">Add Value Education Result</a>
                            </td>
                            </tr>
                        </tfoot>' ;
                }
                ?>
            </table>

            <table border="3" class="table">
                <thead>
                    <tr>
                        <th colspan="9">Creative Section</th>
                    </tr>
                    <tr>
                        <th>S.N.</th>
                        <th>Criteria</th>
                        <th colspan="7">Grade</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($cr) {?>
                    <tr>
                        <td>1.</td>
                        <td>Drawing/Painting</td>
                        <td colspan="7"><?php echo $creativity->drawing;?></td>
                    </tr>
                     <tr>
                        <td>2.</td>
                        <td>Handwriting</td>
                        <td colspan="7"><?php echo $creativity->handwriting;?></td>
                    </tr>
                     <tr>
                        <td>3.</td>
                        <td>Dance</td>
                        <td colspan="7"><?php echo $creativity->dance;?></td>
                    </tr>
                     <tr>
                        <td>4.</td>
                        <td>Music/Vocal</td>
                        <td colspan="7"><?php echo $creativity->music;?></td>
                    </tr>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">
                        <form method="POST">
                            <input type="hidden" name="valueresultid" value="<?php echo($resultid); ?>">
                            <button class="btn btn-block btn-xs btn-danger" name="editcreativity">Edit</button>
                        </form>
                        </td>
                    </tr>
                </tfoot>
                <?php
                    }
                else{
                    echo '<tbody>
                            <tr>
                                <td colspan="9" class="text-danger">Creativity Result Not Found</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                            <td colspan="9">
                            <a href="creative.php?classname='.$result->getStudentFromResult($_GET['result'])->class_name.'&terminal='.$result->getStudentFromResult($_GET['result'])->terminal_id.'&year='.$result->getStudentFromResult($_GET['result'])->year.'" class="btn btn-block btn-xs btn-danger">Add Value Education Result</a>
                            </td>
                            </tr>
                        </tfoot>' ;
                }
                ?>
            </table>
        </div>
    </div>
</section>
</div>

<br>

<!--Hide and show when all condition is met style="visibility: hidden;"-->
<div class="printform" style="position: relative; border:3px solid black; height: 1000px;">
  <img src="assets/image/mm.png" alt="School-Logo-goes-here" height="995px" width="755px" />

    <img id="schoolLogo" src="assets/image/schoollogo.png" style="position: absolute; left: 20px; top: 0px" />
        <div style="position: absolute; top: 5px; left: 140px;">
             <span style="font-size: 30px;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $schoolInfo->school_name;?></b><br></span>        
        </div>
         <div style="position: absolute; left: 240px; top: 45px;font-size: 18px;">
            <?php echo $schoolInfo->address;?> <?php echo $schoolInfo->city;?>
        </div>
        <div style="position: absolute; left: 340px; top: 70px;">
            Tel: <?php echo $schoolInfo->contact;?>
        </div>

    <div id="gradesheet" style="position: absolute; left: 250px; top: 102px;">
        <p style="font-size: 25px; font-weight: bold;">Progress Report Card</p>
    </div>

    <div id="terminal" style="position: absolute; top: 145px;">
        <p style="font-size: 24px; font-weight: bold;"><?php echo $terminal->getTerminalName($result->getStudentFromResult($_GET['result'])->terminal_id)." Examination - ".$result->getStudentFromResult($_GET['result'])->year;?>
        </p>
    </div>

    <div style="font-size: 21px; margin-left:10px;">
        <div style="position: absolute; float: left;  top: 180px;">
            <b>Student's Name: </b><?php echo $student->getStudent($result->getStudentFromResult($_GET['result'])->student_id)->student_name;?>
        </div>

        <div style="position: absolute; left: 560px; top: 180px;">
            <b>Year: </b><?php echo $student->getStudent($result->getStudentFromResult($_GET['result'])->student_id)->current_year;?>
        </div>
    </div>

    <div style="font-size: 18px; margin-left: 10px;">
        <div style="position: absolute; float: left; top: 210px;">
            <b>Class: </b><?php echo $result->getStudentFromResult($_GET['result'])->class_name;?> 
        </div>

        <div style="position: absolute; float: left; left: 320px;top: 210px;">
            <b>Section: </b><?php echo $student->getStudent($result->getStudentFromResult($_GET['result'])->student_id)->section;?>
        </div>

        <div style="position: absolute; left: 560px; top: 210px; float: right">
            <b>Roll No.: </b><?php echo $student->getStudent($result->getStudentFromResult($_GET['result'])->student_id)->roll_no; ?>
        </div>
    </div>

    <!-- Table Section Goes here-->
    <div style="position: absolute; top: 240px; margin-left:10px">
        <table border="1" style="width: 725px;" class="samp">
            <thead>
            <tr>
                <th rowspan="2">S/N</th>                    
                <th rowspan="2" colspan="5" >Subjects</th>                    
                <th rowspan="2">Credit Hour</th>                    
                <th colspan="3">Obtained Grade</th>                    
                <th rowspan="2">Grade Point</th>                    
                <th colspan="3">Obtained Marks</th>
            </tr>
            <tr>
                <th>Th</th>
                <th>Pr</th>
                <th>Total</th>
                <th>Th</th>
                <th>Pr</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody style="font-size: 17px;">
               <?php
                    $row = 0;
                    $index = 1;
                    $count = count($studentResults);

                        //check practical yes or no
                        $practical = " ";
                        if($subject->getSubjectDetails($sturesult->subject_id)->practical == 1){
                            $practical = $sturesult->practical_mark;
                        }
                    
                    while ( $row < 13) {
                        if($count > $row){
                            $practical = " ";
                            if($subject->getSubjectDetails($studentResults[$row]->subject_id)->practical == 1){
                                $practical = $studentResults[$row]->practical_mark;
                            }
                            echo '<tr>
                                    <td>'.$index.'.</td>
                                    <td colspan="5">'.$subject->getSubjectDetails($studentResults[$row]->subject_id)->subject_name.'</td>
                                    <td>'.$subject->getSubjectDetails($studentResults[$row]->subject_id)->credit_hrs.'</td>
                                    <td>'.$studentResults[$row]->th_gpa.'</td>
                                    <td>'.$studentResults[$row]->pr_gpa.'</td>
                                    <td>'.$studentResults[$row]->total_gpa.'</td>
                                    <td>'.$validator->getGradePoint($studentResults[$row]->total_gpa).'</td>
                                    <td>'.$studentResults[$row]->theory_mark.'</td>
                                    <td>'.$practical.'</td>
                                    <td>'.$validator->calculateTotalToForm($studentResults[$row]->theory_mark,$studentResults[$row]->practical_mark).'</td>
                                </tr>';
                                $index++;
                                $row++; 
                        }
                        else{
                            echo '<tr style="">
                                    <td>.</td>
                                    <td colspan="5"> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>';
                                $row++; 
                        }
                    }
                ?>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="6"><span style="font-size: 14px;">REMARKS: <?php echo$validator->getRemarks($gpavalue) ?></span></td>
                    <td colspan="9"><b>Grade Point Average (GPA):  <?php echo $gpavalue; ?></b></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!--Others Section-->
    <div id="otherssection" style="width: 725px; position: absolute; top: 580px; margin-left: 10px; font-size: 17px;">
        <!--Value Others-->
        <div style="float: left; margin-right: 15px; margin-left: 20px;">
            <table border="1" style="padding: 5px;">
                <thead>
                <tr>
                    <th colspan="8">Value Education</th>
                </tr>
                <tr>
                    <th>S.N</th>
                    <th colspan="6">Criteria</th>
                    <th>Grades</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td colspan="6">Discipline</td>
                        <td> <?php echo $valueedu->discipline;?> </td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td colspan="6">Punctuality</td>
                        <td> <?php echo $valueedu->punctuality;?> </td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td colspan="6">Communicative Skill</td>
                        <td> <?php echo $valueedu->communication_skill;?> </td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td colspan="6">Cleanliness & Smartness</td>
                        <td> <?php echo $valueedu->cleanliness;?> </td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td colspan="6">Sports / ECA</td>
                        <td> <?php echo $valueedu->sports;?> </td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td colspan="6">Interpersonal Skills</td>
                        <td><?php echo $valueedu->interpersonal;?></td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td colspan="6">Verbal-Linguistic Skill</td>
                        <td><?php echo $valueedu->verbal;?></td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td colspan="6">Creativity in Performance</td>
                        <td><?php echo $valueedu->creativity;?></td>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td colspan="6">Assinment Attempt</td>
                        <td><?php echo $valueedu->assignment;?></td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td colspan="6">Motivation</td>
                        <td><?php echo $valueedu->motivation;?></td>
                    </tr>
                </tbody>
            </table>
        </div> <!--End of Value-->

         <!--Details of Grading-->
        <div style="margin-left: 20px; ">
            <table border="1" style="padding: 5px;">
                <thead>
                <tr>
                    <th colspan="5">Details of Grade Sheet</th>
                </tr>
                <tr>
                    <th>S.N.</th>
                    <th>Interval in Percent</th>
                    <th>Grade</th>
                    <th>Point</th>
                    <th>Remarks</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td colspan="1">90 to 100</td>
                        <td>A+</td>
                        <td>4.0</td>
                        <td>Outstanding</td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td colspan="1">80 to Below 90</td>
                        <td>A</td>
                        <td>3.6</td>
                        <td>Excellent</td>
                    </tr>
                     <tr>
                        <td>3.</td>
                        <td colspan="1">70 to Below 80</td>
                        <td>B+</td>
                        <td>3.2</td>
                        <td>Very Good</td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td colspan="1">60 to Below 70</td>
                        <td>B</td>
                        <td>2.8</td>
                        <td>Good</td>
                    </tr> 
                    <tr>
                        <td>5.</td>
                        <td colspan="1">50 to Below 60</td>
                        <td>C+</td>
                        <td>2.4</td>
                        <td>Satisfactory</td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td colspan="1">40 to Below 30</td>
                        <td>C</td>
                        <td>2.0</td>
                        <td>Acceptance</td>
                    </tr> 
                    <tr>
                        <td>7.</td>
                        <td colspan="1">30 to Below 40</td>
                        <td>D+</td>
                        <td>1.6</td>
                        <td>Partially Acceptance</td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td colspan="1">20 to Below 30</td>
                        <td>D</td>
                        <td>1.2</td>
                        <td>Insufficient</td>
                    </tr> 
                    <tr>
                        <td>9.</td>
                        <td colspan="1">0 to Below 20</td>
                        <td>E</td>
                        <td>0.8</td>
                        <td>Very Insufficient</td>
                    </tr>
                </tbody>
            </table>
        </div><!--End of Details-->

    </div><!--Others Section-->


    <div id="anothersection" style="position: absolute; top: 825px; margin-left: 10px; ">
        <!--Info of result-->
        <div style="float: left; margin-left: 5px;">
            <ol style="font-size: 12px;">
                <li>One Credit Hour equals to 32 clock hours</li>
                <li>Th: Theory</li>
                <li>Pr: Practical </li>
                <li>*A: Absent</li>
                <li>*T: Thoery Grade Missing</li>
                <li>*P: Practical Grade Missing</li>
            </ol>
        </div><!--End of Info section-->   

        <!--Creative Section-->
        <div style="float: left; margin-right: 5px; margin-left: 40px; margin-top: -25px; ">
           <table border="1" style="font-size: 16px;">
                    <thead>
                        <tr>
                            <th colspan="2">Creative Section</th>
                        </tr>
                        <tr>
                            <th>Criteria</th>
                            <th>Grade</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Drawing/Painting</td>
                            <td><?php echo $creativity->drawing;?></td>
                        </tr>
                         <tr>
                         <td>Handwriting</td>
                            <td><?php echo $creativity->handwriting;?></td>
                        </tr>
                         <tr>
                            <td>Dance</td>
                            <td><?php echo $creativity->dance;?></td>
                        </tr>
                         <tr>
                            <td>Music/Vocal</td>
                            <td><?php echo $creativity->music;?></td>
                        </tr>
                        
                    </tbody>
                </table>
        </div><!--End of Creative Section style="position: absolute; margin-left: 548px; margin-top: 72px;"-->
       
        <!--Attendance Section-->
        <div style="float: left; margin-left:10px; margin-top: -25px; ">
            <table border="1" style="font-size: 16px;">
                <thead>
                    <th colspan="4">Attendance</th>
                    
                </thead>

                <tbody>
                    <tr>
                        <td>Present Days: </td>
                        <td colspan="2"> <?php echo $attendance->present_day;?> </td>
                        <td></td>
                        
                    </tr>
                     <tr>
                        <td>Absent Days: </td>
                        <td colspan="2"><?php echo $attendance->absent_day;?> </td>
                        <td></td>
                    </tr>
                     <tr>
                        <td>Working Days: </td>
                        <td colspan="2"><?php echo intval($attendance->present_day+$attendance->absent_day);?> </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div><!--End of Attendance Section-->
    
    </div> <!--End of another section-->

     <!--Buttom Section-->
    <div style="position: absolute; top: 970px; font-size: 17px;">
        <div style="float: left; margin-left:20px; margin-right: 70px; ">
            <b><i style="text-decoration: overline;">Class Teacher's Signature</i></b>
        </div>

        <div style="float: left; margin-left: 20px; margin-right: 20px;">
            <b><i>Date: &nbsp;&nbsp;<?php if(isset($_SESSION['resultdate'])){
                    echo $_SESSION['resultdate'];
                } ?></i></b>
        </div>

        <div style="float: left; margin-left: 90px;">
            <b><i style="text-decoration: overline;">Principal's Signature</i></b>
        </div>
    </div>

    <div style="position: absolute; top: 880px; font-size: 12px;">
         <?php 
            if ($result->getStudentFromResult($resultid)->terminal_id == 4) {
                $classes = $class->getAllClasses();
                $allClass = array();
                foreach ($classes as $clas) {
                    array_push($allClass, $clas->class_name);
                }
                $currentClass = $result->getStudentFromResult($resultid)->class_name;
                $newClass = $validator->upgradeClass($allClass,$currentClass);

                if ($newClass != null) {
                    echo '<div style="float: left; margin-left: 500px; width: 240px;padding:5px;">
                             <b><span style="text-decoration: underline;">Congratulations:</span></b><br>
                             <b>You have been promoted to class '.$newClass.'</b>
                            </div>';
                }
                else{
                    echo '<div style="float: left; margin-left: 500px; width: 240px; padding:5px;">
                             <b><span style="text-decoration: underline;">Congratulations:</span><br >On your next learning journey</b>
                            </div>';
                }
            }

        ?>
    </div>


</div>

</body>

<?php include 'includes/script.php'; ?>

</html>