<?php
	include 'required.php';
	include 'redirect.php';
	include 'header.inc.php';

	//FOR TESTINF REMOVE WHEN DONE//
	//$_SESSION['userID'] =null;
	//FOR TESTINF REMOVE WHEN DONE//

	//echo $_SESSION['userID'];

	$userName;
	$first;
	$last;
	$date;
	$userID;

	$isUser = false;

	$isMine = false;


	if(isset($_SESSION['userID'])){
		$isUser = true;

		if(isset($_GET['UID'])){
			if($_SESSION['userID'] == $_GET['UID']){ //looking at own profle from a username link
				$isMine = true;

				$userID = $_SESSION['userID'];

				$sql = "SELECT * FROM User WHERE UID = ?";

				$stmt = $pdo->prepare($sql);

				$stmt->bindValue(1, $userID);

				$stmt->execute();

				while($row = $stmt->fetch()){
					$userName=$row['Username']; 
					$first = $row['FisrtName'];
					$last = $row['LastName'];
					$date = explode(" ",$row['DateOfRegistration']);
				}


			}
			else{ // not my profle
				$isMine= false;

				$userID = $_GET['UID'];

				$sql = "SELECT * FROM User WHERE UID = ?";

				$stmt = $pdo->prepare($sql);

				$stmt->bindValue(1, $userID);

				$stmt->execute();

				while($row = $stmt->fetch()){
					$userName=$row['Username']; 
					$first = $row['FisrtName'];
					$last = $row['LastName'];
					$date = explode(" ",$row['DateOfRegistration']);
				}

			}
		}

		else{// click profile button or just logged in 

				$isMine = true;

				$userID = $_SESSION['userID'];

				$sql = "SELECT * FROM User WHERE UID = ?";

				$stmt = $pdo->prepare($sql);

				$stmt->bindValue(1, $userID);

				$stmt->execute();

				while($row = $stmt->fetch()){
					$userName=$row['Username']; 
					$first = $row['FisrtName'];
					$last = $row['LastName'];
					$date = explode(" ",$row['DateOfRegistration']);
				}

		}
	}
	else{} // Not a user or not log in


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" type="text/css" href="css/profileCSS.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/gallery.css"> -->


    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
       
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body class=>

	<!-- <h1>Hey you made it!</h1> -->


	<?php

		if($isUser){

			if($isMine){

				echo '<h2>Welcome '.$userName.'</h2>';

				echo '<div class="row container-fluid">

						<div class="col-lg-9">

							<div class="container">

								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#Uploads">Uploads</a></li>
									<li><a data-toggle="tab" href="#Favorites">Favorites</a></li>		
								</ul>

								<div class="tab-content" >
									<div id="Uploads" class="tab-pane fade in active">

									<img src="" title="">
						';

						$i = 0;

							//echo $i%3;

							//echo "this is i before: " . $i;

							$sql= "SELECT * FROM Image WHERE UID = ?";

							$stmt = $pdo->prepare($sql);

							$stmt->bindValue(1,$userID);

							$stmt->execute();

							$result = $stmt->fetchAll();

							//echo count($result);


							for($i =0; $i<count($result); $i++){

								if( $i%2 ==0){
									//echo '<div class="row">';
								}

								echo '<div class="gallery col-lg-6">
  										<a href="imagedetial.php?image='.$result[$i]['ImageID'].'">
    										<img src="'.$result[$i]['Path'].'" alt="'.$result[$i]['Title'].'" width="300" height="300" title="'.$result[$i]['Title'].'">
 										 </a>
 										 <hr>
 									   </div>';	

								if( (($i%2) !=0) and ($i != 0) ){

									echo "</br>";
								}

								//echo "i = " . $i;

	
							}

							echo '</div>

					<div id="Favorites" class="tab-pane fade">';


						// get imageIDs from favorite table 
							$sql = "SELECT ImageID FROM ImageFavorite WHERE UID = ?";

							$stmt = $pdo->prepare($sql);

							$stmt->bindValue(1,$userID);//change for approatiate place

							$stmt->execute();

							$result = $stmt->fetchAll();

							//get image info from image table based on image ID

							$x =0;

							foreach($result as $value){
								$sql= "SELECT * FROM Image WHERE ImageID = ?";

								$stmt =$pdo->prepare($sql);

								$stmt->bindValue(1, $value['ImageID']);

								$stmt->execute();

								while($row = $stmt->fetch()){

									echo '<div class="gallery col-lg-6">
  										<a href="imagedetial.php?image='.$row['ImageID'].'">
    										<img src="'.$row['Path'].'" alt="'.$row['Title'].'" width="300" height="300" title="'.$row['Title'].'">
 										 </a>
 										 <hr>
 									   </div>';	

									if( (($x%2) !=0) and ($x != 0) ){

										echo "</br>";
									}


								}
								$x++;

							}


					echo '</div>
					
				</div>
				
			</div>
			
		</div>

		<div class="col-lg-2">

			<div class="container-fluid">
				<div class="panel panel-default">
					<div class="panel-heading">
						Profile Information
					</div>
					<div class="panel-body">
						User Name: '.$userName.'<br>
						Name: '.$first. ' ' . $last.'<br>
						Join Date: '.$date[0].'
					</div>
					<div class="panel-footer">
						<a id="settingLink" href="profileSettings.php">Edit Profile</a>
					</div>
				</div>
			</div>
			
		</div>

		
		
	</div>
';


			}

			else{

				echo '<div class="row container-fluid">

						<div class="col-lg-9">

							<div class="container">

								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#Uploads">Uploads</a></li>
									<li><a data-toggle="tab" href="#Favorites">Favorites</a></li>		
								</ul>

								<div class="tab-content" >
									<div id="Uploads" class="tab-pane fade in active">

									<img src="" title="">
						';

						$i = 0;

							//echo $i%3;

							//echo "this is i before: " . $i;

							$sql= "SELECT * FROM Image WHERE UID = ?";

							$stmt = $pdo->prepare($sql);

							$stmt->bindValue(1,$userID);

							$stmt->execute();

							$result = $stmt->fetchAll();

							//echo count($result);


							for($i =0; $i<count($result); $i++){

								if( $i%2 ==0){
									//echo '<div class="row">';
								}

								echo '<div class="gallery col-lg-6">
  										<a href="imagedetial.php?image='.$result[$i]['ImageID'].'">
    										<img src="'.$result[$i]['Path'].'" alt="'.$result[$i]['Title'].'" width="300" height="300" title="'.$result[$i]['Title'].'">
 										 </a>
 										 <hr>
 									   </div>';	

								if( (($i%2) !=0) and ($i != 0) ){

									echo "</br>";
								}

								//echo "i = " . $i;

	
							}

							echo '</div>

					<div id="Favorites" class="tab-pane fade">';


						// get imageIDs from favorite table 
							$sql = "SELECT ImageID FROM ImageFavorite WHERE UID = ?";

							$stmt = $pdo->prepare($sql);

							$stmt->bindValue(1,$userID);//change for approatiate place

							$stmt->execute();

							$result = $stmt->fetchAll();

							//get image info from image table based on image ID

							$x =0;

							foreach($result as $value){
								$sql= "SELECT * FROM Image WHERE ImageID = ?";

								$stmt =$pdo->prepare($sql);

								$stmt->bindValue(1, $value['ImageID']);

								$stmt->execute();

								while($row = $stmt->fetch()){

									echo '<div class="gallery col-lg-6">
  										<a href="imagedetial.php?image='.$row['ImageID'].'">
    										<img src="'.$row['Path'].'" alt="'.$row['Title'].'" width="300" height="300" title="'.$row['Title'].'">
 										 </a>
 										 <hr>
 									   </div>';	

									if( (($x%2) !=0) and ($x != 0) ){

										echo "</br>";
									}


								}
								$x++;

							}


					echo '</div>
					
				</div>
				
			</div>
			
		</div>

		<div class="col-lg-2">

			<div class="container-fluid">
				<div class="panel panel-default">
					<div class="panel-heading">
						Profile Information
					</div>
					<div class="panel-body">
						User Name: '.$userName.'<br>
						Name: '.$first. ' ' . $last.'<br>
						Join Date: '.$date[0].'
					</div>
				</div>
			</div>
			
		</div>

		
		
	</div>
';



			}

		}

		else{

			echo '<div class="alert alert-danger">
					<h2>Sorry you must be logged in to view a user profile!</h2><br>
					<h3>Please <a href="login.php">Log In</a> or <a href="signup.php">Sign Up</a></h3>
					</div>';

		}
	?>
						
					
	<?php
 		//FOOTER

 		include 'footer.inc.php';

 	?>



	




</body>
</html>