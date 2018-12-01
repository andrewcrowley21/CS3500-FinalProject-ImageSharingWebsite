<?php 

	include 'required.php';
	include 'logInFunctions.php';
	include 'redirect.php';
	include 'header.inc.php'; 

	$_SESSION['userID'] = null;
	$_SESSION['password'] = null;
	

	

 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>LogIn</title>
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
    <link rel="stylesheet" href="css/captions.css" />
  	
 </head>

 <body >

 	<?php

 		if(isset($_POST['log'])){

 			$user= $_POST['user'];
 			$password = $_POST['password'];

 			$sql = 'SELECT UID, Password FROM User WHERE Username = ?';

 			$stmt = $pdo ->prepare($sql);

 			$stmt->bindValue(1, $user);

 			$stmt->execute();

 			$UID;
 			$rPassword;
 			$found = false;

 			while($row = $stmt->fetch()){
 				$found = true;
 				$UID = $row['UID'];
 				$rPassword = $row['Password'];
 			}

 			if($found){

 				if($rPassword === $password){
 					$_SESSION['userID'] = $UID;
 					$_SESSION['password'] = $rPassword;

 					redirect('profile.php');
 				}
 				else{
 					passwordWrong();
 				}

 				


 			}

 			else{
 				usernameWrong();
 			}


 		}
 		else{

 			LogInfo();

 		}

 	?>

 	<!-- <main class="container">

 		<div class="row">
 			<div class="col-lg-3"></div>
 			<div class="col-lg-6">
 				
 				<form class="form-horizontal" action="login.php" method="post">
 					<h3>Log In or <a href="signup.php">Sign Up!</a></h3>
 					<div class="form-group">
 						<label class="control-label col-lg-3" for= "user">User Name:</label>
 						<div class="col-lg-9">
 							<input type="text" name="user" class="form-control" placeholder="Enter Username">
 						</div>
 					</div>

 					<div class="form-group">
 						<label class="control-label col-lg-3" for="password">Password:</label>
 						<div class="col-lg-9">
 							<input type="password" name="password" class="form-control" placeholder="Enter Password">
 						</div>
 					</div>

 					<div class="form-group">
 						<div class="col-lg-offset-10 col-lg-10">
 							<button type="submit" name="log" value="log" class="btn btn-default">Log In</button>
 						</div>
 						
 					</div>
 				</form>


 			</div>

 			<div class="col-lg-3"></div>
 		</div>

 		
 	</main> -->


 	<?php
 		//FOOTER

 		include 'footer.inc.php';

 	?>

 	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
       
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


 
 </body>
 </html>