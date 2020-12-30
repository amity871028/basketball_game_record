<?php
    include("connect_db.php");

    if(isset($_GET['number'])){
        $number = $_GET['number'];
        $query = ("SELECT name FROM member WHERE number = ?");
        $stmt = $db->prepare($query);
        $error = $stmt->execute(array($number));
        $member = $stmt->fetch();
        $json = array(
            "name" => $member['name']
        );
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }
    else {
        $name = $_GET['name'];
        $query = ("SELECT number FROM member WHERE name = ?");
        $stmt = $db->prepare($query);
        $error = $stmt->execute(array($name));
        $member = $stmt->fetch();
        $json = array(
            "number" => $member['number']
        );
        echo json_encode($json);
    }