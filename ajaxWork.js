



function showControl(){
    $.ajax({
        url:"users.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}


function updateUser(id){
    $.ajax({
        url:"updateUser.php",
        method:"post",
        data:{id:id},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

function deleteUser(id){
    $.ajax({
        url:"deleteUser.php",
        method:"post",
        data:{id:id},
        success:function(data){
            alert('Successfully deleted');
            $('form').trigger('reset');
            showControl();
        }
    });
}

function userUpdated(id){
    $.ajax({
        url:"./adminView/updateUser.php",
        method:"post",
        data:{userid:id},
        success:function(data){
            alert('Successfully Updated');
            $('form').trigger('reset');

        }
    });
}
