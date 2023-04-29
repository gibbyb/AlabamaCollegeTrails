
document.addEventListener('DOMContentLoaded', () => {
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
    $('#noCheck').on('change', e => {
        if(e.target.checked === true) {
            checked = false;
            $('#yesCheck').removeAttr('checked');
            $('#noCheck').attr('checked','checked');
            $('#noCheck').prop('checked','checked');
        }
    });
    $('#joinBtn').on('click',function(event){//think of event in function(event) as what is returned from this click event
        event.preventDefault();//prevent page reloading on button click
        var error = false, errorMsg="";
        if($('#name').val().length < 2){//value
            error = true;
            errorMsg = "Please enter a name";
        }
        if(!isEmail($('#email').val())){//value
            error = true;
            errorMsg = "Invalid email";
        };
        if(!error){
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
        }
    });
});

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;//simple regex found on stackoverflow
    return regex.test(email);
}
