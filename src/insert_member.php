<?php
    include("connect_db.php");
    
    $content = trim(file_get_contents('php://input'));
    $decode = json_decode($content, true);
    $number = $decode['number'];
    $name = $decode['name'];
    $position = $decode['position'];
    $birth = $decode['birth'];
    $height = $decode['height'];
    $weight = $decode['weight'];
    try {
        $query = ("INSERT INTO member VALUES(?,?,?,?,?,?)");
        $stmt = $db->prepare($query);
        $result = $stmt->execute(array($number,$name,$position,$birth,$height,$weight));
    } catch(PDOException $e) {
        echo http_response_code(409);
    }
?>