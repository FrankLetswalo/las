<?php

	include 'includes/session.php';

	if(isset($_POST['signup'])){

		$name = "/^[a-zA-Z ]+$/";
		$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
		$number = "/^[0-9]+$/";

		$staffNumber = $_POST['staff_number'];
		$firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $contact = $_POST['contact'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
				

		if(!preg_match($name,$firstname)){
			$_SESSION['error'] = 'Invalid First Name Format';
			header('location: signup_lecture.php');
			exit();	
		}
		if(!preg_match($name,$lastname)){
			$_SESSION['error'] = 'Invalid Last Name Format';
			header('location: signup_lecture.php');
			exit();	
		}
		if(!preg_match($emailValidation,$email)){
			$_SESSION['error'] = 'Invalid Email Please Enter correct Email';
			header('location: signup_lecture.php');
			exit();	
		}
		if(!preg_match($number,$contact)){
			$_SESSION['error'] = 'Invalid Staff Number Format';
			header('location: signup_lecture.php');
			exit();	
		}
		if(strlen($password) < 8){
			$_SESSION['error'] = 'Password is too Short';
			header('location: signup_lecture.php');
			exit();	
		}

		if($password != $repassword){
			$_SESSION['error'] = 'Passwords did not match';
			header('location: signup_lecture.php');
			exit();	
		}
		else{
			$conn = $pdo->open();

			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM lecture WHERE email=:email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				$_SESSION['error'] = 'Email already taken';
				header('location: signup_lecture.php');
				exit();	
			}
			else{
				$now = date('Y-m-d');
				
				try{
					$stmt = $conn->prepare("INSERT INTO lecture (staff_no, firstname,  lastname, email, contact_no, password, date_registered) VALUES (:staff_no, :firstname, :lastname, :email, :contact, :password, :now)");
					$stmt->execute(['staff_no'=>$staffNumber, 'firstname'=>$firstname, 'lastname'=>$lastname, 'email'=>$email, 'contact'=>$contact, 'password'=>$password, 'now'=>$now]);
					$userid = $conn->lastInsertId();

					$_SESSION['success'] = 'Account created. Proceed to Login';
					header('location: signup_lecture.php');

					
				}
				catch(PDOException $e){
					$_SESSION['error'] = $e->getMessage();
					header('location: signup_lecture.php');
				}

				$pdo->close();

			}

		
        }
    }
	else{
		$_SESSION['error'] = 'Fill up signup form first';
		header('location: signup_lecture.php');
    }



?>