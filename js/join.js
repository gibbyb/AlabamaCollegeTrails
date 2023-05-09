
document.addEventListener('DOMContentLoaded', () => {
<<<<<<< HEAD
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
=======
    //$('#ID) to get elements by ID or $('.class') to get all elements with a class name
    //Id's should be unique to elements. classes can have multiple elements. $('.className') will return an iterable array of all elements with that class name (not at all related to what we consider a class in a compiled laguages like C++)
    
    "use strict";
    var checked = false;//variable checked - javascript will get the data type automatically
    $('#yesCheck').on('change', event => {
        if(event.target.checked === true) {
            checked = true;
            $('#noCheck').removeAttr('checked');//remove attribute
            $('#yesCheck').attr('checked','checked');//for compatability between browsers - add attribute checked=false to element ID yesCeck
            $('#yesCheck').prop('checked','checked');//add property checked="checked" (modern way of doing this)
        }
    });
    //jQuery implents the .on('eventName',function(event){..code}) function for any event such as 'click', 'change', or 'scroll'
>>>>>>> origin/master
    $('#noCheck').on('change', e => {
        if(e.target.checked === true) {
            checked = false;
            $('#yesCheck').removeAttr('checked');
            $('#noCheck').attr('checked','checked');
            $('#noCheck').prop('checked','checked');
        }
    });
<<<<<<< HEAD
    $('#joinBtn').on('click',function(e){
        e.preventDefault();
        var error = false, errorMsg="";
        if($('#name').val().length < 2){
            error = true;
            errorMsg = "Please enter a name";
        }
        if(!isEmail($('#email').val())){
=======
    $('#joinBtn').on('click',function(event){//think of event in function(event) as what is returned from this click event
        event.preventDefault();//prevent page reloading on button click
        var error = false, errorMsg="";
        if($('#name').val().length < 2){//value
            error = true;
            errorMsg = "Please enter a name";
        }
        if(!isEmail($('#email').val())){//value
>>>>>>> origin/master
            error = true;
            errorMsg = "Invalid email";
        };
        if(!error){
<<<<<<< HEAD
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
                    $('#result').html("<p class='alert alert-danger'>"+res.msg+"</p>");
                    $('#result p').hide().slideDown('fast').show();
                }else{
                    $('#result').html("<p class='alert alert-success'>"+res.msg+"</p>");
                    $('#result p').hide().slideDown('fast').show();
                }
            });
        }else{
            $('#result').html("<p class='alert alert-danger'>"+errorMsg+"</p>");
            $('#result p').slideDown('fast').show();
=======
            //$.post(url,{postDataGoingToPHP:datavalue},function(resultFromPHPString){});
            $.post('../workers/join.php',
                {   //array sent to PHP worker
                    'name':$('#name').val(),//value
                    'phone':$('#phone').val(),//value
                    'email':$('#email').val(),//value
                    'socialmediainfo':$('#socialmediainfo').val(),//value
                    'experience':$('#experience').val(),//value
                    'yesCheck':checked
                },
                function(phpResultData){//phpResultData is the array that is returned from the worker script
                    phpResultData = JSON.parse(phpResultData);//convert string to Object - otherwise result.error and result.msg will give an error and break the javascript
                    console.log(phpResultData);
                    if(phpResultData.error){//hide() just adds display:none to style. This way we can add animation slideDown(int speedInMilliseconds) or slideUp etc..
                        $('#result').html("<p class='alert alert-danger'>"+phpResultData.msg+"</p>").hide().slideDown('fast').show();//.html() retrieves text in that block 
                    }else{
                        $('#result').html("<p class='alert alert-success'>"+phpResultData.msg+"</p>").hide().slideDown('fast').show();//.html("enter new text") changes the text
                    }
                }//end function
            );//end post to PHP worker
        }else{
            $('#result').html("<p class='alert alert-danger'>"+errorMsg+"</p>").hide().slideDown('fast').show();
>>>>>>> origin/master
        }
    });
});

function isEmail(email) {
<<<<<<< HEAD
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
=======
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;//simple regex found on stackoverflow
>>>>>>> origin/master
    return regex.test(email);
}
