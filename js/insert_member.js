async function insertPost() {
    if (document.forms['insert_form'].reportValidity()) {
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
        if(result.status == '409'){
            alert('此號碼已存在！請重新輸入');
            return;
        }
        $('#myModal').modal('hide');
        window.location.reload();
    }
}
function init() {
    document.getElementById('insert').addEventListener('click', insertPost);
}
window.addEventListener('load', init);