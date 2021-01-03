
<html>
    <head>
        <title>籃球比賽紀錄單-球員紀錄</title>
        <script src='js/lib/fetch-data.js'></script>
        <script src='js/insert_member.js'></script>
        <script src='js/edit_member.js'></script>
        <link rel="stylesheet" href="css/member_record.css">
        <script>
            function edit_text(obj) {
                value = obj.value;
                arr = value.split('_');
                document.getElementById('edit_member_name').value = arr[0];
                document.getElementById('edit_member_number').value = arr[1];
                document.getElementById('edit_member_number').disabled = true;
                document.getElementById('edit_member_position').value = arr[2];
                document.getElementById('edit_member_birth').value = arr[3];
                document.getElementById('edit_member_height').value = arr[4];
                document.getElementById('edit_member_weight').value = arr[5];
            }
        </script>
    </head>
    <body>
        <?php
            include("narvbar.php");
            include("src/connect_db.php");
            ob_start();
        ?>
        <span>
            <h1 class='title'>球員紀錄</h1>
            <form style='display: inline;' class='search_form' action='' method='POST'>
                <input type='text' class='text' name='text' placeholder='球員姓名(空白為全部球員)'>
                <input type='submit' class='search_btn' name='search' value='Search'>
            </form>
        </span>
        <span>
            <button class='insert' data-toggle='modal' data-target='#myModal'>新增球員</button>
        </span>
<?php
    if(!empty($_POST['text'])) {
        $search_name = $_POST['text'];
        $query = ("SELECT count(*) AS countMem FROM member WHERE name=?");
        $stmt = $db->prepare($query);
        $stmt->execute(array($search_name));
        $member_count = $stmt->fetchAll();
        foreach($member_count as $info) {
            echo "<p><h6 class='title'>共有".$info['countMem']."位球員</h6></p>";
        }
?>
        <p>
            <table class='member_table' width='70%'>
                <tr class='table_title'>
                    <th width='13%'>姓名</th>
                    <th width='12%'>背號</th>
                    <th width='15%'>位置</th>
                    <th width='19%'>生日</th>
                    <th width='12%'>身高</th>
                    <th width='10%'>體重</th>
                    <th width='19%'>動作</th>
                </tr>
            <?php
                $query = ("SELECT * FROM member WHERE name=?");
                $stmt = $db->prepare($query);
                $stmt->execute(array($search_name));
                $member_data = $stmt->fetchAll();
                foreach($member_data as $info) {
                    echo "<tr><form action='' method='POST'>";
                    echo "<td name='member_name'>".$info['name']."</td>";
                    echo "<td name='member_number'>".$info['number']."</td>";
                    $positionText = "";
                    if ($info['position'] == 'PG') {$positionText = 'PG(控球後衛)';}
                    if ($info['position'] == 'SG') {$positionText = 'SG(得分後衛)';}
                    if ($info['position'] == 'SF') {$positionText = 'SF(小前鋒)';}
                    if ($info['position'] == 'PF') {$positionText = 'PF(大前鋒)';}
                    if ($info['position'] == 'C') {$positionText = 'C(中鋒)';}
                    echo "<td name='member_position'>".$positionText."</td>";
                    echo "<td name='member_birth'>".$info['birth']."</td>";
                    echo "<td name='member_height'>".$info['height']."</td>";
                    echo "<td name='member_weight'>".$info['weight']."</td>";
                    echo "<td>
                            <button type='button' class='edit' value='".$info['name']."_".$info['number']."_".$info['position']."_".$info['birth']."_".$info['height']."_".$info['weight']."' data-toggle='modal' data-target='#editModal' onclick='edit_text(this);'>編輯</button>
                            <button type='submit' name='delete' value='".$info['number']."' class='delete'>刪除</button>
                        </td>";
                    echo "</form></tr>";
                }
            } else {
                    $query = ("SELECT count(*) AS countMem FROM member");
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    $member_count = $stmt->fetchAll();
                    foreach($member_count as $info) {
                        echo "<p><h6 class='title'>共有".$info['countMem']."位球員</h6></p>";
                    }

                    echo "<p><table class='member_table' id='all_member_table' width='70%'>
                        <tr class='table_title'><th width='13%'>姓名</th><th width='12%'>背號</th><th width='15%'>位置</th><th width='19%'>生日</th><th width='12%'>身高</th><th width='10%'>體重</th><th width='19%'>動作</th></tr>";

                    $query = ("SELECT * FROM member");
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    $member_data = $stmt->fetchAll();
                    foreach($member_data as $info) {
                        echo "<tr><form action='' method='POST'>";
                        echo "<td name='member_name'>".$info['name']."</td>";
                        echo "<td name='member_number'>".$info['number']."</td>";
                        $positionText = "";
                        if ($info['position'] == 'PG') {$positionText = 'PG(控球後衛)';}
                        if ($info['position'] == 'SG') {$positionText = 'SG(得分後衛)';}
                        if ($info['position'] == 'SF') {$positionText = 'SF(小前鋒)';}
                        if ($info['position'] == 'PF') {$positionText = 'PF(大前鋒)';}
                        if ($info['position'] == 'C') {$positionText = 'C(中鋒)';}
                        echo "<td name='member_position'>".$positionText."</td>";
                        echo "<td name='member_birth'>".$info['birth']."</td>";
                        echo "<td name='member_height'>".$info['height']."</td>";
                        echo "<td name='member_weight'>".$info['weight']."</td>";
                        echo "<td>
                            <button type='button' class='edit' value='".$info['name']."_".$info['number']."_".$info['position']."_".$info['birth']."_".$info['height']."_".$info['weight']."' data-toggle='modal' data-target='#editModal' onclick='edit_text(this);'>編輯</button>
                            <button type='submit' name='delete' value='".$info['number']."' class='delete'>刪除</button>
                        </td>";
                        echo "</form></tr>";
                    }
                }
            ?>
            </table>
        </p>
