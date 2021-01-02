async function insertPost() {
    let memberTable = document.getElementById('all_member_table');
    let memberRows = memberTable.getElementsByTagName('tr');
    let numbers = [];
    memberRows.forEach(memberRow => {
        let entry = memberRow.cells;
        console.log(entry[1].innerHTML);
        numbers.push(entry[1].innerHTML);
    });
    let memberNumber = document.getElementById('insert_member_number').value;
    if(numbers.includes(memberNumber)){
        alert("背號不可重複!!");
        return;
    }

    let name = document.getElementById('insert_member_name').value;
    let number = parseInt(document.getElementById('insert_member_number').value);
    let position = document.getElementById('insert_member_position').value;
    let birth = document.getElementById('insert_member_birth').value;
    let height = parseInt(document.getElementById('insert_member_height').value);
    let weight = parseInt(document.getElementById('insert_member_weight').value);
    const result = await FetchData.post('./src/insert_member.php',{
        name: name,
        number: number,
        position: position,
        birth: birth,
        height: height,
        weight: weight
    }); 
    $('#myModal').modal('hide');
    window.location.reload();
}
function init() {
    document.getElementById('insert').addEventListener('click', insertPost);
}
window.addEventListener('load', init);