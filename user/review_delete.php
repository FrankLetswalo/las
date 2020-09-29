<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['review_id'];
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM reviews WHERE review_id=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'User deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select user to delete first';
	}

	header('location: reviews.php');
	
?>