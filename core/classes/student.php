<?php
/**
 * Description of student
 *
 * @author samip
 */
class Student {
    public $pdo;


    function __construct($pdo) {
        $this->pdo = $pdo;
    }

   public function checkStudent($class,$rollno,$section){
        $sql = "Select * from student where class_name = ? and roll_no = ? and section = ?";

            $stmt = $this->pdo->prepare($sql);
                    
            $stmt->bindParam(1,$class, PDO::PARAM_STR);
            $stmt->bindParam(2,$rollno, PDO::PARAM_INT);
            $stmt->bindParam(3,$section, PDO::PARAM_STR);

            $stmt->execute();

            $count = $stmt->rowCount();
            if($count > 0){
                return true;
            }
            else{
                return false;
            }
   }

   public function insertStudent($table,$fields=array()){
        $columns = implode(',', array_keys($fields));
        $values = ':'.implode(', :', array_keys($fields));

        $sql = "Insert into {$table} ({$columns}) values ({$values})";

        if($stmt = $this->pdo->prepare($sql)){
            foreach ($fields as $key => $value) {
                $stmt->bindValue(':'.$key,$value);
            }
            $stmt->execute();
            return true;
        }
        else{
            return false;
        }

   }

   public function getStudents($class){
        $sql = "Select * from student where class_name = ? ORDER By roll_no";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1,$class, PDO::PARAM_STR);
            
        $stmt->execute();

        $students = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $students;
    }

    public function editStudent($class,$studentID){
        $sql = "Select * from student where class_name =? and id = ?";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1,$class, PDO::PARAM_STR);
        $stmt->bindParam(2,$studentID, PDO::PARAM_INT);
            
        $stmt->execute();

        $students = $stmt->fetch(PDO::FETCH_OBJ);

        return $students;
    }

    public function checkClassStudentRollNo($class,$rollno,$section){
        $sql = "Select * from student where class_name = ? and roll_no = ? and section = ?";

            $stmt = $this->pdo->prepare($sql);
                    
            $stmt->bindParam(1,$class, PDO::PARAM_STR);
            $stmt->bindParam(2,$rollno, PDO::PARAM_INT);
            $stmt->bindParam(3,$section, PDO::PARAM_STR);

            $stmt->execute();

            $count = $stmt->rowCount();
            if($count > 1){
                return true;
            }
            else{
                return false;
            }
   }

    public function updateStudent($id,$studentname,$classname,$rollno,$section,$year){
        $sql="UPDATE student SET student_name=:studentname, 
                                class_name=:classname, 
                                roll_no=:rollno, 
                                section=:section, 
                                current_year=:year 
                            WHERE id=:id ;";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(":studentname",$studentname, PDO::PARAM_STR);
        $stmt->bindValue(":classname",$classname, PDO::PARAM_STR);
        $stmt->bindValue(":rollno",$rollno, PDO::PARAM_INT);
        $stmt->bindValue(":section",$section, PDO::PARAM_STR);
        $stmt->bindValue(":year",$year, PDO::PARAM_STR);
        $stmt->bindValue("id",$id, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function deleteStident($studentID){
        $sql ="DELETE from student WHERE id=?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1,$studentID, PDO::PARAM_INT);

        $stmt->execute();
        return true;
    }

    //getting student based on year
    public function getStudentThroughYear($classname,$year){
         $sql = "Select * from student where class_name = ? and current_year=? ORDER BY CAST(roll_no AS UNSIGNED INTEGER)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1,$classname, PDO::PARAM_STR);
        $stmt->bindParam(2,$year, PDO::PARAM_STR);
            
        $stmt->execute();

        $students = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $students;
    }


    //get student id using jquery and ajax
    public function getStudent($studentid){
        $sql = "Select * from student where  id= ?";

            $stmt = $this->pdo->prepare($sql);
                    
            $stmt->bindParam(1,$studentid, PDO::PARAM_STR);
            
            $stmt->execute();
                
            $students = $stmt->fetch(PDO::FETCH_OBJ);
            
            return $students;
    }

    public function upgradeStudent($classname,$year,$studentid){
        $sql="UPDATE student SET class_name=?,current_year=? WHERE id=?";

        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(1,$classname, PDO::PARAM_STR);
        $stmt->bindParam(2,$year, PDO::PARAM_STR);
        $stmt->bindParam(3,$studentid, PDO::PARAM_INT);

        // var_dump($stmt);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
