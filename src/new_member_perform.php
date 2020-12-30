<?php
    include("connect_db.php");

    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);
    $id = $decoded['id'];
    $number = $decoded['number'];
    $query = ("INSERT INTO member_performance VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt = $db->prepare($query);
    $result = $stmt->execute(array($id, $number, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0));
