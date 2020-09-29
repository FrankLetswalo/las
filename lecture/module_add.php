<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['add'])){

		$ProductValidation = "/[^0-9]/";
		$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
        $number = "/^[0-9]+$/";
        

        $code = $_POST['subject_code'];
        $name = $_POST['name'];
        $course_code = $_POST['course_code'];
		$lecture = $_POST['lecture'];
		$no_students = $_POST['no_students'];

		if(strlen($code) != 7){
			$_SESSION['error'] = 'Invalid Subject Code Format';
			header('location: modules.php');
			exit();	
		}

		if(!preg_match($number,$no_students)){
			$_SESSION['error'] = 'Invalid Number of Students Format';
			header('location: modules.php');
			exit();	
		}

		if(!preg_match($number,$lecture)){
			$_SESSION['error'] = 'Invalid Lecture Number Format';
			header('location: modules.php');
			exit();	
		}

		if(strlen($lecture) != 9){
			$_SESSION['error'] = 'Invalid Lecture Number Format';
			header('location: modules.php');
			exit();	
		}



		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM subject WHERE subject_code=:code");
		$stmt->execute(['code'=>$code]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Module already exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO subject (subject_code, subject_name, course_code, lecture_number, no_students) VALUES (:code, :name, :course_code, :lecture, :no_students)");
				$stmt->execute(['code'=>$code, 'name'=>$name, 'course_code'=>$course_code, 'lecture'=>$lecture, 'no_students'=>$no_students]);
				$_SESSION['success'] = 'Module added successfully to course '.$course_code;

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up module form first';
	}

	header('location: modules.php');

?>