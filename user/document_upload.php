<?php

include 'includes/session.php';


$empID = $admin['id'];
$student = $admin['student_no'];
$name = $admin['firstname']." ".$admin['lastname'];
$subject_code = $_POST['subject_code'];
$course_code = $admin['course_code'];
$description = $_POST['description'];

if(empty($description)){
    $description = "No Descrition Added";
}
else{
    $description = $description;
}

if(isset($_POST['submit']))
{
     //Handling file upload to directory 

     $fileName = $_FILES['file']['name'];
     $fileTmpName = $_FILES['file']['tmp_name'];
     $fileSize = $_FILES['file']['size'];
     $fileError = $_FILES['file']['error'];
     $fileType = $_FILES['file']['type'];
 
     $fileExt = explode('.', $fileName);
     $fileActualExt = strtolower(end($fileExt));

     header('location: home.php');

     if($fileActualExt !== "pdf")
     {
        $_SESSION['error'] = "Please upload a PDF Document";
        exit();
     }
 
     if ($fileError === 0)
     {
        try{
            $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM submission WHERE subject_code=:subject_code");
            $stmt->execute(['subject_code'=>$subject_code]);
            $row = $stmt->fetch();
			if($row['numrows'] > 0){
				$stmt = $conn->prepare("DELETE FROM submission WHERE subject_code=:subject_code");
                $stmt->execute(['subject_code'=>$subject_code]);
                $count = 1;	
            }
            else{
                $count = 0;
            }
        }
         catch(PDOException $e)
         {
            $_SESSION['error'] = $e->getMessage();
        }

        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM submission WHERE student_no=:student");
        $stmt->execute(['student'=>$admin['student_no']]);
        $row = $stmt->fetch();
        
         $count += intval($row['numrows']) + 1;
         $fileNameNew = $admin['student_no']." ".$count.".".$fileActualExt;
         $fileDestination = 'files/'.$fileNameNew;
        
         move_uploaded_file($fileTmpName, $fileDestination);
         
         $now = date('Y-m-d');
         try{
            $stmt = $conn->prepare("INSERT INTO submission (student_no, student_name, subject_code, course_code, description, date_submitted, filepath) VALUES (:student, :name, :sub_code, :code, :description, :now, :file)");
            $stmt->execute(['student'=>$student, 'name'=>$name, 'sub_code'=>$subject_code, 'code'=>$course_code, 'description'=>$description, 'now'=>$now, 'file'=>$fileDestination]);
            $_SESSION['success'] = "Assignment uploaded successfully";

        }
        catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
        }
 
     }
     else
     {
         $_SESSION['error'] = "There was a error uploading file ";
         echo $fileError;
         exit();
     }
    
     
}
else
{
    echo "Submit not pressed";
}




?>