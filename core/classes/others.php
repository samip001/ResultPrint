<?php
/**
* 
*/
class Others
{
	
	private $pdo;
	
	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}


    // checks same result 
	public function checkSameResult($table,$resultID){
		$sql = "Select * from ".$table." where result_id= ?";
		$stmt = $this->pdo->prepare($sql);

		$stmt->bindParam(1,$resultID, PDO::PARAM_INT);
		$stmt->execute();
		return $count = $stmt->rowCount();

	}


	public function saveStudentOthersResult($table,$fields = array()){
		$columns = implode(',', array_keys($fields));
        $values = ':'.implode(', :', array_keys($fields));
        $resultid=null;
        $sql = "Insert into {$table} ({$columns}) values ({$values})";

        if($stmt = $this->pdo->prepare($sql)){
            foreach ($fields as $key => $value) {
                $stmt->bindValue(':'.$key,$value);
            }
            // var_dump($stmt);
            $stmt->execute();
           }
	}

	public function updateAttendance($presentday,$absentday,$id){
		$sql="UPDATE attendance SET present_day=?,absent_day=? WHERE result_id=?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1,$presentday, PDO::PARAM_INT);
        $stmt->bindParam(2,$absentday, PDO::PARAM_INT);
        $stmt->bindParam(3,$id, PDO::PARAM_INT);

        // var_dump($stmt);

        if($stmt->execute()){
            return true;
        }
        return false;
	}

	public function updateCreativity($drawing,$handwriting,$dance,$music,$id){
		$sql="UPDATE creativity SET drawing=?,handwriting=?,dance=?,music=? WHERE result_id=?";

        $stmt = $this->pdo->prepare($sql);

        
        $stmt->bindParam(1,$drawing, PDO::PARAM_STR);
        $stmt->bindParam(2,$handwriting, PDO::PARAM_STR);
        $stmt->bindParam(3,$dance, PDO::PARAM_STR);
        $stmt->bindParam(4,$music, PDO::PARAM_STR);             
		$stmt->bindParam(5,$id, PDO::PARAM_INT);

        // var_dump($stmt);

        if($stmt->execute()){
            return true;
        }
        return false;
	}

	public function updateValueEducation($discipline,$punctuality,$communication,$cleanliness,$sports,$interpersonal,$verbal,$creativity,$assignment,$motivation,$id){
		$sql="UPDATE value_education SET discipline=?,punctuality=?,communication_skill=?,cleanliness=?,sports=?,interpersonal=?,verbal=?,creativity=?,assignment=?,motivation=? WHERE result_id=?";

        $stmt = $this->pdo->prepare($sql);

        
        $stmt->bindParam(1,$discipline, PDO::PARAM_STR);
        $stmt->bindParam(2,$punctuality, PDO::PARAM_STR);
        $stmt->bindParam(3,$communication, PDO::PARAM_STR);
        $stmt->bindParam(4,$cleanliness, PDO::PARAM_STR);
        $stmt->bindParam(5,$sports, PDO::PARAM_STR);
        $stmt->bindParam(6,$interpersonal, PDO::PARAM_STR);
        $stmt->bindParam(7,$verbal, PDO::PARAM_STR);
        $stmt->bindParam(8,$creativity, PDO::PARAM_STR);
        $stmt->bindParam(9,$assignment, PDO::PARAM_STR);
        $stmt->bindParam(10,$motivation, PDO::PARAM_STR);
        $stmt->bindParam(11,$id, PDO::PARAM_INT);

        // var_dump($stmt);

        if($stmt->execute()){
            return true;
        }
        return false;
	}

    public function updateStudentResult($thoeryGainMark,$thGainGpa,$praticalGainMark,$prGainGpa,$totalMark,$totalGpa,$id,$resultid,$subjectid){
        $sql="UPDATE student_result SET theory_mark=?,th_gpa=?,practical_mark=?,pr_gpa=?,total=?,total_gpa=? WHERE id=? and result_id=? and subject_id=?";

        $stmt = $this->pdo->prepare($sql);

        
        $stmt->bindParam(1,$thoeryGainMark, PDO::PARAM_INT);
        $stmt->bindParam(2,$thGainGpa, PDO::PARAM_STR);
        $stmt->bindParam(3,$praticalGainMark, PDO::PARAM_INT);
        $stmt->bindParam(4,$prGainGpa, PDO::PARAM_STR);
        $stmt->bindParam(5,$totalMark, PDO::PARAM_INT);
        $stmt->bindParam(6,$totalGpa, PDO::PARAM_STR);
        $stmt->bindParam(7,$id, PDO::PARAM_INT);
        $stmt->bindParam(8,$resultid, PDO::PARAM_INT);
        $stmt->bindParam(9,$subjectid, PDO::PARAM_INT);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }


}


?>