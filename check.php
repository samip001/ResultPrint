<?php
	include 'core/init.php';
	
	// $studentResults = $result->getDetailsStudentResult(2);
	// var_dump($studentResults);
	// print_r($studentResults);

	// echo count($studentResults);
	// echo "<br>".($studentResults[0])->subject_id;
	
	// // up to year 2150b.s
	// $year = 2073;
	// $yearupto = array();
	// for ($i=0; $i <78 ; $i++) { 
	// 	$validyear = (string)$year.' B.S.';
	// 	$yearupto[$i] = $validyear;	
	// 	$year++;
	// }

	// // var_dump($yearupto);

	// $i=1;
	// foreach ($yearupto as $year ) {
	// 	if ($year == '2130 B.S.') {
	// 		echo "found at :".$i."<br>";
	// 	}
	// 	$i++;
	// }

	// echo $i;

	// var_dump($validator->getYear());

	// echo count(($student->getStudentThroughYear('UKG','2073 B.S.')));

	//for result
	// echo($result->checkSameStudentResult(2,'UKG',2));
	// $fields = array('student_id' => 2,'student_name'=>'Sam','class_name'=>'UKG','terminal_id'=>2,'year'=>'2073 B.S.');
	// echo($result->insertResult('result',$fields));

	// echo $validator->getThoeryGrade(100,'22s');
	// echo $validator->getPracticalGrade(50,'22s');
	
	//checking data in student result
	// $fields = array('result_id' => 9,'subject_id'=>4,'theory_mark'=>35,'th_gpa'=>'A','practical_mark'=>0,'pr_gpa'=>'E','total'=>35,'total_gpa'=>'F' );

	
	// $result->saveStudentResult('student_result',$fields);
	

	//checking conbine of table
	// echo ($result->checkSameStudentResult(2,'UKG',1));

	// $result->getStudentInfo($resultid,$studentId);

	// echo($result->checkStudentForOthers('attendance',19,2))."<br>";
	// echo($result->checkStudentForOthers('creativity',19,2))."<br>";
	// echo($result->checkStudentForOthers('value_education',19,2))."<br>";

	// echo($others->checkSameResult('attendance',10));

	// $results = $result->getStudentFromResult(22);
	// var_dump($results);

	// $results = $result->getDetailsStudentResult(22);
	// var_dump($results);

	// $results= $result->getDetailsSubjectResult(21);
	// var_dump($results);
	// echo($results->student_name);

	// $students =  $student->getStudent($results->student_id);
	// var_dump($students);


	// $results= ($result->getOthersGradeDetails('attendance',21));
	// echo($results->present_day);

	// $results = $result->getStudentResultForOthers($_GET['classname'],$_GET['terminal'],$_GET['year']);
	// var_dump($results);

	// echo $validator->calculateGrading(100,20);

	// echo($validator->calculateTotalToForm('*A',40))


	// $fields = array(20,30,40,50,60,50);
	// var_dump($validator->getGPA($fields));

	
	// $arrayName = array('theory_mark' => '*A','Prac'=>200 );

	// var_dump($arrayName);

	// foreach ($arrayName as $value) {
	// 	echo $value;
	// }
	
	// echo $validator->getTotalValidation(40,'*P');
	// $a ='40';
	// $a = is_int($a);
	// var_dump($a);
	// var_dump(is_int($a));

	// var_dump($validator->checkGainMarks('*A'));

	// if (($validator->checkGainMarks('20'))) {
	// 	echo '20 wala';
	// 	echo $validator->calculateGrading(100,20);
	// }

	// if (($validator->checkGainMarks(')12AA'))) {
	// 	echo 'askdgfkgakgkjg';
	// }


	// echo $validator->getSlug("English - II");

	// var_dump($ve = $others->checkSameResult('value_education',20)== intval(1) ? true:false) ;

	// echo $validator->upgradeYear($validator->getYear(),'2085 B.S.'); // done

	// $classlist = array();
	// $classes = $class->getAllClasses();
	// // var_dump($classes);
	// $i=0;
	// foreach ($classes as $class) {
	// 	$classlist[$i] = $class->class_name;
	// 	$i++;
	// }
	// echo $validator->upgradeClass($classlist,'9');



// $str = "2073/14/2";
// print_r (explode("/",$str));

// $stud = $result->getStudentResultForOthers('Nursery',1,'2073 B.S.');
// foreach ($stud as $stdents) {
// 	echo $student->getStudent($stdents->student_id)->student_name;
	
// }

        // $classes = $class->getAllClasses();
        // // var_dump($classes);	
        // $allClass = array();
        // foreach ($classes as $clas) {
        // 	array_push($allClass, $clas->class_name);
        // }
        // var_dump($allClass);
        // $newClass = $validator->upgradeClass($allClass,'9');

        // var_dump($newClass);
                

?>