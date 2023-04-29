
document.addEventListener('DOMContentLoaded', () => {
    "use strict";
    var checked = false;
    $('#yesCheck').on('change', e => {
        if(e.target.checked === true) {
            checked = true;
            $('#noCheck').removeAttr('checked');//remove attribute
            $('#yesCheck').attr('checked','checked');//for compatability between browsers - add attribute checked=false to element ID yesCeck
            $('#yesCheck').prop('checked','checked');//add property checked="checked" (modern way of doing this)
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
        e.preventDefault();//prevent page reloading on button click
        var error = false, errorMsg="";
        if($('#name').val().length < 2){//value
            error = true;
            errorMsg = "Please enter a name";
        }
        if(!isEmail($('#email').val())){
            error = true;
            errorMsg = "Invalid email";
        };
        if(!error){//$.post(url,{data:datavalue},function(result){});
            $.post('../workers/join.php',{
                'name':$('#name').val(),
                'phone':$('#phone').val(),
                'email':$('#email').val(),
                'socialmediainfo':$('#socialmediainfo').val(),
                'experience':$('#experience').val(),
                'yesCheck':checked
            },function(res){
                res = JSON.parse(res);//convert string to Object - otherwise result.error will give an error
                console.log(res);
                if(res.error){//hide() just adds display:none to style. This way we can add animation slideDown(int speedInMilliseconds) or slideUp etc..
                    $('#result').html("<p class='alert alert-danger'>"+res.msg+"</p>").hide().slideDown('fast').show();//.html() retrieves text in that block 
                }else{//$('#ID) to get elements by ID or $('.class') to get all elements with a class name
                    $('#result').html("<p class='alert alert-success'>"+res.msg+"</p>").hide().slideDown('fast').show();//.html("enter new text") changes the text
                }
            });
        }else{
            $('#result').html("<p class='alert alert-danger'>"+errorMsg+"</p>").hide().slideDown('fast').show();
        }
    });
});

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;//simple regex found on stackoverflow
    return regex.test(email);
}
