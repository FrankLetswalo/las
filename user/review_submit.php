<?php
	include 'includes/session.php';

	if(isset($_POST['submit'])){

		$student_no = $admin['student_no'];
		$firstname = $admin['firstname'];
        $lastname = $admin['lastname'];
        $name = $firstname." ".$lastname;
		$review = $_POST['description'];
		$lecture_no = $_POST['lecture'];
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM review WHERE student_no=:student");
		$stmt->execute(['student'=>$student_no]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'You have already submitted a review to this lecture';
		}
		else{
			
			$now = date('Y-m-d');
			try{
				$stmt = $conn->prepare("INSERT INTO review (student_name, student_no, message, lecture_no, date_posted) VALUES (:name, :student, :message, :lecture, :now)");
				$stmt->execute(['name'=>$name, 'student'=>$student_no, 'message'=>$review, 'lecture'=>$lecture_no, 'now'=>$now]);
				$_SESSION['success'] = 'Review sent successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up review form first';
	}

	header('location: send_review.php');

?>