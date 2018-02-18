<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Terminal
 *
 * @author samip
 */
class Terminal {
    private $pdo;
    private $terminalId;
    private $terminalName;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    

    public function getAllTerminal(){
        $sql = "Select * from terminal";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $terminal = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $terminal;
    }

    public function getTerminalName($id){
        $sql = "Select terminal_name from terminal where terminal_id = ?";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(1,$id);
        $stmt->execute();

        $terminal = $stmt->fetch(PDO::FETCH_OBJ);

        return $terminal->terminal_name;   
    }

}


?>
