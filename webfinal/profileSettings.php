<?php
	include "required.php";
	include "redirect.php";
	include 'header.inc.php';
	include 'delete.php';

	// function deleteReplies($id , $image){

	// 	$global


	// 	if($image){

	// 		$sql = "DELETE FROM CommentReply WHERE CommentID = ?";

	// 		$stmt = $pdo->prepare($sql);

	// 		$stmt->bindValue(1,$id);

	// 		$stmt->execute();

	// 	}

	// 	else{
	// 		$sql = "DELETE FROM CommentReply WHERE UID = ?";

	// 		$stmt = $pdo->prepare($sql);

	// 		$stmt->bindValue(1,$id);

	// 		$stmt->execute();

	// 	}


		
	// }
	

	// function deleteComments($id, $image){

	// 	if($image){

	// 		$sql = "SELECT CommentID FROM Comments WHERE ImageID = ?";

	// 		$stmt = $pdo->prepare($sql);

	// 		$stmt->bindValue(1,$id);

	// 		$stmt->execute();

	// 		$result = $stmt->fetchAll();


	// 		foreach($result as $value){
	// 			deleteReplies($value['CommentID']);
	// 		}


	// 		$sql = "DELETE FROM Comments WHERE ImageID = ?";

	// 		$stmt = $pdo->prepare($sql);

	// 		$stmt->bindValue(1,$id);

	// 		$stmt->execute();


	// 	}

	// 	else{

	// 		$sql = "SELECT CommentID FROM Comments WHERE UID = ?";

	// 		$stmt = $pdo->prepare($sql);

	// 		$stmt->bindValue(1,$id);

	// 		$stmt->execute();

	// 		$result = $stmt->fetchAll();


	// 		foreach($result as $value){
	// 			deleteReplies($result['CommentID']);
	// 		}


	// 		$sql = "DELETE FROM Comments WHERE UID = ?";

	// 		$stmt = $pdo->prepare($sql);

	// 		$stmt->bindValue(1,$id);

	// 		$stmt->execute();


	// 	}

		
	// }


	// function deleteFav($id, $image){

	// 	if($image){
	// 		$sql = "DELETE FROM ImageFavorite WHERE ImageID = ?";

	// 		$stmt = $pdo->prepare($sql);

	// 		$stmt->bindValue(1,$id);

	// 		$stmt->execute();

	// 	}

	// 	else{
	// 		$sql = "DELETE FROM ImageFavorite WHERE UID = ?";

	// 		$stmt = $pdo->prepare($sql);

	// 		$stmt->bindValue(1,$id);

	// 		$stmt->execute();

	// 	}
		
	// }


	// function deleteTag($id){
	// 	$sql = "DELETE FROM ImageTags WHERE ImageID = ?";

	// 	$stmt = $pdo->prepare($sql);

	// 	$stmt->bindValue(1,$id);

	// 	$stmt->execute();

	// }

	// function deletePhoto($id){

	// 	//Delete replies on photo
	// 	deleteReplies($id,true);
	// 	//Delete Comments on photo
	// 	deleteComments($id,true);

	// 	//Delete from favorites list
	// 	deleteFav($id,true);

	// 	// delete tags
	// 	deleteTag($id);


	// 	// delete photo
	// 	$sql = "DELETE FROM Image WHERE UID = ?";

	// 	$stmt = $pdo->prepare($sql);

	// 	$stmt->bindValue(1,$id);

	// 	$stmt->execute();

	// }

	// function deleteProfile($id){
	// 	//delete replies 

	// 	deleteReplies($id, false);

	// 	//delete comments

	// 	deleteComments($id, false);

	// 	//delete favs

	// 	deleteFav($id,false);

	// 	//delete photos

	// 	deletePhoto($id);

	// 	//delete profile

	// 	$sql = "DELETE FROM User WHERE UID = ?";

	// 	$stmt = $pdo->prepare($sql);

	// 	$stmt->bindValue($id);

	// 	$stmt->execute();

	// }
	

	$update = false;
	$delete = false;

	$userName;
	$userID = $_SESSION['userID'];
	$first;
	$last;


	if(isset($_POST['update'])){
		$update = true;
	}

	if(isset($_POST['delete'])){
		$delete = true;

	}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Settings</title>
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
    <link rel="stylesheet" href="css/captions.css" />

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
       
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</head>
<body>

	<?php
		if($update){

			if($_POST['update'] ==1){ ///////////////////////////////////////////////////////////////////update

				$sql= "SELECT * FROM User WHERE UID = ?";

				$stmt = $pdo->prepare($sql);

				$stmt->bindValue(1,$userID);

				$stmt->execute();

				$result = $stmt->fetchAll();

				foreach($result as $value){
					$userName = $value['Username'];
					$first = $value['FisrtName'];
					$last = $value['LastName'];
				}

				echo '<main class="container">

		<div class="row">
		<div class="col-lg-1"></div>


			<div class="col-lg-10">

 				<form class="form-horizontal" action="profileSettings.php" method="post">
 						
 						<div class="form-group">

 							<label class="control-label col-lg-3" for="user">User Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="user" class="from-control" value="'.$userName.'" >
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="first">First Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="first" class="from-control" value="'.$first.'">
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="last">Last Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="last" class="from-control" value="'.$last.'">
 							</div>
 						</div>


 						<div class="form-group">
 							<label class="control-label col-lg-3" for="pass1">Password:</label>
 							<div class="col-lg-9">
 								<input type="password" name="pass1" class="from-control"  id="pass1" placeholder="Enter Password" >
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="pass2">Password:</label>
 							<div class="col-lg-9">
 								<input type="password" name="pass2" class="from-control" id="pass2" onChange = "checkPassord();" placeholder="Re-Enter Password">
 							</div>
 						</div>

 						<div class="form-group">
 							<div class="col-lg-offset-5 col-lg-12" id="button1">
 								
 							</div>
 							
 						</div>


 				</form>

 			</div>

 			<div class="col-lg-1"></div>

 		</div>
		
	</main>';



			}
			else{ //update db

				$sql = "UPDATE User SET Username = ?, FisrtName = ?, LastName = ?, Password = ? WHERE UID =?";

				$stmt = $pdo->prepare($sql);

				$stmt->bindValue(1,$_POST['user']);
				$stmt->bindValue(2, $_POST['first']);
				$stmt->bindValue(3, $_POST['last']);
				$stmt->bindValue(4,$_POST['pass1']);
				$stmt->bindValue(5,$userID);

				$stmt->execute();

				redirect("profile.php");

			}

		}
		else if($delete){ //////////////////////////////////////////////////////////////delete

			if($_POST['delete'] ==1){

				echo '<div style="margin-left: 600px; margin-right: 600px;">
						<div class="alert alert-danger" style="text-align: center">

							<h3>Do you want so delete your user account?</h3><br>

							<form action="profileSettings.php" method="post">
								<button type="submit" name="delete" value="2" style="color: black">Yes</button>
							</form>
							<p>  </p>
							<form action ="profile.php">
								<button type="submit" style="color: black">No</button>
							</form>
		
						</div>

					</div>';



			}
			else{
				deleteProfile($userID);

				redirect("logout.php");

			}

		}
		else{

			echo '<div class="row">
		<div class="col-lg-4">
			
		</div>

		<div class="col-lg-4" style="text-align: center;">
			<form class="form-inline" action="profileSettings.php" method="post">
				<div  class="form-group">
					<label for="update"> Update Profile Information: </label>
					<button type="submit" name="update" value="1">Update</button>
				</div>

				<div class="form-group">
					<label for="delete"> Delete Profile: </label>
					<button type="submit" name="delete" value="1">Delete</button>
					
				</div>
			</form>
		</div>

		<div class="col-lg-4">
			
		</div>
		
	</div>';

		}

	?>

	<?php
 		//FOOTER

 		include 'footer.inc.php';

 	?>



 	<script src="js/update.js"></script>



</body>
</html>