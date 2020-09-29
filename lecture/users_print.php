<?php
	include 'includes/session.php';

	function generateRow($from, $to, $conn){
		$contents = '';
	 	
		$stmt = $conn->prepare("SELECT * FROM student WHERE date_registered BETWEEN '$from' AND '$to' ORDER BY date_registered DESC");
		$stmt->execute();
		$total = 0;
		foreach($stmt as $row){
			$total++;
			$contents .= '
			<tr>
				<td>'.date('M d, Y', strtotime($row['date_registered'])).'</td>
				<td>'.$row['student_no'].'</td>
				<td>'.$row['firstname'].' '.$row['lastname'].'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['course_code'].'</td>
			</tr>
			';
		}

		$contents .= '
			<tr>
				<td colspan="3" align="left"><b>Total No Of Students Registered between Selected time: </b></td>
				<td colspan="3" align="center"><b> '.$total.' </b></td>
			</tr>
		';
		return $contents;
	}

	if(isset($_POST['print'])){
		$ex = explode(' - ', $_POST['date_range']);
		$from = date('Y-m-d', strtotime($ex[0]));
		$to = date('Y-m-d', strtotime($ex[1]));
		$from_title = date('M d, Y', strtotime($ex[0]));
		$to_title = date('M d, Y', strtotime($ex[1]));

		$conn = $pdo->open();

		require_once('../tcpdf/tcpdf.php');  
	    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
	    $pdf->SetCreator(PDF_CREATOR);  
	    $pdf->SetTitle('Students Registered: '.$from_title.' - '.$to_title);  
	    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
	    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
	    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
	    $pdf->SetDefaultMonospacedFont('helvetica');  
	    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
	    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
	    $pdf->setPrintHeader(false);  
	    $pdf->setPrintFooter(false);  
	    $pdf->SetAutoPageBreak(TRUE, 10);  
	    $pdf->SetFont('helvetica', '', 11);  
	    $pdf->AddPage();  
	    $content = '';  
	    $content .= '
	      	<h2 align="center">Student Assignment System</h2>
	      	<h4 align="center">STUDENT REPORT</h4>
	      	<h4 align="center">'.$from_title." - ".$to_title.'</h4>
	      	<table border="1" cellspacing="0" cellpadding="3">  
	           <tr>  
				    <th width="15%" align="center"><b>Date</b></th>
				    <th width="15%" align="center"><b>Student No.</b></th>
	                <th width="30%" align="center"><b>Full Name</b></th>
					<th width="25%" align="center"><b>Email</b></th> 
					<th width="15%" align="center"><b>Course</b></th> 
	           </tr>  
	      ';  
	    $content .= generateRow($from, $to, $conn);  
	    $content .= '</table>';  
		$pdf->writeHTML($content);  
		ob_end_clean();
	    $pdf->Output('students.pdf', 'I');

	    $pdo->close();

	}
	else{
		$_SESSION['error'] = 'Need date range to provide registration print';
		header('location: students.php');
	}
?>