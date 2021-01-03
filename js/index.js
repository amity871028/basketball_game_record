function checkTeamName(href) {
    if(!localStorage.getItem('team_name')){
        var teamName = prompt("請輸入所在隊伍名稱");
        if (teamName == null || teamName == "")  
            {
               alert("隊伍名稱為空白無法進入頁面");
            }
            else {
                location.href= href;
                localStorage.setItem("team_name",teamName);
            }
    }
    else {
        location.href= href;
    }       
}

function init(){
    if(!localStorage.getItem('team_name')){
        var teamName = prompt("請輸入所在隊伍名稱");
        if (teamName == null || teamName == "")  
            {
               alert("隊伍名稱為空白無法進入頁面");
            }
            else {
                localStorage.setItem("team_name",teamName);
            }
    }
}

window.addEventListener('load', init);