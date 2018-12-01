<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
		var getUrlParameter = function getUrlParameter(sParam) {
			var sPageURL = window.location.search.substring(1),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

			for (i = 0; i < sURLVariables.length; i++) {
				sParameterName = sURLVariables[i].split('=');
			
				if (sParameterName[0] === sParam) {
					return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
				}
			}
		};
		$(document).ready(function() {
			var image = getUrlParameter('image');
			$("#Like").click(function() {
				
				$("#updateStuff").load("addLike.php", {
					likedImage: image
				});
				
			});
		});
		
		$(document).ready(function() {
			var image = getUrlParameter('image');
			$("#Dislike").click(function() {
				
				$("#updateStuff").load("addDislike.php", {
					dislikedImage: image
				});
				
			});
		});
		
		$(document).ready(function() {
			var image = getUrlParameter('image');
			$("#Favorites").click(function() {
				
				$("#updateStuff").load("addtoFavorites.php", {
					favImage: image
				});
				alert("Image added to your favorites!");
			});
		});
	
	</script>

<?php
	require_once('config.php');
	session_start();
	$i = $_POST['favImage'];
	$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
		if (mysqli_connect_errno()){
			die(mysqli_connect_error());
		}
		
		$sql = "INSERT INTO `imagefavorite`(`ImageFavoriteID`, `UID`, `ImageID`) 
		VALUES (NULL, (select user.UID from image, user where user.UID = image.UID and ImageID = '". $i . "'),
		(select ImageID from image, user where user.UID = image.UID and ImageID = '" . $i . "'))";
		if ($result = mysqli_query($connection, $sql)) {	
			
			
		}
		$sql = "SELECT * FROM `user`, `image` WHERE image.UID = user.UID and image.ImageID = '" . $i . "'";
		
		if ($result = mysqli_query($connection, $sql)) {	
		
		// loop through the data
							while ($row = mysqli_fetch_assoc($result)) {
						
							
									echo'	<div class="panel panel-default" id="leftSide">
											<div class="panel-body">
										<ul class="details-list">
											<li>By: <a href="#">' . $row['Username'] . '</a></li>
											<li>Views: ' . $row['ViewCount'] . '</li>
											<li>Likes: ' . $row['Likes'] . '</li>
											<li>Dislikes: ' . $row['Dislikes'] . '</li>
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
                                <button type="button" title="Like" id="Like" class="btn btn-default"disabled><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button>
								
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" title="Dislike" id="Dislike" class="btn btn-default"disabled><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button>
                            </div>
                            
							<div class="btn-group" role="group">
                                <button type="button" title="Add to Favorites" id="Favorites" class="btn btn-default" disabled><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button>
                            </div>
                        </div>
						</div>