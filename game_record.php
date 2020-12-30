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
    <style>
 
    </style>
    <script>
    function add() {
        document.getElementById('all_light').style.display = 'block';
        document.getElementById('contes').style.display = 'block';
    }

    </script>
</head>
<body>
<div class = "d1">
    <h1>籃球比賽紀錄</h1>
    <input type="text" placeholder="比賽名稱" class="t1">
    <button class="button type3">
    Search
    </button>
    <button id = "addbtn" class="btn btn-1 a1" onclick="add()">
      <svg>
        <rect x="0" y="0" fill="none" width="100%" height="100%"/>
      </svg>
      新增場次
    </button>

<table class="responstable">
  
  <tr>
    <th>名稱</th>
    <th data-th="Driver details"><span>賽次</span></th>
    <th>主/客隊</th>
    <th>對手</th>
    <th>日期</th>
    <th>動作</th>
  </tr>
  
  <tr>
    <td>Steve</td>
    <td>7</td>
    <td></td>
    <td>01/01/1978</td>
    <td>10</td>
  </tr>
  
  <tr>
    <td>Steffie</td>
    <td>5</td>
    <td></td>
    <td>01/01/1978</td>
    <td>10</td>
  </tr>
  
  <tr>
    <td>Stan</td>
    <td>1</td>
    <td></td>
    <td>01/01/1994</td>
    <td>10</td>
  </tr>
  
  <tr>
    <td>Stella</td>
    <td>22</td>
    <td></td>
    <td>01/01/1992</td>
    <td>10</td>
  </tr>

</table>
</div>

<div id="contes" class = 'f1'> 
    <div style ="width:500px;height:40px">
    <span style = "font-size:30px;">新增場次</span>
    <hr>
    <form style=" margin-left:100px;">
        名稱 : <input type = "text" value="" name=""><br>
        賽次 : <input type="text" value=""name=""><br>
        主/客隊 : <select style = "margin-bottom:10px;" name="YourLocation">
                　<option value="">主隊</option>
                　<option value="">客隊</option>
              </select><br>
        對手 : <input type = "text" value="" name=""><br>
        日期 : <input type="date" id="birthday" name="birthday"><br>
        <hr>
        <input type="submit" value="確定"> 
        <input type="reset" value="清除">
        <input type="button" onclick="javascript:location.href='game_record.php'" value="關閉">
    </form> 
    </div>
</div>
<div id="all_light" style="display: none" ></div>
</body>

</html>
