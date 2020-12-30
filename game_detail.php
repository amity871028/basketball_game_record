<html>
    <head>
        <title>籃球比賽紀錄單-比賽詳細資訊</title>
        <script src="js/lib/fetch-data.js"></script>
        <script src="js/game_detail.js"></script>
        <link rel="stylesheet" href="css/game_detail.css">
    </head>
    <body>
        <?php
            include("narvbar.php");
            include("src/connect_db.php");
        ?>
        
        <button type="button" class="btn btn-primary" id="edit-btn">編輯</button>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <td colspan = "4">比賽基本資訊</td>
                </tr>
            </thead>
            <tbody id = "game-detail-tbody">
                <?php
                    $id = $_GET['id'];
                    $query = ("SELECT * FROM game WHERE id = ?");
                    $stmt = $db->prepare($query);
                    $error = $stmt->execute(array($id));
                    $game = $stmt->fetchAll();
                    
                    $query = ("SELECT (first_period_point+second_period_point+third_period_point+fourth_period_point) AS total_point FROM team_performance WHERE game_id = ? AND team = ?");
                    $stmt = $db->prepare($query);
                    $error = $stmt->execute(array($id, 'home'));
                    $homeTeam = $stmt->fetch();
                    $homeTeamPoint = $homeTeam['total_point'];
                    
                    $error = $stmt->execute(array($id, 'guest'));
                    $guestTeam = $stmt->fetch();
                    $guestTeamPoint = $guestTeam['total_point'];

                    echo '<tr>'.
                            '<td>比賽名稱</td>'.
                            '<td>'.$game[0]['name'].'</td>'.
                            '<td>賽次</td>'.
                            '<td>'.$game[0]['type'].'</td>'.
                         '</tr>'.
                         '<tr>'.
                            '<td>比賽時間</td>'.
                            '<td colspan = "3">'.$game[0]['date'].'</td>'.
                         '</tr>';
                    if($game[0]['team'] == 'home'){
                        echo '<tr>'.
                                '<td>主場隊伍</td>'.
                                '<td>海洋大學</td>'.
                                '<td>客場隊伍</td>'.
                                '<td>'.$game[0]['competitor'].'</td>'.
                             '</tr>';
                    }
                    else {
                        echo '<tr>'.
                                '<td>主場隊伍</td>'.
                                '<td>'.$game[0]['competitor'].'</td>'.
                                '<td>客場隊伍</td>'.
                                '<td>海洋大學</td>'.
                             '</tr>';
                    }
                    echo '<tr>'.
                            '<td>主場得分</td>'.
                            '<td>'.$homeTeamPoint.'</td>'.
                            '<td>客場得分</td>'.
                            '<td>'.$guestTeamPoint.'</td>'.
                        '</tr>'.
                        '<tr>'.
                            '<td>獲勝隊伍</td>'.
                            '<td colspan = "3">';
                    if($homeTeamPoint > $guestTeamPoint){
                        echo '海洋大學';
                    }
                    else if($homeTeamPoint > $guestTeamPoint){
                        echo $game[0]['competitor'];
                    }
                    echo '</td>'.
                        '</tr>';
                ?>
            <tbody>
        </table>
        <button type="button" class="btn btn-primary" style="display: none;" id="add-field-btn" data-toggle="modal" data-target="#add-field-modal">新增欄位</button>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <td>球員</td>
                    <td>背號</td>
                    <td>投籃命中</td>
                    <td>投籃出手</td>
                    <td>三分命中</td>
                    <td>三分出手</td>
                    <td>罰球命中</td>
                    <td>罰球出手</td>
                    <td>進攻籃板</td>
                    <td>防守籃板</td>
                    <td>助攻</td>
                    <td>抄截</td>
                    <td>阻攻</td>
                    <td>失誤</td>
                    <td>犯規</td>
                    <td>得分</td>
                    <td>操作</td>
                </tr>
            </thead>
            <tbody id = "member-performance-tbody">
                <?php
                    $query = ("SELECT * FROM member_performance WHERE game_id = ?");
                    $stmt = $db->prepare($query);
                    $error = $stmt->execute(array($id));
                    $member = $stmt->fetchAll();
                    
                    for($i=0; $i<count($member); $i++){
                        $query = ("SELECT name FROM member WHERE number = ?");
                        $number = $member[$i]['number'];
                        $stmt = $db->prepare($query);
                        $error = $stmt->execute(array($number));
                        $memberDetail = $stmt->fetch();
                        
                        $query = ("SELECT (field_goal + free_throw + three_point_shot) AS total_points FROM `member_performance` WHERE `game_id` = ? AND `number` = ?");
                        $stmt = $db->prepare($query);
                        $error = $stmt->execute(array($id, $number));
                        $totalPoints = $stmt->fetch();
                        
                        echo '<tr>'.
                                '<td>'.$memberDetail['name'].'</td>'.
                                '<td>'.$number.'</td>'.
                                '<td>'.$member[$i]['field_goal'].'</td>'.
                                '<td>'.$member[$i]['field_goal_attempt'].'</td>'.
                                '<td>'.$member[$i]['three_point_shot'].'</td>'.
                                '<td>'.$member[$i]['three_point_shot_attempt'].'</td>'.
                                '<td>'.$member[$i]['free_throw'].'</td>'.
                                '<td>'.$member[$i]['free_throw_attempt'].'</td>'.
                                '<td>'.$member[$i]['offensive_rebound'].'</td>'.
                                '<td>'.$member[$i]['defensive_rebound'].'</td>'.
                                '<td>'.$member[$i]['assist'].'</td>'.
                                '<td>'.$member[$i]['steal'].'</td>'.
                                '<td>'.$member[$i]['block_shot'].'</td>'.
                                '<td>'.$member[$i]['turnover'].'</td>'.
                                '<td>'.$member[$i]['foul'].'</td>'.
                                '<td>'.$totalPoints['total_points'].'</td>'.
                                '<td><button type="button" class="btn btn-primary" id="delete-'.$number.'" onclick="deleteField(this)">刪除</button></td>'.
                             '</tr>';
                    }
                ?>
            </tbody>
        </table>
        
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <td colspan="5">比分</td>
                </tr>
                <tr>
                    <td></td>
                    <td>第一節</td>
                    <td>第二節</td>
                    <td>第三節</td>
                    <td>第四節</td>
                </tr>
            </thead>
            <tbody id="point-tbody">
                <?php
                     $query = ("SELECT * FROM team_performance WHERE game_id = ? AND team = ?");
                     $stmt = $db->prepare($query);
                     $error = $stmt->execute(array($id, "home"));
                     $homeDetail = $stmt->fetch();
                     
                     $error = $stmt->execute(array($id, "guest"));
                     $guestDetail = $stmt->fetch();

                    echo '<tr>'.
                            '<td>主隊</td>'.
                            '<td>'.$homeDetail['first_period_point'].'</td>'.
                            '<td>'.$homeDetail['second_period_point'].'</td>'.
                            '<td>'.$homeDetail['third_period_point'].'</td>'.
                            '<td>'.$homeDetail['fourth_period_point'].'</td>'.
                        '</tr>'.
                        
                        '<tr>'.
                            '<td>客隊</td>'.
                            '<td>'.$guestDetail['first_period_point'].'</td>'.
                            '<td>'.$guestDetail['second_period_point'].'</td>'.
                            '<td>'.$guestDetail['third_period_point'].'</td>'.
                            '<td>'.$guestDetail['fourth_period_point'].'</td>'.
                        '</tr>';
                ?>
            </tbody>
        </table>
        
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <td colspan="5">團體犯規</td>
                </tr>
                <tr>
                    <td></td>
                    <td>第一節</td>
                    <td>第二節</td>
                    <td>第三節</td>
                    <td>第四節</td>
                </tr>
            </thead>
            <tbody id="foul-tbody">
                <?php
                     $query = ("SELECT * FROM team_performance WHERE game_id = ? AND team = ?");
                     $stmt = $db->prepare($query);
                     $error = $stmt->execute(array($id, "home"));
                     $homeDetail = $stmt->fetch();
                     
                     $error = $stmt->execute(array($id, "guest"));
                     $guestDetail = $stmt->fetch();

                    echo '<tr>'.
                            '<td>主隊</td>'.
                            '<td>'.$homeDetail['first_period_foul'].'</td>'.
                            '<td>'.$homeDetail['second_period_foul'].'</td>'.
                            '<td>'.$homeDetail['third_period_foul'].'</td>'.
                            '<td>'.$homeDetail['fourth_period_foul'].'</td>'.
                        '</tr>'.
                        
                        '<tr>'.
                            '<td>客隊</td>'.
                            '<td>'.$guestDetail['first_period_foul'].'</td>'.
                            '<td>'.$guestDetail['second_period_foul'].'</td>'.
                            '<td>'.$guestDetail['third_period_foul'].'</td>'.
                            '<td>'.$guestDetail['fourth_period_foul'].'</td>'.
                        '</tr>';
                ?>
            </tbody>

            <table class="table">
            <thead class="thead-dark">
                <tr>
                    <td colspan="5">團體數據</td>
                </tr>
                <tr>
                    <td></td>
                    <td>出手命中</td>
                    <td>三分球命中</td>
                    <td>罰球命中</td>
                    <td>籃板</td>
                </tr>
            </thead>
            <tbody>
                <?php
                     $query = ("SELECT * FROM member_performance WHERE game_id = ?");
                     /*$stmt = $db->prepare($query);
                     $error = $stmt->execute(array($id, "home"));
                     $homeDetail = $stmt->fetch();
                     
                     $error = $stmt->execute(array($id, "guest"));
                     $guestDetail = $stmt->fetch();

                    echo '<tr>'.
                            '<td>主隊</td>'.
                            '<td>'.$homeDetail['first_period_foul'].'</td>'.
                            '<td>'.$homeDetail['second_period_foul'].'</td>'.
                            '<td>'.$homeDetail['third_period_foul'].'</td>'.
                            '<td>'.$homeDetail['fourth_period_foul'].'</td>'.
                        '</tr>'.
                        
                        '<tr>'.
                            '<td>客隊</td>'.
                            '<td>'.$guestDetail['first_period_foul'].'</td>'.
                            '<td>'.$guestDetail['second_period_foul'].'</td>'.
                            '<td>'.$guestDetail['third_period_foul'].'</td>'.
                            '<td>'.$guestDetail['fourth_period_foul'].'</td>'.
                        '</tr>';*/
                ?>
            </tbody>
        </table>

        <div class="modal fade" id="add-field-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      	新增球員欄位
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $query = ("SELECT number, name FROM member");
                        $stmt = $db->prepare($query);
                        $error = $stmt->execute();
                        $members = $stmt->fetchAll();
                        echo '球員：<select name="member-name">';
                        for($i=0; $i<count($members); $i++){
                            echo '<option>'.$members[$i]['name'].'</option>';
                        }
                        echo '</select>
                        <br>
                        號碼：<select name="member-number">';
                        for($i=0; $i<count($members); $i++){
                            echo '<option>'.$members[$i]['number'].'</option>';
                        }
                        echo '</select>';
                        ?>
                    </div>
				    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add-member-btn">新增</button>
				      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				    </div>
                </div>
            </div>
        </div>
    </body>
</html>