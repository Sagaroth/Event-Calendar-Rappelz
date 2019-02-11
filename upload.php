<?php 
include_once("db_connect.php");
if(!empty($_FILES)){     
    $uploadDir = "uploads/";
    $fileName = $_FILES['file']['name'];
    $uploadedFile = $uploadDir.$fileName;    
    if(move_uploaded_file($_FILES['file']['tmp_name'],$uploadedFile)) {
        $mysqlInsert = "INSERT INTO uploads (file_name, upload_time)VALUES('".$fileName."','".date("Y-m-d H:i:s")."')";
		mysqli_query($conn, $mysqlInsert);
    }   
}
?>
