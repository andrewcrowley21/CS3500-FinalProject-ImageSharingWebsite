
<?php require_once('config.php'); ?> 


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LiveMusicGram! Homepage</title>

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
	<h4 align="center">The Number 1 Image Sharing site for live concerts. Share photos of your favorite bands here!</h4>
	<p align="center">(Or search for a certain tag above)</p>
	<hr>
	
	<?php
		$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
		if (mysqli_connect_errno()){
			die(mysqli_connect_error());
		}
		echo '<h4>Most Popular Photos:</h4>';
		$sql = "select * from image, user where user.UID = image.UID order by ViewCount DESC";

		if ($result = mysqli_query($connection, $sql)) {	
		// loop through the data
			while ($row = mysqli_fetch_assoc($result)) {
				if($row['Privacy'] == 0) {
					echo '<div class="mainPageImage" align="center">';
					echo '<a href="imagedetail.php?image=' . $row['Title'] . '"><h3 align ="center">' . $row['Title'] . '</h3></a><p> by <a href="#"> ' . $row['Username'] . '</a></p>';
					echo '<a href="imagedetail.php?image=' . $row['Title'] . '"><img src="' . $row['Path'] . '" width="35%" alt="' . $row['Title'] . '" title="' . $row['Title'] . '"></a>';
					echo '<br/><br/>';
					echo '<span style="font-size:2em; padding: 1em;" class="glyphicon glyphicon-eye-open" aria-hidden="true">' . $row['ViewCount'] . '     </span>';
					echo '<span style="font-size:2em; padding: 1em;" class="glyphicon glyphicon-thumbs-up" aria-hidden="true">' . $row['Likes'] . '     </span>';
					echo '<span style="font-size:2em; padding: 1em;" class="glyphicon glyphicon-thumbs-down" aria-hidden="true">' . $row['Dislikes'] . '     </span>';
					echo '</div>';
					echo '<br/>';
					echo '<hr>';
				}
			}
	
			// release the memory used by the result set
			mysqli_free_result($result);
		}

		// close the database connection
		mysqli_close($connection);

	?>
	
	
	
	</main>
    <?php include("footer.inc.php"); ?>
   


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>