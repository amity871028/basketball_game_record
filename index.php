<?php
    include("narvbar.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <title>籃球比賽紀錄單</title>
    <style></style>
    <script src = js/index.js></script>
</head>
<body>
    <div class="container" style="position: relative;top: 200px;" >
        <div class="row justify-content-between">
            <div class="col-4"><input type="button" value="比賽紀錄" class ="btn" onclick="jump_game()"></div>
            <div class="col-4"><input type="button" value="球員紀錄" class ="btn" onclick="location.href='member_record.php'" style="margin:0 auto;"></div>
        </div>
    </div>
</body>
</html>
