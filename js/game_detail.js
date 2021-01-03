const url = location.href;
const idPosition = url.match("id=").index + 3;
const id = parseInt(url.substring(idPosition));

async function editData(e){
    document.getElementById('add-field-btn').setAttribute('style', 'display: initial');

    let memberPerformDetailTrs = document.querySelectorAll('#member-performance-tbody tr');
    let pointDetailTrs = document.querySelectorAll('#point-tbody tr');
    let foulDetailTrs = document.querySelectorAll('#foul-tbody tr');

    if(e.target.innerHTML == "編輯"){
        e.target.innerHTML = "完成";
        // let table can be edited
        memberPerformDetailTrs.forEach(memberPerformDetailTr => {
            let Td = memberPerformDetailTr.cells;
            for(let i = 2; i < Td.length-2; i++){
                Td[i].innerHTML = '<input type="number" min = "0" value = "' + Td[i].innerHTML + '">';
            }
        });

        pointDetailTrs.forEach(pointDetailTr =>{
            let Td = pointDetailTr.cells;
            for(let i = 1; i < Td.length; i++){
                Td[i].innerHTML = '<input type="number" min = "0" value = "' + Td[i].innerHTML + '">';
            }
        });

        foulDetailTrs.forEach(foulDetailTr => {
            let Td = foulDetailTr.cells;
            for(let i = 1; i < Td.length; i++){
                Td[i].innerHTML = '<input type="number" min = "0" value = "' + Td[i].innerHTML + '">';
            }
        });


    }
    else {
        const memberPerformColumns = ["game_id", "number", "field_goal", "field_goal_attempt", "three_point_shot", "three_point_shot_attempt", "free_throw", "free_throw_attempt", "offensive_rebound", "defensive_rebound", "assist", "steal", "block_shot", "turnover", "foul"];
        const pointColumns = ["game_id", "team", "first_period_point", "second_period_point", "third_period_point", "fourth_period_point"];
        const foulColumns = ["game_id", "team", "first_period_foul", "second_period_foul", "third_period_foul", "fourth_period_foul"];

        // update fields
        for(let memberPerformDetailTr of memberPerformDetailTrs){
            let Tds = memberPerformDetailTr.cells;
            let number = parseInt(Tds[1].innerHTML);
            let tmp = {};
            tmp['game_id'] = id;
            tmp['number'] = number;
            for(let i = 2; i < Tds.length - 2; i++){
                let point = parseInt(Tds[i].children[0].value);
                tmp[memberPerformColumns[i]] = point;
            }
            const result = await FetchData.post('./src/update_member_perform.php', tmp);
        }

        let now = 0;
        for(let pointDetailTr of pointDetailTrs){
            let Tds = pointDetailTr.cells;
            let tmp = {};
            tmp['func'] = 'point';
            tmp['game_id'] = id;
            if(now == 0) tmp['team'] = 'home';
            else tmp['team'] = 'guest';
            now++;
            
            for(let i = 1; i < Tds.length; i++){
                let point = parseInt(Tds[i].children[0].value);
                tmp[pointColumns[i+1]] = point;
            }
            const result = await FetchData.post('./src/update_team_perform.php', tmp);
        }

        now = 0;
        for(let foulDetailTr of foulDetailTrs){
            let Tds = foulDetailTr.cells;
            let tmp = {};
            tmp['func'] = 'foul';
            tmp['game_id'] = id;
            if(now == 0) tmp['team'] = 'home';
            else tmp['team'] = 'guest';
            now++;
            
            for(let i = 1; i < Tds.length; i++){
                let point = parseInt(Tds[i].children[0].value);
                tmp[foulColumns[i+1]] = point;
            }
            const result = await FetchData.post('./src/update_team_perform.php', tmp);
        }
        window.location.reload();
    }
}

async function changeMemberOption(e, action){
    if(action == "name"){
        let name = e.value;
        const result = await FetchData.get(`./src/get_member_detail.php?name=${name}`);
        let numberJson = await result.json();
        let memberNumSelection = document.getElementsByName('member-number');
        memberNumSelection[0].value = numberJson['number'];
    }
    else {
        let number = e.value;
        const result = await FetchData.get(`./src/get_member_detail.php?number=${number}`);
        let nameJson = await result.json();
        let memberNameSelection = document.getElementsByName('member-name');
        memberNameSelection[0].value = nameJson['name'];
    }
}

async function addField(){
    let memberPerformTBody = document.getElementById('member-performance-tbody');
    
    // record exist members
    let memberPerformDetailTrs = document.querySelectorAll('#member-performance-tbody tr');
    let existNums = [];
    memberPerformDetailTrs.forEach(memberPerformDetailTr => {
        let Td = memberPerformDetailTr.cells;
        existNums.push(Td[1].innerHTML);
    });
    let memberNameSelection = document.getElementsByName('member-name');
    let name = memberNameSelection[0].value;
    let memberNumSelection = document.getElementsByName('member-number');
    let number = memberNumSelection[0].value;

    // check whether member exist
    if(existNums.includes(number)){
        alert("已經新增過這個球員囉！");
        return;
    }

    // add new field
    let tmp =  `<tr> \
        <td>${name}</td><td>${number}</td><td><input type="number" min = "0" value="0"></td><td><input type="number" min = "0" value="0"></td><td><input type="number" min = "0" value="0"></td><td><input type="number" min = "0" value="0"></td><td><input type="number" min = "0" value="0"></td><td><input type="number" min = "0" value="0"></td><td><input type="number" min = "0" value="0"></td><td><input type="number" min = "0" value="0"></td><td><input type="number" min = "0" value="0"></td><td><input type="number" min = "0" value="0"></td><td><input type="number" min = "0" value="0"></td><td><input type="number" min = "0" value="0"></td><td><input type="number" min = "0" value="0"></td><td>0</td><td><button type="button" class="btn btn-primary" id="delete-${number}" onclick="deleteField(this)">刪除</button></td> \
        </tr>`;
    memberPerformTBody.innerHTML += tmp;

    const result = await FetchData.post('./src/new_member_perform.php', {
        id: id,
        number: number
    });
    $('#add-field-modal').modal('hide');
}

async function deleteField(e){
    const number = parseInt(e.id.split('-')[1]);
    const result = await FetchData.post('./src/delete_member_perform.php', {
        id: id,
        number: number
    });
    window.location.reload();
}

function setTeamName(){
    if(localStorage.getItem('team_name')){
        let teamName = localStorage.getItem('team_name');
        let teamNameSpans = document.getElementsByName('team-name');
        teamNameSpans.forEach(each => {
            each.innerHTML = teamName;
        });
    }
    else {
        alert('還沒設定你的隊伍名稱！');
        window.location.href = "index.php";
    }
}

function init(){
    if(!localStorage.getItem('team_name')){
        alert('尚未設定隊伍名！');
        location.href = 'index.php';
    }

    setTeamName();
    document.getElementById('edit-btn').addEventListener('click', editData);

    let memberNameSelection = document.getElementsByName('member-name');
    memberNameSelection[0].addEventListener('change', function(){changeMemberOption(this, 'name')});
    let memberNumSelection = document.getElementsByName('member-number');
    memberNumSelection[0].addEventListener('change', function(){changeMemberOption(this, 'number')});

    document.getElementById('add-member-btn').addEventListener('click', addField);
}
window.addEventListener('load', init);