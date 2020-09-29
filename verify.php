<?php
	include 'includes/session.php';
	$conn = $pdo->open();

	if(isset($_POST['login'])){
		
		$studentNumber = $_POST['username'];
		$password = $_POST['password'];

		try{

			
					$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM student WHERE student_no = :username");
					$stmt->execute(['username'=>$studentNumber]);
					$row = $stmt->fetch();
					if($row['numrows'] > 0){
							if($password == $row['password'])
							{
									$_SESSION['user'] = $row['student_no'];
							}
							else{
								$_SESSION['error'] = 'Incorrect Password';
							}
				}
				else
				{

					$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows1 FROM lecture WHERE staff_no = :username");
					$stmt->execute(['username'=>$studentNumber]);
					$row = $stmt->fetch();

					if($row['numrows1'] > 0){
						if($password == $row['password']){
								$_SESSION['lecture'] = $row['staff_no'];
						}
						else{
							$_SESSION['error'] = 'Incorrect Password';
						}
					}
					else{
						$_SESSION['error'] = 'Account Does Not Exist Please Register';
					}	

			}
			

			
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

	}
	else{
		$_SESSION['error'] = 'Input login credentails first';
	}

	$pdo->close();

	header('location: login.php');

?>