<?php 
	include 'includes/session.php';

	if(isset($_POST['review_id'])){
		$id = $_POST['review_id'];
		
		$conn = $pdo->open();

        $stmt = $conn->prepare("SELECT * from reviews where review_id=:review_id");
         
		$stmt->execute(['review_id'=>$id]);
		$row = $stmt->fetch();
		
		$pdo->close();

		echo json_encode($row);
	}
?>