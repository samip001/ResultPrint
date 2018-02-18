<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// SELECT * from result where student_id=2 and class_name='UKG' AND terminal_id =1
/**
 * Description of Result
 *
 * @author samip
 */
class Result {
    
   function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function checkSameStudentResult($studentID,$class,$terminal){
        $sql = "Select * from result where student_id = ? and class_name = ? and terminal_id = ?";

        $stmt = $this->pdo->prepare($sql);
                
        $stmt->bindParam(1,$studentID, PDO::PARAM_INT);
        $stmt->bindParam(2,$class, PDO::PARAM_STR);
        $stmt->bindParam(3,$terminal, PDO::PARAM_INT);

        $stmt->execute();

        return $count = $stmt->rowCount();
    }
    
    // Insert into result table and return latest row inserted
    public function insertResult($table,$fields=array()){
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
            return $resultid = $this->pdo->lastInsertId();
           }
    }

    // uses above inserted row id and insert into M:M student_result table
    public function saveStudentResult($table,$fields=array()){
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

   // Get all student result in listing result of student  
   public function getStudentResultForOthers($classname,$terminalid,$year){
        $sql = "Select * from result where class_name = ? and terminal_id=? and year=?";

        $stmt = $this->pdo->prepare($sql);
                
        $stmt->bindParam(1,$classname, PDO::PARAM_STR);
        $stmt->bindParam(2,$terminalid, PDO::PARAM_INT);
        $stmt->bindParam(3,$year, PDO::PARAM_STR);

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function checkStudentForOthers($tablename,$resultid,$terminalid){
        $sql = "Select * from ".$tablename." where result_id = ? and terminal_id = ?";

        $stmt = $this->pdo->prepare($sql);
                
        $stmt->bindParam(1,$resultid, PDO::PARAM_INT);
        $stmt->bindParam(2,$terminal, PDO::PARAM_INT);

        $stmt->execute();

        return $count = $stmt->rowCount();
    }

    public function getStudentFromResult($resultid){
        $sql = "SELECT * FROM result where result_id=?";
        $stmt = $this->pdo->prepare($sql);
                
        $stmt->bindParam(1,$resultid, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_OBJ);
        return $results;
    }

    public function getDetailsStudentResult($resultid){
        $sql = "SELECT * FROM student_result where result_id=?";
        $stmt = $this->pdo->prepare($sql);
                
        $stmt->bindParam(1,$resultid, PDO::PARAM_INT);
        $stmt->execute();
        return $results = $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getDetailsSubjectResult($id){
        $sql = "SELECT * FROM student_result where id=?";
        $stmt = $this->pdo->prepare($sql);
                
        $stmt->bindParam(1,$id, PDO::PARAM_INT);
        $stmt->execute();
        return $results = $stmt->fetch(PDO::FETCH_OBJ);
    }
    

    public function getOthersGradeDetails($table,$resultid){
        $sql = "SELECT * FROM ".$table." WHERE result_id=?";
        $stmt = $this->pdo->prepare($sql);
                
        $stmt->bindParam(1,$resultid, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_OBJ);
        return $results;
    }

    public function deleteResult($resultid){
         $sql ="DELETE from result WHERE result_id=?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1,$resultid, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;    
        }
        return false;
        
    }
}


?>
