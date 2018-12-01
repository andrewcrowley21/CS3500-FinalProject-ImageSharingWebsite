<?php
require_once('config.php');
session_start();
	$i = $_POST['image'];
	$cid = $_POST['commentid'];
	$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
		if (mysqli_connect_errno()){
			die(mysqli_connect_error());
		}

		
		
		$sql = "UPDATE comments set Likes = (Likes + 1) where CommentID = '" . $cid . "'";
		$result = mysqli_query($connection, $sql);
		
		header("Location: imagedetail.php?image=" . $i ."");

?>