<?php
/**
* subject class
*/
class Subject
{
	private $pdo;
	
    private $subjectName;
	private $className;
    private $totalMarks;
    private $practical;
    private $creditHrs;
    
    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function checkSubjectandClass($subjectname,$classname){
        $sql = "Select * from subject where subject_name = ? and class_name = ?";

        $stmt = $this->pdo->prepare($sql);
                
        $stmt->bindParam(1,$subjectname, PDO::PARAM_STR);
        $stmt->bindParam(2,$classname, PDO::PARAM_STR);


        $stmt->execute();

        $count = $stmt->rowCount();
        if($count > 0){
            return true;
        }
        else{
            return false;
        }
                  
    }


    public function getSubjectDetails($subjectid){
        $sql = "SELECT * FROM subject where subject_id=?";
        $stmt = $this->pdo->prepare($sql);
                
        $stmt->bindParam(1,$subjectid, PDO::PARAM_INT);
        $stmt->execute();
        return $subject = $stmt->fetch(PDO::FETCH_OBJ);
    }
        

    public function insertIntoSubject($subjectname,$subjectslug,$classname,$practical,$thoerymarks,$practicalmarks,$totalmarks,$credit){
        $sql = "INSERT INTO subject(subject_name, subject_slug, class_name, practical, theory_mark, practical_mark, total_mark, credit_hrs) VALUES (?,?,?,?,?,?,?,?)";
            
            $stmt = $this->pdo->prepare($sql);
            
            $stmt->bindParam(1,$subjectname, PDO::PARAM_STR);
            $stmt->bindParam(2,$subjectslug, PDO::PARAM_STR);
            $stmt->bindParam(3,$classname, PDO::PARAM_STR);  
            $stmt->bindParam(4,$practical, PDO::PARAM_INT);
            $stmt->bindParam(5,$thoerymarks, PDO::PARAM_INT);
            $stmt->bindParam(6,$practicalmarks, PDO::PARAM_INT);
            $stmt->bindParam(7,$totalmarks, PDO::PARAM_INT);             
            $stmt->bindParam(8,$credit, PDO::PARAM_INT);
            
            // var_dump($stmt);
            $stmt->execute();
            
            return true;
        }

    public function insertSubjectDetails($table,$fields= array()){
        $columns = implode(',', array_keys($fields));
        $values = ':'.implode(', :', array_keys($fields));
        $resultid=null;
        $sql = "Insert into {$table} ({$columns}) values ({$values})";

        if($stmt = $this->pdo->prepare($sql)){
            foreach ($fields as $key => $value) {
                $stmt->bindValue(':'.$key,$value);
            }
            // var_dump($stmt);
            if ($stmt->execute()) {
                return true;
            }

            return false;
            
            
        }
    }

    public function insertSubject($subjectname,$classname,$practical,$thoerymarks,$practicalmarks,$totalmarks,$credit){
       $sql = "INSERT INTO subject (subject_name, class_name, practical, theory_mark, practical_mark, total_mark, credit_hrs) VALUES  (:subject_name,:class_name,:practical,:thoery_mark,:practical_mark,:total_mark,:credit_hrs);";

        $stmt = $this->pdo->prepare($sql);
            
        $stmt->bindValue(":subject_name",$subjectname, PDO::PARAM_STR);
        $stmt->bindValue(":class_name",$classname, PDO::PARAM_STR);                
        $stmt->bindValue(":practical",$practical, PDO::PARAM_INT);             
        $stmt->bindValue(":thoery_mark",$thoerymarks, PDO::PARAM_INT);
        $stmt->bindValue(":practical_mark",$practicalmarks, PDO::PARAM_INT);
        $stmt->bindValue(":total_mark",$totalmarks, PDO::PARAM_INT);
        $stmt->bindValue(":credit_hrs",$credit, PDO::PARAM_INT);

        $stmt->execute();
            
        return true;
        
        
    }

    public function getSubjects($class){
        $sql = "Select * from subject where class_name = ? && visible= 1 ORDER BY class_name";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1,$class, PDO::PARAM_STR);
            
        $stmt->execute();

        $subjects = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $subjects;
    }

    public function editSubject($class,$subjectID){
        $sql = "Select * from subject where class_name =? and subject_id = ?";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1,$class, PDO::PARAM_STR);
        $stmt->bindParam(2,$subjectID, PDO::PARAM_INT);
            
        $stmt->execute();

        $subjects = $stmt->fetch(PDO::FETCH_OBJ);

        return $subjects;
    }

    public function checkSubjectForClass($subjectname,$classname){
        $sql = "Select * from subject where subject_name = ? and class_name = ?";

        $stmt = $this->pdo->prepare($sql);
                
        $stmt->bindParam(1,$subjectname, PDO::PARAM_STR);
        $stmt->bindParam(2,$classname, PDO::PARAM_STR);


        $stmt->execute();

        $count = $stmt->rowCount();
        if($count > 1){
            return true;
        }
        else{
            return false;
        }
                  
    }
   
    public function updateSubject($id,$subjectname,$classname,$practical,$thoerymarks,$practicalmarks,$totalmarks,$credit){
        // $sql="UPDATE subject SET subject_name= :subject_name, 
        //                         class_name=:class_name, 
        //                         practical=:practical, 
        //                         thoery_mark=:thoery_mark,
        //                         practical_mark=:practical_mark,
        //                         total_mark=:total_mark,
        //                         credit_hrs=:credit_hrs 
        //                     WHERE subject_id=:subjectid;";
         $sql="UPDATE subject SET subject_name=?,class_name=?,practical=?,theory_mark=?,practical_mark=?,total_mark=?,credit_hrs=? WHERE subject_id=?";

        $stmt = $this->pdo->prepare($sql);

        // $stmt->bindValue(":subject_name",$subjectname, PDO::PARAM_STR);
        // $stmt->bindValue(":class_name",$classname, PDO::PARAM_STR);                
        // $stmt->bindValue(":practical",$practical, PDO::PARAM_INT);             
        // $stmt->bindValue(":thoery_mark",$thoerymarks, PDO::PARAM_INT);
        // $stmt->bindValue(":practical_mark",$practicalmarks, PDO::PARAM_INT);
        // $stmt->bindValue(":total_mark",$totalmarks, PDO::PARAM_INT);
        // $stmt->bindValue(":credit_hrs",$credit, PDO::PARAM_INT);
        // $stmt->bindValue(":subjectid",$id, PDO::PARAM_INT);

        $stmt->bindParam(1,$subjectname, PDO::PARAM_STR);
        $stmt->bindParam(2,$classname, PDO::PARAM_STR);                
        $stmt->bindParam(3,$practical, PDO::PARAM_INT);             
        $stmt->bindParam(4,$thoerymarks, PDO::PARAM_INT);
        $stmt->bindParam(5,$practicalmarks, PDO::PARAM_INT);
        $stmt->bindParam(6,$totalmarks, PDO::PARAM_INT);
        $stmt->bindParam(7,$credit, PDO::PARAM_INT);
        $stmt->bindParam(8,$id, PDO::PARAM_INT);

        // var_dump($stmt);

        if($stmt->execute()){
            return true;
        }
        return false;
        
    }

    public function deleteSubject($subjectID){
        $sql ="UPDATE subject SET visible=? WHERE subject_id=?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1,intval(0), PDO::PARAM_INT);
        $stmt->bindParam(2,$subjectID, PDO::PARAM_INT);

        $stmt->execute();
        return true;
    }
       
}

?>