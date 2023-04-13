/* 
 * licensed under the GPL.
 */

/* global home, login */

jQuery(document).ready(function($){
    var login = data.login;
    $('#btn-login').on('click',function(e){
        e.preventDefault();
        var size = $(this).height();
        var busyHtml = '<img height="'+size+'px" width="'+size+'px" src="'+data.home+'/images/busy.gif" />Working ';
        $(this).html(busyHtml);  
        signIn();
    });
    //sign in - pulls user/pass from form and attempts to login
    function signIn(){
        //check quick validation - 1st of many
        var valid = $("#login_email").val() !== "" && $("#login_password").val().length > 4 && $("#login_email").val().indexOf("@") > 0 && $("#login_email").val().indexOf(".") > 0;
        //get data
        var data ={
            'email':$("#login_email").val(),
            'password':$("#login_password").val()
        };

        //post if valid
        //creates user..
        log(valid);
        if(true){
            console.log(login);
            $.post(login,data, function( response ) {
                var output = '';//for final message
                if(response.error === 1){ //load json data from server and output message     
                    output += '<p class="alert alert-error">'+response.msg+'</p>';//error message
                    $( "#result" ).html( output ).slideDown(2000);//show error message
                }else{//success
                    output = '<p class="alert alert-success">'+response.msg+'</p>';//success nessage
                    $( "#result" ).html( output ).slideDown(2000);//show message
                    //window.location = "<?=customerPage?>";//go to home
                }
                console.log(response);
                $('#btn-login').html('Login');
            },'json');
        }else{//show error message
            $('#result').html('<p class="alert alert-error">invalid password or email</p>').slideDown(1000);
            $('#btn-login').html('Login');
        }
    }
    
    //show login section
    $('#signin').on('click',function(e){
        e.preventDefault();
        $('#login').removeClass('d-none').hide().fadeIn('fast');
    });
    //close login if click close btn or click off login area
    $(window).on('mouseup touchend',function(e){
        e.preventDefault();
        var container = $(".login-box");
        // if the target of the click isn't the container and not a descendant of the container or is the close btn
        if (!$(e.target).is(e.container) && container.has(e.target).length === 0 || $(e.target).is($('#login-close'))) {
            $('#login').fadeOut('fast').addClass('d-none');
        }
    });
    $('.login-container').on('click',function(){$('#login').fadeOut('fast');});
    function log(s){
        console.log(s);
    }
 
});