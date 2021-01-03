<?php
    include ("connect_db.php");

    $query = ("SELECT * FROM game");
    $stmt = $db->prepare($query);
    $stmt->execute();
    $error = $stmt->execute();
    $result = $stmt->fetchAll();

    $name = $_POST["name"];
    $type = $_POST["type"]; 
    $team = $_POST["team"]; 
    $competitor = $_POST["competitor"];
    $date = $_POST["date"];
    $NowTime=date("Y-m-d H:i:s");
    $id = (int) strtotime("$NowTime,now");
    
    $query = ("INSERT INTO `game` values(?,?,?,?,?,?)"); 
    $stmt = $db->prepare($query);
    $result = $stmt->execute(array($id,$name,$type,$team,$date,$competitor));

    $query = ("INSERT INTO `team_performance` VALUES(?,?,?,?,?,?,?,?,?,?)");
    $stmt = $db->prepare($query);
    $result = $stmt->execute(array($id, 'home', 0, 0, 0, 0, 0, 0, 0, 0));
    $result = $stmt->execute(array($id, 'guest', 0, 0, 0, 0, 0, 0, 0, 0));

    echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
    exit();

?>