<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="index.php">籃球比賽紀錄單</a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="game_record.php">比賽紀錄</a>
            <a class="nav-item nav-link" href="member_record.php">球員紀錄</a>
        </div>
    </div>
</nav>
<?php
  $user = 'root'; //資料庫使用者名稱
  $password = '12345789'; //資料庫的密碼
  try{
      $db = new PDO('mysql:host=localhost;dbname=basketball_game_record;charset=utf8',$user,$password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  }catch(PDOException $e){ 
      Print "ERROR!: " . $e->getMessage();
  die();
  }