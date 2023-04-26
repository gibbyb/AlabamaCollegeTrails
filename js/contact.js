$('#contact_us_btn').on('click',function(event){
    event.preventDefault();
    var data = {
        'name':$('#name').val(),
        'email':$('#email').val(),
        'phone':$('#phone').val(),
        'msg':$('#message').val()
    };
    //console.log(data);
    if(isEmail(data.email)){//security feature
        $.post('../workers/contact.php',data,function(result){
            result = JSON.parse(result);
            console.log(result);
            if(result.error){
                alert(result.msg);
            }else{
                $('#result').hide().html(result.msg).show("fast");
            }
        });
    }else{
        alert("You must enter a valid email address.");
    }
});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}