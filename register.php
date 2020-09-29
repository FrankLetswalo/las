<?php

	include 'includes/session.php';

	if(isset($_POST['signup'])){

		$name = "/^[a-zA-Z- ]+$/";
		$name1 = "/^[a-zA-Z0-9-_]+$/";
		$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
		$number = "/^[0-9]+$/";

		$studentNumber = $_POST['student_number'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$idNumber = $_POST['id_number'];
		$course_code = $_POST['course_code'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];

		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;
		$_SESSION['studentNumber'] = $studentNumber;
		$_SESSION['id_number'] = $idNumber;
		$_SESSION['contact'] = $contact;

		
		

		if(!preg_match($number,$studentNumber) || strlen($studentNumber) != 9){
			$_SESSION['error'] = 'Invalid Student Number';
			header('location: signup.php');
			exit();	
		}

		if(!preg_match($name,$firstname)){
			$_SESSION['error'] = 'Invalid First Name Format';
			header('location: signup.php');
			exit();	
		}
		if(!preg_match($name,$lastname)){
			$_SESSION['error'] = 'Invalid Last Name Format';
			header('location: signup.php');
			exit();	
		}
		if(!preg_match($number,$idNumber) || strlen($idNumber) != 13){
			$_SESSION['error'] = 'Invalid ID Number';
			header('location: signup.php');
			exit();	
		}
		if(!preg_match($emailValidation,$email)){
			$_SESSION['error'] = 'Invalid Email Please Enter correct Email';
			header('location: signup.php');
			exit();	
		}
		if(!preg_match($number,$contact) || strlen($contact) != 10){
			$_SESSION['error'] = 'Invalid Number Format';
			header('location: signup.php');
			exit();	
		}
		if(strlen($password) < 8){
			$_SESSION['error'] = 'Password must be atleast 8 characters';
			header('location: signup.php');
			exit();	
		}

		if($password != $repassword){
			$_SESSION['error'] = 'Passwords did not match';
			header('location: signup.php');
			exit();	
		}
		else{
			$conn = $pdo->open();

			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM student WHERE student_no =:student");
			$stmt->execute(['student'=>$studentNumber]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				$_SESSION['error'] = 'Student Number already Exist';
				header('location: signup.php');
				exit();	
			}
			else{
				$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM student WHERE email=:email");
				$stmt->execute(['email'=>$email]);
				$row = $stmt->fetch();
				if($row['numrows'] > 0){
					$_SESSION['error'] = 'Email already Used';
					header('location: signup.php');
					exit();	
				}
				$now = date('Y-m-d');
				
				try{
					$deactivated = "No";
					$stmt = $conn->prepare("INSERT INTO student (student_no, firstname, lastname, id_number, email, contact_no, password, course_code, date_registered) VALUES (:student, :firstname, :lastname, :id, :email, :contact, :password, :course_code, :now)");
					$stmt->execute(['student'=>$studentNumber, 'firstname'=>$firstname, 'lastname'=>$lastname, 'id'=>$idNumber, 'email'=>$email, 'contact'=>$contact, 'password'=>$password, 'course_code'=>$course_code, 'now'=>$now]);
					$userid = $conn->lastInsertId();


					unset($_SESSION['firstname']);
					unset($_SESSION['lastname']);
					unset($_SESSION['email']);
					unset($_SESSION['studentNumber']);
					unset($_SESSION['id_number']);
					unset($_SESSION['contact']);

					$_SESSION['success'] = 'Account created. Proceed to Login';
					header('location: signup.php');

					
				}
				catch(PDOException $e){
					$_SESSION['error'] = $e->getMessage();
					header('location: signup.php');
				}

				$pdo->close();

			}

		
        }
    }
	else{
		$_SESSION['error'] = 'Fill up signup form first';
		header('location: signup.php');
    }



?>