<?php
	include 'includes/session.php';

	$output = '';

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM course");
	$stmt->execute();

	foreach($stmt as $row){
		$output .= "
			<option value='".$row['course_code']."' class='append_items'>".$row['course_name']."</option>
		";
	}

	$pdo->close();
	echo json_encode($output);

?>