<?php
    if(isset($_POST['delete'])) {
        $number = $_POST['delete'];
        $query = ("DELETE FROM member WHERE number=?");
        $stmt = $db->prepare($query);
        $result = $stmt->execute(array($number));
        header("Location: member_record.php");
    }
?>
    <!--insert_member_modal-->
    <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    新增球員
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                </div>
                <div class='modal-body'>
                    <form name='insert_form' action='' method='POST'>
                        姓名: <input type='text' style='height: 40px; width: 90%;' id='insert_member_name' required>
                        <br>
                        <br>
                        背號: <input type='number' min='0' style='height: 40px; width: 60px;' id='insert_member_number' required>
                        <br>
                        <br>
                        位置: <select style='height: 40px; width: 90%;' id='insert_member_position' required>
                            <option value='PG'>PG(控球後衛)</option>
                            <option value='SG'>SG(得分後衛)</option>
                            <option value='SF'>SF(小前鋒)</option>
                            <option value='PF'>PF(大前鋒)</option>
                            <option value='C'>C(中鋒)</option>
                        </select>
                        <br>
                        <br>
                        生日: <input type='date' id='insert_member_birth' required>
                        <br>
                        <br>
                        身高: <input type='number' min='0' style='height: 40px; width: 60px;' id='insert_member_height' required>
                        <br>
                        <br>
                        體重: <input type= 'number' min='0' style='height: 40px; width: 60px;' id='insert_member_weight' required>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                    <button type='button' class='btn btn-primary' id='insert'>確定</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--edit_member_modal-->    
    <div class='modal fade' id='editModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    編輯球員
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                </div>
                <div class='modal-body'>
                    <form name='edit_form' action='' method='POST'>
                        姓名: <input type='text' style='height: 40px; width: 90%;' id='edit_member_name' required>
                        <br>
                        <br>
                        背號: <input type='number' min='0' style='height: 40px; width: 60px;' id='edit_member_number' required>
                        <br>
                        <br>
                        位置: <select style='height: 40px; width: 90%;' id='edit_member_position'>
                            <option value='PG'>PG(控球後衛)</option>
                            <option value='SG'>SG(得分後衛)</option>
                            <option value='SF'>SF(小前鋒)</option>
                            <option value='PF'>PF(大前鋒)</option>
                            <option value='C'>C(中鋒)</option>
                        </select>
                        <br>
                        <br>
                        生日: <input type='date' id='edit_member_birth' required>
                        <br>
                        <br>
                        身高: <input type='number' min='0' style='height: 40px; width: 60px;' id='edit_member_height' required>
                        <br>
                        <br>
                        體重: <input type='number' min='0' style='height: 40px; width: 60px;' id='edit_member_weight' required>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                    <button type='button' class='btn btn-primary' id='edit'>確定</button>
                </div>
            </div>
        </div>
    </div>

    </body></html>
    <?php
    ob_end_flush();
?>