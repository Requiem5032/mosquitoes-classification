<?php
    function show() {
        $db = new DBConnect();
        $conn = $db->connect();

        $stmt = $conn->prepare("SELECT * FROM mosq_img ORDER BY id DESC LIMIT 10");
        $stmt->execute();
        $show = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $show;
    }
?>