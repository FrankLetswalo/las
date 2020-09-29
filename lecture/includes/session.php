<?php
	include '../includes/conn.php';
	session_start();

	if(!isset($_SESSION['lecture']) || trim($_SESSION['lecture']) == ''){
		header('location: ../index.php');
		exit();
	}

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM lecture WHERE staff_no=:staff");
	$stmt->execute(['staff'=>$_SESSION['lecture']]);
	$admin = $stmt->fetch();

	$pdo->close();

?>