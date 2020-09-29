<?php
	include 'includes/conn.php';
	session_start();

	if(isset($_SESSION['admin'])){
		header('location: admin/home.php');
	}
	if(isset($_SESSION['lecture'])){
		header('location: lecture/home.php');
	}



	if(isset($_SESSION['user'])){
		$conn = $pdo->open();
		header('location: user/home.php');

		try{
			$stmt = $conn->prepare("SELECT * FROM users WHERE student_no=:student");
			$stmt->execute(['student'=>$_SESSION['student_no']]);
			$user = $stmt->fetch();
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

		$pdo->close();
		header('location: user/home.php');

	}
?>