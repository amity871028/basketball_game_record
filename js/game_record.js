function add() {
        document.getElementById('all_light').style.display = 'block';
        document.getElementById('contes').style.display = 'block';
}

function set_team_name() {
    var team_name = document.getElementById("team_name").value;
    var nowkey = localStorage.getItem("Key");
    localStorage.setItem(nowkey,team_name);
    var y =  Number(nowkey) + 1;
    localStorage.setItem("Key",String(y));
}

function init(){
    if(!localStorage.getItem('team_name')){
        alert('尚未設定隊伍名！');
        location.href = 'index.php';
    }
}

window.addEventListener('load', init);
