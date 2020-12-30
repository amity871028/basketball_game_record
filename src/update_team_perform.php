<?php
    include("connect_db.php");

    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);
    $gameId = $decoded['game_id'];
    $team = $decoded['team'];
    $func = $decoded['func'];
    if($func == "point"){
        $firstPeriodPoint = $decoded['first_period_point'];
        $secondPeriodPoint = $decoded['second_period_point'];
        $thirdPeriodPoint = $decoded['third_period_point'];
        $fourthPeriodPoint = $decoded['fourth_period_point'];

        $query = ("UPDATE team_performance SET first_period_point = ?, second_period_point = ?, third_period_point = ?, fourth_period_point = ? WHERE game_id = ? AND team = ?");
        $stmt = $db->prepare($query);
        $result = $stmt->execute(array($firstPeriodPoint, $secondPeriodPoint, $thirdPeriodPoint, $fourthPeriodPoint, $gameId, $team));
    }
    else {

    }