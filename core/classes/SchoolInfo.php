<?php

/**
* 
*/
class SchoolInfo 
{
	private $pdo;
	
	function __construct($pdo)
	{
		$this->pdo= $pdo;
	}

	public function getSchoolInfo(){
		$sql = "Select * from school_info where id = 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $schoolinfo = $stmt->fetch(PDO::FETCH_OBJ);

        return $schoolinfo;
	}

	public function updateSchoolInfo($schoolname,$address,$city,$contact,$email){
		$sql ="UPDATE school_info SET school_name=?,address=?,city=?,contact=?,email=? WHERE id=1";

        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(1,$schoolname, PDO::PARAM_STR);
        $stmt->bindParam(2,$address, PDO::PARAM_STR);
        $stmt->bindParam(3,$city, PDO::PARAM_INT);
        $stmt->bindParam(4,$contact, PDO::PARAM_STR);
        $stmt->bindParam(5,$email, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        }
        return false;

	}

}

?>