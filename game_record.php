<?php
    include("narvbar.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>比賽紀錄</title>
    <link rel="stylesheet" type="text/css" href="css/game_record.css">
    <style></style>
    <script src = js/game_record.js></script>

</head>
    <body>
        <div class = "d1">
            <div class="container">
                <h1>籃球比賽紀錄</h1>
                <form action="" method="POST">
                    <input type="text" placeholder="比賽名稱" class="t1" name = "game_name">
                    <input type="submit" value="Search" class="btn btn-outline-success">
                    <svg>
                    <rect x="0" y="0" fill="none" width="100%" height="100%"/>
                    </svg>
                    <input type= "button" value="新增場次" class="btn btn-primary" onclick="add()"> 
                </form>
            </div>   
            <div id="contes" class = 'f1'> 
                <div style ="width:500px;height:40px">
                    <span style = "font-size:30px;">新增場次</span>
                    <hr>
                    <form action = "src/new_game_record.php" method= "post" style=" margin-left:100px;">
                        名稱 : <input type = "text" value="" name="name" required><br>
                        賽次 : <input type="text" value="" name="type" required><br>
                        主/客隊 : <select style = "margin-bottom:10px;" name="team">
                        　      <option value="home">主隊</option>
                        　      <option value="guest">客隊</option>
                            </select><br>
                        對手 : <input type = "text" value="" name="competitor" required><br>
                        日期 : <input type="datetime-local" name="date" required>
                            <br>
                        <hr>
                        <div class="container" >
                            <input type="submit" value="確定" class="btn btn-info" onclick="set_team_name()">
                            <input type="reset" value="清除" class="btn btn-warning">
                            <input type="button" onclick="javascript:location.href='game_record.php'" value="關閉" class="btn btn-danger">
                        </div>
                    </form> 
                </div>
            </div>
        <div id="all_light"  ></div>
        <?php
            
            header("Content-type:text/html;charset=utf-8");
            include ("src/connect_db.php");

            echo " <table class=\"responstable\" id = \"game_table\"> 
            <tr>
            <th>名稱</th>
            <th data-th=\"Driver details\"><span>賽次</span></th>
            <th>主/客隊</th>
            <th>對手</th>
            <th>日期</th>
            <th>動作</th>
            </tr>";
                if (empty($_POST["game_name"]))
                {
                    $query = ("SELECT * FROM game");
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    $error = $stmt->execute();
                    $result = $stmt->fetchAll();
                }
                else
                {   
                    $game_name = $_POST["game_name"];
                    $query = ("SELECT * FROM `game` WHERE `name` LIKE '$game_name'");
                    $status = $db->query($query);
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                }

                for($i = 0; $i < count($result); $i++)
                {
                    
                    
                    echo "<tr>";
                    echo "<td>".$result[$i]['name']."</td>";
                    echo "<td>".$result[$i]['type']."</td>";
                    if ($result[$i]['team'] == "home") 
                    {
                        echo "<td>主隊</td>";
                    }
                    elseif($result[$i]['team'] == "guest"){
                        echo "<td>客隊</td>";
                    }
                    echo "<td>".$result[$i]['competitor']."</td>";
                    echo "<td>".$result[$i]['date']."</td>";
                    echo "<td> 
                            <div class=\"container\">
                                <form action = \"src/delete_game_record.php\" method = \"post\" >
                                    <input type = \"text\" name = \"id\"style = \"display:none;\" value = \"";echo $result[$i]['id']."\">
                                    <input type=\"button\" value=\"查看\" class = \"btn btn-info\"onclick=\"location.href='game_detail.php?id=";echo $result[$i]['id']."'\">    
                                    <input type =\"submit\" value = \"刪除\" class = \"btn btn-danger\">
                                </form>
                            </div>
                        </td>";
                    echo "</tr>";
                }
                echo "</table>";      
        ?>
        </div>
    </body>
</html>
