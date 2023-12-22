<?php 
    // Database connection
    // include("DBConnect.php");
    $db = new DBConnect();
    $conn = $db->connect();  

    if(isset($_POST["submit"])) {
        // Get file extension
        $imageExt = strtolower(pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION));
        // Allowed file types
        $allowd_file_ext = array("jpg", "jpeg", "png");
  
        if (!file_exists($_FILES["fileUpload"]["tmp_name"])) {  // file is corrupted or does not exists
           $resMessage = array(
               "status" => "alert-danger",
               "message" => "Something is wrong. Please try again."
           );
        } else if (!in_array($imageExt, $allowd_file_ext)) {    // file formats is wrong
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "Allowed file formats .jpg, .jpeg and .png."
            );            
        } else if ($_FILES["fileUpload"]["size"] > 3145728) {   // file size is larger than 3MB
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "File is too large. File size should be less than 3MB."
            );
        } else {    // upload to database
            if (isset($_FILES["fileUpload"]) && $_FILES["fileUpload"]["error"] == 0) {
                $img = $_FILES['fileUpload']['tmp_name'];
                $imgContent = file_get_contents($img);
                $imgName = $_FILES["fileUpload"]["name"];

                $sql = "INSERT INTO mosq_img (img_name ,img_ctnt) VALUES (:string, :blob)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":string", $imgName);
                $stmt->bindParam(":blob", $imgContent);
                if($stmt->execute()){
                    $resMessage = array(
                        "status" => "alert-success",
                        "message" => "Image uploaded successfully."
                    );                 
                 }
            } else {    // unknown reasons
                $resMessage = array(
                    "status" => "alert-danger",
                    "message" => "Image can not be uploaded."
                );
            }
        }
    }
?>