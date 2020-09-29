<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){

		$name = "/^[a-zA-Z ]+$/";
		$emailValidation = "/^[_a-zA-Z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
		$number = "/^[0-9]+$/";
		$addressValidation = "/^[A-Za-z0-9'\.\-\s\,]+$/";

		$student_no = $_POST['student_no'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$id = $_POST['id_no'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$course = $_POST['course_code'];
		$password = $_POST['password'];
		
		
		if(!preg_match($number,$student_no) || strlen($student_no) != 9){
			$_SESSION['error'] = 'Invalid Student Number';
			header('location: students.php');
			exit();	
		}

		if(!preg_match($name,$firstname)){
			$_SESSION['error'] = 'Invalid First Name Format';
			header('location: students.php');
			exit();	
		}
		if(!preg_match($name,$lastname)){
			$_SESSION['error'] = 'Invalid Last Name Format';
			header('location: students.php');
			exit();	
		}
		if(!preg_match($number,$id) || strlen($id) != 13){
			$_SESSION['error'] = 'Invalid ID Number';
			header('location: students.php');
			exit();	
		}
		if(!preg_match($emailValidation,$email)){
			$_SESSION['error'] = 'Invalid Email Please Enter correct Email';
			header('location: students.php');
			exit();	
		}
		if(!preg_match($number,$contact) || strlen($contact) != 10){
			$_SESSION['error'] = 'Invalid Number Format';
			header('location: students.php');
			exit();	
		}
		if(strlen($password) < 8){
			$_SESSION['error'] = 'Password must be atleast 8 characters';
			header('location: students.php');
			exit();	
		}
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM student WHERE student_no=:student");
		$stmt->execute(['student'=>$student_no]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Student already exist';
		}
		else{
			// $password = password_hash($password, PASSWORD_DEFAULT);
			// $filename = $_FILES['photo']['name'];
			$now = date('Y-m-d');
			
			try{
				$stmt = $conn->prepare("INSERT INTO student (student_no, firstname, lastname, id_number, email, contact_no,  password, course_code date_registered) VALUES (:student_no, :firstname, :lastname, :id, :email, :contact_no, :password, :course, :now)");
				$stmt->execute(['student_no'=>$student_no, 'firstname'=>$firstname, 'lastname'=>$lastname, 'id'=>$id, 'email'=>$email, 'contact_no'=>$contact, 'password'=>$password, 'course'=>$course, 'now'=>$now]);
				$_SESSION['success'] = 'Student added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up student form first';
	}

	header('location: students.php');

?>