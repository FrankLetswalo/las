
<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){

		$number = "/^[0-9]+$/"; 

        $code = $_POST['course_code'];
        $name = $_POST['course_name'];
		$no_students = $_POST['no_students'];
		
		
		if(strlen($code) != 7)
		{
			$_SESSION['error'] = 'Invalid Course Code Format';
			header('location: courses2.php');
			exit();	
		}

		if(!preg_match($number,$no_students)){
			$_SESSION['error'] = 'Invalid Number of students Format';
			header('location: courses2.php');
			exit();	
		}

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM course WHERE course_code=:code");
		$stmt->execute(['code'=>$code]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Course already exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO course (course_code, course_name,  no_students) VALUES (:code, :name, :no_students)");
				$stmt->execute(['code'=>$code,'name'=>$name, 'no_students'=>$no_students]);
				$_SESSION['success'] = 'Course added successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up course form first';
	}

	header('location: courses2.php');

?>