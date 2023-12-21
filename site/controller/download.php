<?php
    // Database connection
    // include("DBConnect.php");

	include_once dirname(__FILE__) . '/../model/DBConnect.php';

    $db = new DBConnect();
    $conn = $db->connect();
 
	if(ISSET($_REQUEST['id'])){
		$file = $_REQUEST['id'];
		$query = $conn->prepare("SELECT * FROM `mosq_img` WHERE `id`='$file'");
		$query->execute();
		$fetch = $query->fetch();
 
		header("Content-Disposition: attachment; filename=".$fetch['img_name']);
		header("Content-ID:".$fetch['id']);
		header("Content-Type: image/png");
		echo base64_encode($fetch['img_ctnt']);
	}
?>