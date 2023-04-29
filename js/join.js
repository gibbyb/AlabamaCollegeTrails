
document.addEventListener('DOMContentLoaded', () => {
    "use strict";
    var checked = false;
    $('#yesCheck').on('change', e => {
        if(e.target.checked === true) {
            checked = true;
            $('#noCheck').removeAttr('checked');
            $('#yesCheck').attr('checked','checked');
            $('#yesCheck').prop('checked','checked');
        }
    });
    $('#noCheck').on('change', e => {
        if(e.target.checked === true) {
            checked = false;
            $('#yesCheck').removeAttr('checked');
            $('#noCheck').attr('checked','checked');
            $('#noCheck').prop('checked','checked');
        }
    });
    $('#joinBtn').on('click',function(e){
        e.preventDefault();
        var error = false, errorMsg="";
        if($('#name').val().length < 2){
            error = true;
            errorMsg = "Please enter a name";
        }
        if(!isEmail($('#email').val())){
            error = true;
            errorMsg = "Invalid email";
        };
        if(!error){
            $.post('../workers/join.php',{
                'name':$('#name').val(),
                'phone':$('#phone').val(),
                'email':$('#email').val(),
                'socialmediainfo':$('#socialmediainfo').val(),
                'experience':$('#experience').val(),
                'yesCheck':checked
            },function(res){
                res = JSON.parse(res);
                console.log(res);
                if(res.error){
                    $('#result').html("<p class='alert alert-danger'>"+res.msg+"</p>").hide().slideDown('fast').show();
                }else{
                    $('#result').html("<p class='alert alert-success'>"+res.msg+"</p>").hide().slideDown('fast').show();
                }
            });
        }else{
            $('#result').html("<p class='alert alert-danger'>"+errorMsg+"</p>").hide().slideDown('fast').show();
        }
    });
});

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
