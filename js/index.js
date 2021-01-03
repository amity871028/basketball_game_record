function jump_game() {
            var team_name = prompt("請輸入所在隊伍名稱");
            if (team_name == null || team_name == "")  
            {
               alert("隊伍名稱為空白無法進入頁面");
            }
            else {
                location.href='game_record.php';
                localStorage.setItem("team_name",team_name);
            }
            
}
