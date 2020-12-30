<?php
    include("connect_db.php");

    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);
    $gameId = $decoded['game_id'];
    $number = $decoded['number'];
    $fieldGoal = $decoded['field_goal'];
    $fieldGoalAttempt = $decoded['field_goal_attempt'];
    $threePointShot = $decoded['three_point_shot'];
    $threePointShotAttempt = $decoded['three_point_shot_attempt'];
    $freeThrow = $decoded['free_throw'];
    $freeThrowAttempt = $decoded['free_throw_attempt'];
    $offensiveRebound = $decoded['offensive_rebound'];
    $defensiveRebound = $decoded['defensive_rebound'];
    $assist = $decoded['assist'];
    $steal = $decoded['steal'];
    $blockShot = $decoded['block_shot'];
    $turnover = $decoded['turnover'];
    $foul = $decoded['foul'];

    $query = ("UPDATE member_performance SET field_goal = ?, field_goal_attempt = ?, three_point_shot = ?, three_point_shot_attempt = ?, free_throw = ?, free_throw_attempt = ?, offensive_rebound = ?, defensive_rebound = ?, assist = ?, steal = ?, block_shot = ?, turnover = ?, foul = ? WHERE game_id = ? AND number = ?");
    $stmt = $db->prepare($query);
    $result = $stmt->execute(array($fieldGoal, $fieldGoalAttempt, $threePointShot, $threePointShotAttempt, $freeThrow, $freeThrowAttempt, $offensiveRebound, $defensiveRebound, $assist, $steal, $blockShot, $turnover, $foul, $gameId, $number));