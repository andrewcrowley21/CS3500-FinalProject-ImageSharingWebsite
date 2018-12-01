

<?php require_once('config.php'); 
session_start();

date_default_timezone_set("America/Detroit");
function setComments($connection) {
	
	
	
	if (isset($_POST['commentSubmit'])) {
		$i = $_GET['image'];
		$uid = $_POST['uid'];
		$date = $_POST['date'];
		$message = $_POST['message'];
try {
		$conn = new PDO(DBCONNSTRING, DBUSER, DBPASS);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		$sql = "INSERT INTO `comments`(`UID`, `ImageID`, `Comment`, `Date`) 
		VALUES ( :UID, :ImageID, :Comment, :Date)";
		$stmt = $conn->prepare($sql);
		
		
		//$stmt->bindParam("iiiss", "0",$uid,$i,$message,$date);
		//$stmt->bindParam(":CommentID", "NULL");
		$stmt->bindParam(":UID", $_SESSION['userID']);
		$stmt->bindParam(":ImageID", $i);
		$stmt->bindParam(":Comment", $message);
		$stmt->bindParam(":Date", $date);
		$stmt->execute();
		}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
		
		
	}
	
	
	
}

function getComments($connection, $i) {
	
	
	$sql = "SELECT user.UID, Username, CommentID, Comment, comments.Date, comments.Likes, comments.Dislikes, image.ImageID, comments.ImageID FROM `comments`, `user`, `image` 
			where image.ImageID = comments.ImageID AND user.UID = comments.UID and image.ImageID = '" . $i . "'";

	if ($result = mysqli_query($connection, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$cid = $row['CommentID'];
			echo '<div class="comment-box">';
				echo '<strong><a href="profile.php?UID=' . $row['UID'] . '">' . $row['Username'] . '</a></strong>
				 <em>on ' . $row['Date'] . '</em><br>';
				echo '<p>' .$row['Comment'] . '</p><br>
				<strong>Likes: ' . $row['Likes'] . '-----Dislikes: ' . $row['Dislikes'] . '</strong><br>';
				
			echo '<form method="post" action="addCommentLike.php" style="float: left;">';
			echo '<input type="hidden" name="commentid" value="' . $cid . '">';
			echo '<input type="hidden" name="image" value="' . $i . '">';
			echo '<button type="submit" title="commentLike" name="commentLikeSubmit" id="commentLike" value="' . $cid . '" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button>';	
			echo '</form>';
			
			echo '<form method="post" action="addCommentDislike.php">';
			echo '<input type="hidden" name="commentid" value="' . $cid . '">';
			echo '<input type="hidden" name="image" value="' . $i . '">';
			echo '<button type="submit" title="commentDislike" name="commentDislikeSubmit" id="commentDislike" width="50%" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-down aria-hidden="true"></span></button>';	
			echo '</form>';
			
			
			echo '<form method="post" action="replyComment.php?image=' . $i . '">';
			echo 	'<input type="hidden" name="commentid" value="' . $cid . '">
					<input type="hidden" name="uid" value="' . $_SESSION['userID'] . '">
					<input type="hidden" name="date" value="' . date("Y-m-d H:i:s") . '"
					<input type="hidden" name="message" value="' . $row['Comment'] . '">
					';
			echo 	'<button type="submit" title="commentReply" id="commentReply" class="btn btn-default"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"> Reply </span></button>';	
			echo '</form>';
			
			$sql2 = "select * from commentreply, user where user.UID = commentreply.UID AND commentID = '" . $cid . "'";
			if ($result2 = mysqli_query($connection, $sql2)) {
				while ($row2 = mysqli_fetch_assoc($result2)) {
					echo '<div style="position:relative; right: -100px">';
					echo 	'<strong><a href="profile.php?UID=' . $row2['UID'] . '">' . $row2['Username'] . '</a> replied </strong><em>on ' . $row2['Date'] . '</em>
						<p>' . $row2['Comment'] . '</p><br>
						<strong>Likes: ' . $row2['Likes'] . '-----Dislikes: ' . $row2['Dislikes'] . '</strong><br>
						
						<form method="post" action="addCommentReplyLike.php" style="float: left;">
						<input type="hidden" name="replyid" value="' . $row2['ReplyID'] . '">
						<input type="hidden" name="image" value="' . $i . '">
						<button type="submit" title="commentReplyLike" id="commentReplyLike" width="50%" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button>	
						</form>
						
						<form method="post" action="addCommentReplyDislike.php">
						<input type="hidden" name="replyid" value="' . $row2['ReplyID'] . '">
						<input type="hidden" name="image" value="' . $i . '">
						<button type="submit" title="commentReplyDislike" id="commentReplyDislike" width="50%" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-down aria-hidden="true"></span></button>
						</form>
						<br><br>';
					echo '</div>';
					
			
			}
			}
			
			echo '</div><hr>';
		}
	}
	
	
	
}


function replyComment($connection) {
	
	
	
	if (isset($_POST['replySubmit'])) {
		$i = $_GET['image'];
		$cid = $_POST['commentid'];
		$uid = $_POST['uid'];
		$date = $_POST['date'];
		$message = $_POST['message'];
		
	try {
		$conn = new PDO(DBCONNSTRING, DBUSER, DBPASS);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		$sql = "INSERT INTO `commentreply`(`UID`, `CommentID`, `Comment`, `Date`) 
		VALUES (:UID, :CommentID, :Comment, :Date)";
		
		
		$stmt = $conn->prepare($sql);
		
		
		
		$stmt->bindParam(":UID", $uid);
		$stmt->bindParam(":CommentID", $cid);
		$stmt->bindParam(":Comment", $message);
		$stmt->bindParam(":Date", $date);
		$stmt->execute();
		//$result = mysqli_query($connection, $sql);
		
		header("Location: imagedetail.php?image=" . $i ."");
		
		
		}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
		
	}
	
	
	
}



?>
	
