async function editPost() {
    if (document.forms['edit_form'].reportValidity()) {
        let name = document.getElementById('edit_member_name').value;
        let number = parseInt(document.getElementById('edit_member_number').value);
        let position = document.getElementById('edit_member_position').value;
        let birth = document.getElementById('edit_member_birth').value;
        let height = parseInt(document.getElementById('edit_member_height').value);
        let weight = parseInt(document.getElementById('edit_member_weight').value);
        const result = await FetchData.post('./src/edit_member.php',{
            name: name,
            number: number,
            position: position,
            birth: birth,
            height: height,
            weight: weight
        }); 
        $('#editModal').modal('hide');
        window.location.reload();
    }
}

function init() {
    document.getElementById('edit').addEventListener('click', editPost);
}
window.addEventListener('load', init);