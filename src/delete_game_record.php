<?php
    include ("connect_db.php");

    $id =  $_POST["id"];
    $stmt = $db->prepare("DELETE FROM `team_performance` WHERE `team_performance`.`game_id` = ?");
    $result = $stmt->execute(array($id));
    $stmt = $db->prepare("DELETE FROM `member_performance` WHERE `member_performance`.`game_id` = ?");
    $result = $stmt->execute(array($id));
    $stmt = $db->prepare("DELETE FROM `game` WHERE `game`.`id` = ?");
    $result = $stmt->execute(array($id));
    
    echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
    exit();
?>