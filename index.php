
<?php
    include("narvbar.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>籃球比賽紀錄單</title>
    <style>
        body {
            text-align: center;
        }

        .btn {
            border: 0 solid;
            box-shadow: inset 0 0 20px rgba(153, 204, 255, 0);
            outline: 1px solid;
            outline-color: rgba(153, 204, 255, .5);
            outline-offset: 0px;
            text-shadow: none;
            transition: all 1250ms cubic-bezier(0.19, 1, 0.22, 1);
        } 
 
        .btn:hover {
            background: #005AB5;
            border: 1px solid;
            box-shadow: inset 0 0 20px rgba(153, 204, 255, .5), 0 0 20px rgba(153, 204, 255, .2);
            outline-color: rgba(153, 204, 255, 0);
            outline-offset: 15px;
            text-shadow: 1px 1px 2px #005AB5; 
            border-radius: 30px 30px 30px 30px;
            color: white
        }
        
    </style>
    <script>
      
    </script>
</head>
<body>
<input type="button" value="比賽紀錄" class ="btn" onclick="location.href='game_record.php'">
<input type="button" value="球員紀錄" class ="btn" onclick="location.href='member_record.php'">

</body>
</html>
