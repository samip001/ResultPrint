<?php

class Validator
{
	
	function __construct()
	{

	}

	//to check practical
	public function checkPractical($value){
		if($value == 'Yes'){
			return 1;
		}
		return 0;
		
	}

	public function numberToAlphaPractical($value){
		if($value == 1){
			return "Yes";
		}
		return "No";
		
	}

	
	public function getSlug($text)
	{ 
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	  $text = trim($text, '-');
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	  $text = strtolower($text);
	  $text = preg_replace('~[^-\w]+~', '', $text);
	  if (empty($text))
	  {
	    return 'n-a';
	  }
	  return $text;
	}

	public function getYear(){
		$year = 2073;
		$yearupto = array();
		for ($i=0; $i <13 ; $i++) { 
			$validyear = (string)$year.' B.S.';
			$yearupto[$i] = $validyear;	
			$year++;
		}
		return $yearupto;
	}

	public function upgradeYear($years=array(),$currentYear){
		$i = 0;
		$lastitem = count($years) -1;
		
		if ($years[$lastitem] == $currentYear)  {
				return null;
		}
		else{
			foreach($years as $year ) {
			
				if($year == $currentYear){
					 return ($years[$i+1]);
					 break;
				}
				
				$i++;
			}
		}
		return null;
	}

	public function upgradeClass($classes=array(),$currentClass){
		$i = 0;
		$lastitem = count($classes) -1;
		
		if ($classes[$lastitem] == $currentClass)  {
				return null;
		}
		else{
			foreach($classes as $class ) {
				if($class == $currentClass){
					return ($classes[$i+1]);
					break;
				}
			$i++;
			}
		}
		return null;
	}


	public function checkGainMarks($value){
		$value = intval($value);
		if ($value == '*A' || $value == '*P' || $value == '*T') {
			return false;
		}
		else if(is_int($value)){
			return true;
		}
		else{
			return false;;
		}

	}

	public function calculateGrading($total,$marks){
		$calculate = 0;
		if($marks < 1 || $marks > $total){
			return "E";
		}
		else{
			$calculate = ($marks/$total)*100;
			$calculate = round($calculate);
			return $this->getGrade($calculate);	
		}
	}

	// total in printing form
	public function calculateTotalToForm($thmark,$prmark){
		$value = 0;
		$thmark = intval($thmark);
		$prmark = intval($prmark);
		
		if (is_int($thmark) && !is_int($prmark)) {
			$value = $thmark;
		}
		else if (!is_int($thmark) && is_int($prmark)) {
			$value = $prmark;
		}
		else if (!is_int($thmark) && !is_int($prmark)) {
			$value =0;
		}
		else{
			$value = intval($thmark+$prmark);
		}
		// var_dump($thmark);
		// var_dump($prmark);
		return $value;


	}

	public function getGPA($fields = array()){
		$total = 0;
		$num = 0;
		foreach ($fields as $value) {
			$total = $total+$value;
			$num++;
		}

		return number_format(floatval($total/$num), 2);

	}

	//FOR Calculating GRADING For 100 marks
	public function getGrade($number){
		$value = " ";

		if($number >= 90 && $number <=100){
			$value = "A+";
		}else if($number >= 80 && $number < 90 ){
			$value = "A";
		}else if($number >= 70 && $number < 80 ){
			$value = "B+";
		}else if($number >= 60 && $number < 70 ){
			$value = "B";
		}else if($number >= 50 && $number < 60 ){
			$value = "C+";
		}else if($number >= 40 && $number < 50 ){
			$value = "C";
		}else if($number >= 30 && $number < 40 ){
			$value = "D+";
		}else if($number >= 20 && $number < 30 ){
			$value = "D";
		}else if($number >= 0 && $number < 20 ){
			$value = "E";
		}
		return $value;
	}

	public function getGradePoint($value){
		$number = 0;

		if ($value == 'A+') {
			$number = 4.0;
		}
		else if ($value == 'A') {
			$number = 3.6;
		}
		elseif ($value == 'B+') {
			$number = 3.2;
		}
		else if ($value == 'B') {
			$number = 2.8;
		}
		elseif ($value == 'C+') {
			$number = 2.4;
		}
		else if ($value == 'C') {
			$number = 2.0;
		}
		elseif ($value == 'D+') {
			$number = 1.6;
		}
		else if ($value == 'D') {
			$number = 1.2;
		}
		else if($value == 'E') {
			$number = 0.8;
		}
		else{
			$number = 0.0;
		}
		return number_format($number, 1);
	}

	public function getRemarks($grade){
		$remarks= " ";
		if ($grade >3.6 && $grade <=4.0) {
			$remarks = "Outstanding";
		}
		else if ($grade >3.2 && $grade <=3.6) {
			$remarks = "Excellent";
		}
		else if ($grade >2.8 && $grade <=3.2) {
			$remarks = "Very Good";
		}
		else if ($grade >2.4 && $grade <=2.8) {
			$remarks = "Good";
		}
		else if ($grade >2.0 && $grade <=2.4) {
			$remarks = "Satisfactory";
		}
		else if ($grade >1.6 && $grade <=2.0) {
			$remarks = "Acceptance";
		}
		else if ($grade >1.2 && $grade <=1.6) {
			$remarks = "Partially Acceptance";
		}
		else if ($grade >0.8 && $grade <=1.2) {
			$remarks = "Insufficient";
		}
		else{
			$remarks = "Very Insufficient";	
		}
		return $remarks;
	}


}
?>