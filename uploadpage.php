<?php require_once('config.php'); 
date_default_timezone_set("America/Detroit");
session_start();
?> 
<!DOCTYPE html>

<?php
function getFileUploadForm(){
	
   return '<div class="col-sm-6">
			<form method="post" enctype="multipart/form-data">
		<div class="form-group">
               <label for="file1">Upload a file</label>
               <input type="file" name="file1[]" id="file1" multiple/>
               <p class="help-block" id="errordiv">Browse for a file to be posted.</p>
            </div>
		Title:</br>
		<input type = "text" name="title" id="title"></br></br>
		
		Description:</br>
		<input type = "text" name="description" id="description"></br></br>
		
		Private Photo? (If Yes, only you can see it): </br>
		<div>
			<input type="radio" id="yes" name="private" value="1">
			<label for="yes">Yes</label>
		</div>

		<div>
			<input type="radio" id="no" name="private" value="0" checked>
			<label for="no">No</label>
		</div>
		</br>
		
		Tags (Single-worded, separated by commas):</br>
		<input type = "text" name="tags" id="tags"></br></br>
		
		
		
		
		</br>
		<input type="submit" value="Upload Image" name="submit"></br>
	</form>
	</div>
	<div class="col-sm-6">
	<img src="images/logo.png" title="LiveMusicGram!" alt="LiveMusicGram!"style="position:relative; bottom: -150px" height="200" width="266">
	</div>';
   
}

function outputImageInfo($image) {
	$title = htmlspecialchars($_POST['title']);
	$description = htmlspecialchars($_POST['description']);
	$privacy = htmlspecialchars($_POST['private']);
	$tags = explode(",", htmlspecialchars($_POST['tags']));
	for ($k = 0; $k < count($tags); $k++){
		$tags[$k] = str_replace(' ', '', $tags[$k]);
	}
	echo 'Title: ' . $title . '<br/>';
	echo 'Description: ' . $description . '<br/>';
	
	if ($privacy == 0) {
		echo 'Private?: No';
	}
	else
		echo 'Private?: Yes';
	echo '<br/>';
	echo 'Tags: <br/>';
	for ($i = 0; $i < count($tags); $i++) {		
		echo $tags[$i] . '<br/>';
		
	}
	
	addToDB($image, $title, $description, $privacy, $tags);
	
	
}

function addToDB($image, $title, $description, $privacy, $tags) {
	// $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME); 
	// if ( mysqli_connect_errno()) {
		// die( mysqli_connect_error());
	// } 
try {
		$conn = new PDO(DBCONNSTRING, DBUSER, DBPASS);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$datetime = date("Y-m-d H:i:s");
	$title2 = addslashes($title);
	$user = $_SESSION['userID'];
	$image = "UPLOADS/" . $image;
	/////////////////////////////////////////////////////////////////////
	// $sql1 = "INSERT INTO `image`(`ImageID`, `UID`, `Path`, `Title`, `Description`, `Likes`, `Dislikes`, `ViewCount`, `Privacy`, `Date`) 
				// VALUES('0', '" . $user . "', 'UPLOADS/" . $image . "', '" . $title2 . "', '" . $description . "', '0', '0', '0', 
							// '" . $privacy . "', '" . $datetime . "')";
	
	$sql1 = "INSERT INTO `image`(`UID`, `Path`, `Title`, `Description`, `Likes`, `Dislikes`, `ViewCount`, `Privacy`, `Date`) 
				VALUES(:UID, :Path, :Title, :Description, :Likes, :Dislikes, :ViewCount, :Privacy, :Date)";
	$stmt = $conn->prepare($sql1);
		$likes = 0;
		$dislikes = 0;
		$views = 0;
		
		
		$stmt->bindParam(":UID", $user);
		$stmt->bindParam(":Path", $image);
		$stmt->bindParam(":Title", $title2);
		$stmt->bindParam(":Description", $description);
		$stmt->bindParam(":Likes", $likes);
		$stmt->bindParam(":Dislikes", $dislikes);
		$stmt->bindParam(":ViewCount", $views);
		$stmt->bindParam(":Privacy", $privacy);
		$stmt->bindParam(":Date", $datetime);
		$stmt->execute();						
					
	// if ($conn->query($sql1) === TRUE) {
		// echo "New record created successfully <br>";
	// } else {
		// echo "Error: " . $sql1 . "<br>" . $conn->error . "<br>";
	// }
	
	/////////////////////////////////////////////////////////////////////////
	for ($i = 0; $i < count($tags); $i++) {
	// $sql2 = "INSERT INTO tags (Tag) SELECT * FROM (SELECT '" . $tags[$i] . "') AS tmp 
			// WHERE NOT EXISTS ( SELECT Tag FROM tags WHERE Tag = '" . $tags[$i] . "' ) LIMIT 1";
			
	$sql2 = "INSERT INTO tags (Tag) SELECT * FROM (SELECT :Tag) AS tmp 
			WHERE NOT EXISTS ( SELECT Tag FROM tags WHERE Tag = :Tag) LIMIT 1";
	$stmt = $conn->prepare($sql2);	
	$stmt->bindParam(":Tag", $tags[$i]);	
	$stmt->execute();	
					
	// if ($conn->query($sql2) === TRUE) {
		// echo "New record created successfully <br>";
	// } else {
		// echo "Error: " . $sql2 . "<br>" . $conn->error . "<br>";
	// }
	
	/////////////////////////////////////////////////////////////////////////////////
	// $sql3 = "INSERT INTO `imagetags`(`ImageTagID`, `ImageID`, `TagID`)
					// VALUES('0', (SELECT MAX(imageid) from `image`), (select tagID from `tags` where tag = '" . $tags[$i] . "'))";
					
	$sql3 = "INSERT INTO `imagetags`(`ImageID`, `TagID`)
					VALUES((SELECT MAX(imageid) from `image`), (select tagID from `tags` where tag = :Tag))";
	$stmt = $conn->prepare($sql3);	
	$stmt->bindParam(":Tag", $tags[$i]);	
	$stmt->execute();				
	// if ($conn->query($sql3) === TRUE) {
		// echo "New record created successfully";
	// } else {
		// echo "Error: " . $sql3 . "<br>" . $conn->error;
	// } 
	
	
	}
							
	}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }	
	
	$conn = null;
	
} 


