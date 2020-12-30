<?php
    include("connect_db.php");

    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);
    $id = $decoded['id'];
    $number = $decoded['number'];
    $query = ("DELETE FROM member_performance WHERE game_id = ? AND number = ?");
    $stmt = $db->prepare($query);
    $result = $stmt->execute(array($id, $number));

