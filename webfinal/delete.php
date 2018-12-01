<?php


	
	function deleteReplies($id , $image){

			//$pdo = $Globa


		if($image){

			$sql = "DELETE FROM CommentReply WHERE CommentID = ?";

			$stmt = $GLOBALS['pdo']->prepare($sql);

			$stmt->bindValue(1,$id);

			$stmt->execute();

		}

		else{
			$sql = "DELETE FROM CommentReply WHERE UID = ?";

			$stmt = $GLOBALS['pdo']->prepare($sql);

			$stmt->bindValue(1,$id);

			$stmt->execute();

		}


		
	}
	

	function deleteComments($id, $image){

		if($image){

			$sql = "SELECT CommentID FROM Comments WHERE ImageID = ?";

			$stmt = $GLOBALS['pdo']->prepare($sql);

			$stmt->bindValue(1,$id);

			$stmt->execute();

			$result = $stmt->fetchAll();


			foreach($result as $value){
				deleteReplies($value['CommentID']);
			}


			$sql = "DELETE FROM Comments WHERE ImageID = ?";

			$stmt = $GLOBALS['pdo']->prepare($sql);

			$stmt->bindValue(1,$id);

			$stmt->execute();


		}

		else{

			$sql = "SELECT CommentID FROM Comments WHERE UID = ?";

			$stmt = $GLOBALS['pdo']->prepare($sql);

			$stmt->bindValue(1,$id);

			$stmt->execute();

			$result = $stmt->fetchAll();


			foreach($result as $value){
				deleteReplies($result['CommentID'], false);
			}


			$sql = "DELETE FROM Comments WHERE UID = ?";

			$stmt = $GLOBALS['pdo']->prepare($sql);

			$stmt->bindValue(1,$id);

			$stmt->execute();


		}

		
	}


	function deleteFav($id, $image){

		if($image){
			$sql = "DELETE FROM ImageFavorite WHERE ImageID = ?";

			$stmt = $GLOBALS['pdo']->prepare($sql);

			$stmt->bindValue(1,$id);

			$stmt->execute();

		}

		else{
			$sql = "DELETE FROM ImageFavorite WHERE UID = ?";

			$stmt = $GLOBALS['pdo']->prepare($sql);

			$stmt->bindValue(1,$id);

			$stmt->execute();

		}
		
	}


	function deleteTag($id){
		$sql = "DELETE FROM ImageTags WHERE ImageID = ?";

		$stmt = $GLOBALS['pdo']->prepare($sql);

		$stmt->bindValue(1,$id);

		$stmt->execute();

	}

	function deletePhoto($id){

		//Delete replies on photo
		deleteReplies($id,true);
		//Delete Comments on photo
		deleteComments($id,true);

		//Delete from favorites list
		deleteFav($id,true);

		// delete tags
		deleteTag($id);


		// delete photo
		$sql = "DELETE FROM Image WHERE UID = ?";

		$stmt = $GLOBALS['pdo']->prepare($sql);

		$stmt->bindValue(1,$id);

		$stmt->execute();

	}

	function deleteProfile($id){
		//delete replies 

		deleteReplies($id, false);

		//delete comments

		deleteComments($id, false);

		//delete favs

		deleteFav($id,false);

		//delete photos

		deletePhoto($id);

		//delete profile

		$sql = "DELETE FROM User WHERE UID = ?";

		$stmt = $GLOBALS['pdo']->prepare($sql);

		$stmt->bindValue(1,$id);

		$stmt->execute();

	}
?>