/* moves an uploaded file to our destination location */
function moveFile($fileToMove, $destination, $fileType) {
	$validExt = array("jpg", "jpeg", "png");
	$validMime = array("image/jpeg", "image/png");
	// make an array of two elements, first=filename before extension,
	// and second=extension
	
	
	$components = explode(".", $destination);
	// retrieve just the end component (extension)
	$extension = end($components);
	// check to see if file type is valid
	if (in_array($fileType, $validMime) && in_array($extension, $validExt)) {
		
		move_uploaded_file($fileToMove, "UPLOADS/" . $destination)
			or die("error");
		
		echo $destination . ' Uploaded successfully!<br/> Check it out on your <a href="profile.php?UID=' . $_SESSION['userID'] . '">Profile Page</a><br/><img src="UPLOADS/' . $destination . '" width="30%" height="30%"><br/>';
		echo outputImageInfo($destination);
		
		
		
	}
	else
		echo 'Invalid file type = ' . $fileType . ' Extenstion = ' . 
			$extension . '<br/> File must be either a JPG or PNG. Please go back and try again.';
	
}

?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Upload an Image--LiveMusicGram!</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
    <link rel="stylesheet" href="css/captions.css" />

</head>
<body>
    <?php include 'header.inc.php'; ?>
	
	
	<!-- Page Content -->
    <main class="container">
	<h2 align="center">Upload Image</h2>
		<div class="con">
		<?php 
		//For starters we simply output the form everytime.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//check if user uploaded multiple file
	if (is_array($_FILES["file1"]["error"])) {
		$count = 0;
		foreach ($_FILES["file1"]["error"] as $error) {
			if ($error == UPLOAD_ERR_OK) {
				$clientName = $_FILES["file1"]["name"][$count];
				$serverName = $_FILES["file1"]["tmp_name"][$count];
				$fileType =  $_FILES["file1"]["type"][$count];
				moveFile($serverName, $clientName, $fileType);
				$count++;
			}
		}
	}
	else {
		// user only uploadeda single file
		if ($_FILES["file1"]["error"] == UPLOAD_ERR_OK) {
			$clientName = $_FILES["file1"]["name"];
				$serverName = $_FILES["file1"]["tmp_name"];
				$fileType =  $_FILES["file1"]["type"];
				moveFile($serverName, $clientName, $fileType);
		}
	}
}
else {
	echo getFileUploadForm();
}	
		?>
		</div>
		
	
	
	
	
	</main>
    <?php include("footer.inc.php"); ?>
   


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>