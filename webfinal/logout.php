<?php  
	include "required.php";
	include "redirect.php";

	session_destroy();

	redirect("login.php");
	
	echo "yah logged out";
?>