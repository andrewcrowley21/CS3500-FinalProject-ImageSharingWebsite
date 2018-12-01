<?php
	require_once('config.php');

	session_start();

	try{

		$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//$pdo = $GLOBALS['']

	}
	catch(PDOException $e){

		die($e->getMessage());
	}


?>