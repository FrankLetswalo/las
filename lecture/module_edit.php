<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){

		$name = "/^[a-zA-Z ]+$/";
		$productValidation = "/[^0-9]/";
		$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
		$number = "/^[0-9]+$/";


        $id = $_POST['courseID'];

        $subject_code = $_POST['subject_code'];
        $subject_name = $_POST['name'];
        $no_students = $_POST['no_students'];
		$lecture = $_POST['lecture'];
		
		if(strlen($subject_code) != 7){
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

			try{
                $stmt = $conn->prepare("UPDATE subject SET subject_code=:sub_code, subject_name=:sub_name, lecture_number=:lecture, no_students=:no_students WHERE courseID=:id");
                $stmt->execute(['sub_code'=>$subject_code, 'sub_name'=>$subject_name, 'lecture'=>$lecture, 'no_students'=>$no_students, 'id'=>$id]);

				$_SESSION['success'] = 'Module updated successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up module form first';
	}

	header('location: modules.php');

?>