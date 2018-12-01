<?php  

	include 'required.php';
	
	include 'signInFunctions.php';
	include 'redirect.php';
	include 'header.inc.php';
	$_SESSION['userID'] = null;
	//$_SESSION['password'] = null;





?>


<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
    <link rel="stylesheet" href="css/captions.css" />

</head>

<body class="">
	
	<?php //HEADER
			
		?>


	<?php

		

		if(isset($_POST['sign'])){

			$foundUser = false;

			$foundEmail = false;


			$sql = "SELECT Count(UserName) AS userCount FROM User WHERE UserName = ? ";

			$stmt = $pdo->prepare($sql);

			$stmt->bindValue(1,$_POST['user']);

			$stmt->execute();

			while($row = $stmt->fetch()){

				if($row['userCount'] !=0){
					$foundUser = true;
				}
			}

			$sql = "SELECT Count(Email) AS emailCount FROM User WHERE Email = ?";

			$stmt = $pdo->prepare($sql);

			$stmt->bindValue(1,$_POST['email']);

			$stmt->execute();

			while($row = $stmt->fetch()){
				if($row['emailCount'] != 0){
					$foundEmail = true;
				}
			}

			if(($foundEmail == true) and ($foundUser ==true) ){ // if both email and user name are used

				signInUserAndEmail();



			}
			else if($foundEmail == true){ // if email is aready used

				signInEmail();

			}
			else if($foundUser == true){ // user name is already used

				signinUser();

			}
			else{ // add user to data base 

					//get max UID

					$uid;

					$sql = "SELECT MAX(UID) AS max FROM User";

					$stmt = $pdo->prepare($sql);

					$stmt->execute();

					while($row = $stmt->fetch()){
						$uid = ($row['max']) +1;
					}

					//echo $uid;

					$date = new DateTime();

					$time = $date->getTimestamp();


					$sql = "INSERT INTO User(UID,Username,Password,Email,DateOfRegistration,FisrtName,LastName) VALUES(?,?,?,?,?,?,?)";
				
					$stmt= $pdo->prepare($sql);

					$stmt->bindValue(1,$uid);
					$stmt->bindValue(2,$_POST['user']);
					$stmt->bindValue(3,$_POST['pass1']);
					$stmt->bindValue(4,$_POST['email']);
					$stmt->bindValue(5, date("Y-m-d h:i:sa", $time));
					if(isset($_POST['first'])){
						$stmt->bindValue(6,$_POST['first']);
					}
					else{
						$stmt->bindValue(6,'NULL');
					}
					if(isset($_POST['last'])){
						$stmt->bindValue(7,$_POST['last']);
					}
					else{
						$stmt->bindValue(7,'NULL');
					}

					$stmt->execute();

					$_SESSION['userID'] = $uid;

					redirect('profile.php');



			}


		}
		else{
			signUpInfo();
		}


		//Footer
		include 'footer.inc.php';
	?>


	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
       
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    
    <script src="js/signup.js"></script>
    

</body>
</html> 