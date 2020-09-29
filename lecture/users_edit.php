<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){

		$name = "/^[a-zA-Z ]+$/";
		$emailValidation = "/^[_a-zA-Z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
		$number = "/^[0-9]+$/";
		$addressValidation = "/^[A-Za-z0-9'\.\-\s\,]+$/";

		$id = $_POST['id'];
		$student = $_POST['student_no'];
		$id_num = $_POST['id_number'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$contact = $_POST['contact'];
		$course_code = $_POST['course_code'];
	
		if(!preg_match($number,$student) || strlen($student) != 9){
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
		if(!preg_match($number,$id_num) || strlen($id_num) != 13){
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
		if(!empty($password))
		{
			if(strlen($password) < 8){
				$_SESSION['error'] = 'Password is too Short';
				header('location: students.php');
				exit();	
			}
			else
			{
				$password = $password;
			}
		}
		else
		{
			$password = $admin['password'];
		}


		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM student WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		if($password == $row['password']){
			$password = $row['password'];
		}
		else{
			$password = $password;
		}

		try{
			$stmt = $conn->prepare("UPDATE student SET student_no=:student, email=:email, password=:password, firstname=:firstname, lastname=:lastname, id_number=:id_num, contact_no=:contact, course_code=:code WHERE id=:id");
			$stmt->execute(['student'=>$student, 'email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'id_num'=>$id_num, 'contact'=>$contact, 'code'=>$course_code, 'id'=>$id]);
			$_SESSION['success'] = 'Student updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit student form first';
	}

	header('location: students.php');

?>