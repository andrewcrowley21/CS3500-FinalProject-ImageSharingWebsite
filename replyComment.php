<?php require_once('config.php'); 

		date_default_timezone_set("America/Detroit");
		include 'comments.inc.php';
		session_start();
?> 
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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	
	</head>

<body>
    <?php include 'header.inc.php'; ?>
	<main class="container">
	<?php
	
	
	
	$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
						if (mysqli_connect_errno()){
							die(mysqli_connect_error());
						}
		$i = $_GET['image'];
		$cid = $_POST['commentid'];
		$uid = $_POST['uid'];
		$date = $_POST['date'];
		
		
		
		echo "<h3>Reply to comment: " . $cid . "<h3> ";
		
		echo '<form method="post" action="' . replyComment($connection) . '">';
			echo 	'<input type="hidden" name="commentid" value="' . $cid . '">
					<input type="hidden" name="uid" value="' . $uid . '">
					<input type="hidden" name="date" value="' . $date . '">
					<textarea name="message"> </textarea><br>
					';
			echo 	'<button type="submit" name="replySubmit" class="btn btn-default"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"> Reply </span></button>';	
			echo '</form><br>';
	
	?>
	
	</main>
	  <?php include("footer.inc.php"); ?>
   

		
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>
    