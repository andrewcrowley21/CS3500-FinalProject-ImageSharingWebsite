<?php
require_once('config.php');
session_start();
	$i = $_POST['image'];
	$rid = $_POST['replyid'];
	$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
		if (mysqli_connect_errno()){
			die(mysqli_connect_error());
		}

		
		
		$sql = "UPDATE commentreply set Dislikes = (Dislikes + 1) where ReplyID = '" . $rid . "'";
		$result = mysqli_query($connection, $sql);
		
		header("Location: imagedetail.php?image=" . $i . "");

?>