<?php
	include 'includes/session.php';

	if(isset($_GET['return'])){
		$return = $_GET['return'];
		
	}
	else{
		$return = 'home.php';
	}

	if(isset($_POST['save'])){

		$name = "/^[a-zA-Z ]+$/";
		$ProductValidation = "/[^0-9]/";
		$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
		$number = "/^[0-9]+$/";

		$curr_password = $_POST['curr_password'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$photo = $_FILES['photo']['name'];
		$contact = $_POST['contact'];

		//$photo = $_FILES['photo']['name'];

		if(!preg_match($emailValidation,$email)){
			$_SESSION['error'] = 'Invalid Email address';
			header('location: users.php');
			exit();	
		}



		if(!preg_match($name,$firstname)){
			$_SESSION['error'] = 'Invalid First Name Format';
			header('location: users.php');
			exit();	
		}

		if(!preg_match($name,$lastname)){
			$_SESSION['error'] = 'Invalid Last Name Format';
			header('location: users.php');
			exit();	
		}
		if(!empty($password))
		{
			if(strlen($password) < 8){
				$_SESSION['error'] = 'Password is too Short';
				header('location: users.php');
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



		if($curr_password == $admin['password']){
			if(!empty($photo)){
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$photo);
				$filename = $photo;	
			}
			else{
				$filename = $admin['photo'];
			}

			if($password == $admin['password']){
				$password = $admin['password'];
			}
			else{
				$password = $password;
			}

			$conn = $pdo->open();

			try{
				$stmt = $conn->prepare("UPDATE student SET email=:email, password=:password, firstname=:firstname, lastname=:lastname, contact_no=:contact WHERE id=:id");
				$stmt->execute(['email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'contact'=>$contact, 'id'=>$admin['id']]);

				$_SESSION['success'] = 'Account updated successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

			$pdo->close();
			
		}
		else{
			$_SESSION['error'] = 'Incorrect password';
		}
	}
	else{
		$_SESSION['error'] = 'Fill up required details first';
	}

	header('location:'.$return);

?>