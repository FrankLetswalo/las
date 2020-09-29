<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM subject WHERE courseID=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'Module deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select module to delete first';
	}

	header('location: modules.php');
	
?>