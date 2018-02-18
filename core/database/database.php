<?php

	$dsn = 'mysql:host=localhost; dbname=schoolresult';
	$user ='root';
	$password = '';

	try{
		$pdo = new PDO($dsn, $user, $password);
	}
	catch(PDOException $ex){
		echo "Connection error ".$ex->getMessage();
	}
?>