<?php
            include 'database/database.php';
            include 'classes/Result.php';
            include 'classes/Schoolclass.php';
            include 'classes/student.php';
            include 'classes/subject.php';
            include 'classes/Terminal.php';
            include 'classes/others.php';
            include 'classes/SchoolInfo.php';
            include 'classes/validator.php';

            //from database file;
            global $pdo;

            //instantiating  classes
            $result = new Result($pdo);
            $class = new Schoolclass($pdo);
            $student = new Student($pdo);
            $subject = new Subject($pdo);
            $terminal = new Terminal($pdo);
            $others =  new Others($pdo);
            $schoolinfo = new SchoolInfo($pdo);
            $validator = new Validator();
	
?>