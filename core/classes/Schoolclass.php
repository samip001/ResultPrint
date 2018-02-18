<?php

/**
* @author Samip Rai
*/
class Schoolclass
{
	private $pdo;

	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function checkClass($class){
        $sql = "Select * from class where class_name = ?";

        $stmt = $this->pdo->prepare($sql);
                
        $stmt->bindParam(1,$class, PDO::PARAM_STR);
       $stmt->execute();

        $count = $stmt->rowCount();
        if($count > 0){
            return true;
        }
        else{
            return false;
        }
   }

    public function insertNewClass($classname){
        $sql = "INSERT INTO class (class_name) VALUES (?)";
            
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(1,$classname, PDO::PARAM_STR);                
       	$stmt->execute();
        
        return true;
   	}

   	public function getAllClasses(){
   		$sql = "Select * from class";
        $stmt = $this->pdo->prepare($sql);

       	$stmt->execute();
		    $classes = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $classes;
   	}
}

?>