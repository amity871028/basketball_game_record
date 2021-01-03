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

    $query = ("UPDATE member SET name=?,position=?,birth=?,height=?,weight=? WHERE number=?");
    $stmt = $db->prepare($query);
    $result = $stmt->execute(array($name,$position,$birth,$height,$weight,$number));
?>