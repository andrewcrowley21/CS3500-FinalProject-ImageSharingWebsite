<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LiveMusicGram!</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
	
	
</head>

<body>
    <?php include 'header.inc.php'; ?>
<?php
require_once('config.php');
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
							if (mysqli_connect_errno()){
								die(mysqli_connect_error());
							}	
							
	$i = $_GET['image'];
	$sql = "Delete from comments where imageID = '" . $i . "'";

		$result = mysqli_query($connection, $sql);
		
		$sql = "Delete from image where imageID = '" . $i . "'";

		$result = mysqli_query($connection, $sql);
		
		
		echo '<p align="center">Photo has been deleted.<br>Return to the <a href="index.php">home page</a> or back to your profile.<br>';
		echo '<img src="images/logo.png" align="center" title="LiveMusicGram!" alt="LiveMusicGram! height="200" width="266"></p>';
?>

  <?php include("footer.inc.php"); ?>
   

		
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>
    