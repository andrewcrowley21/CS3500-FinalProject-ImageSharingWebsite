<?php require_once('config.php'); ?> 
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
    


    <!-- Page Content -->
    <main class="container">
        <div class="row">
            
            <div class="col-md-10">
                <div class="row">
                   
                    <?php   
						$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
						if (mysqli_connect_errno()){
							die(mysqli_connect_error());
						}
						$i = $_GET["image"];
						
						$sql = "update image SET ViewCount = ViewCount + 1 where title = '" . $i . "'";
						if ($result = mysqli_query($connection, $sql)) {	
						
						$sql = "select * from image where title = '" . $i . "'";

						if ($result = mysqli_query($connection, $sql)) {

						}						
						// loop through the data
							while ($row = mysqli_fetch_assoc($result)) {
						
							
							echo '<div class="col-md-8">';
							echo 	'<img class="img-responsive" src="' . $row['Path'] . '" alt="' . $row['Title'] . '" width="70%" style="position:relative; right: -100px">';
							echo 	'<p class="description" align="center">' . $row['Description'] . '</p><hr>';
							
							}
						}
							echo 	'<div id="commentSection">
										<p align="center">Comments On This Photo</p>
										</div>';
							
							echo 	'<form method="post" align="center">
										<div>
										<textarea name="comments" id="comments" style="font-size:1.2em;" width="100%" placeholder="Add a comment!"></textarea>
										</div>
										<input type="submit" value="Submit">';
							echo '</div>';
							
						
						$sql = "SELECT * FROM `user`, `image` WHERE image.UID = user.UID and image.Title = '" . $i . "'";

						if ($result = mysqli_query($connection, $sql)) {	
						// loop through the data
							while ($row = mysqli_fetch_assoc($result)) {
						
							echo '<div class="col-md-4">';                                                
							echo 	'<h2>' . $row['Title'] . '</h2>';

							echo '<div class="panel panel-default">
									<div class="panel-body">
										<ul class="details-list">
											<li>By: <a href="#">' . $row['Username'] . '</a></li>
											<li>Views: ' . $row['ViewCount'] . '
											<li>Likes: ' . $row['Likes'] . '
											<li>Dislikes: ' . $row['Dislikes'] . '
											<li>Taken on: ' . $row['Date'] . '</li>
										</ul>
									</div>
								</div>';
							
							}
						}
							
							
						
							
							// release the memory used by the result set
						mysqli_free_result($result);
						

						// close the database connection
						mysqli_close($connection);
						
					?>
                    
                    
                   

                    

                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            
                            <div class="btn-group" role="group">
                                <button type="button" title="Like" id="Like" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button>
								<script type="text/javascript">
									$(document).ready(function(){
										document.getElementByID("Like").click(function(){

											$.ajax({
												type: 'POST',
												url: 'addLike.php',
												success: function(data) {
													alert(data);
													document.getElementByID("Like").style.backgroundColor = "blue";
													

												}
											});
										});
									});
								</script>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" title="Dislike" id="Dislike" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button>
                            </div>
                            
							<div class="btn-group" role="group">
                                <button type="button" title="Add to Favorites" id="Favorites" class="btn btn-default"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button>
                            </div>
                        </div>

                       <h4>Tags</h4>
                        <div class="panel panel-default">
                            <div class="panel-body" id="tags">
							
							<?php
							$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
							if (mysqli_connect_errno()){
								die(mysqli_connect_error());
							}	
							
							$sql = "select * from image inner join imagetags inner join tags 
								on imagetags.ImageID = image.ImageID and imagetags.TagID = tags.TagID and image.Title = '" . $i . "'";

							if ($result = mysqli_query($connection, $sql)) {	
							// loop through the data
								while ($row = mysqli_fetch_assoc($result)) {
						
									echo '<span class="label label-default">' . $row['Tag'] . '</span> ';
								
								}
							}
							
								// release the memory used by the result set
							mysqli_free_result($result);
						

							// close the database connection
							mysqli_close($connection);
							
							
							
							
							?>
                                                                   
                                
                            </div>
                        </div> 
                        

                    </div>  <!-- end right-info column -->
                </div>  <!-- end row -->
                
                
                
            <!-- Related Projects Row -->

            <!-- /.row -->
                            

            </div>  <!-- end main content area -->
        </div>
    </main>
	
	    <?php include("footer.inc.php"); ?>
   

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>
    