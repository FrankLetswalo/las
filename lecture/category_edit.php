<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];

		$number = "/^[0-9]+$/";

		$code = $_POST['course_code'];
		$name = $_POST['name'];
		$num = $_POST['no_students'];

		if(strlen($code) != 7)
		{
			$_SESSION['error'] = 'Invalid Course Code Format';
			header('location: courses2.php');
			exit();	
		}

		if(!preg_match($number,$num)){
			$_SESSION['error'] = 'Invalid Number of students Format';
			header('location: courses2.php');
			exit();	
		}


		try{
			$stmt = $conn->prepare("UPDATE course SET course_code=:code, course_name=:name, no_students=:num WHERE id=:id");
			$stmt->execute(['code'=>$code, 'name'=>$name, 'num'=>$num, 'id'=>$id]);
			$_SESSION['success'] = 'Course updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit course form first';
	}

	header('location: courses2.php');

?>