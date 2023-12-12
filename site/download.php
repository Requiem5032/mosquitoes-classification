<?php
    // Database connection
    include("DBConnect.php");
    $db = new DBConnect();
    $conn = $db->connect();
 
	if(ISSET($_REQUEST['id'])){
		$file = $_REQUEST['id'];
		$query = $conn->prepare("SELECT * FROM `mosq_img` WHERE `id`='$file'");
		$query->execute();
		$fetch = $query->fetch();
 
		header("Content-Disposition: attachment; filename=".$fetch['img_name']);
		header("Content-Type: application/octet-stream;");
		readfile("uploads/".$fetch['img_name']);
	}
?>