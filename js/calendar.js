/* global FullCalendar */
var calendarEvents = [],//Calendar Object [{}] of arrays
    calendarEl = document.getElementById('calendar'),
    calendar = null;
var startTime, endTime, titleCurrent, addressCurrent; 
initializeCalendar();
function initializeCalendar(){
     $.post('../workers/events.php',{'postType':'getEvents'},function(result){
        //console.log(result);
        if(result.length){//if there are events
            result = JSON.parse(result);//make JSON object
            var title = result.title,//get variables in return data
                url = result.url,
                start = result.start,
                end = result.end,
                address = result.address;
            calendarEvents = result.events;//the events as JSON array
            calendar = new FullCalendar.Calendar(calendarEl, {timeZone: 'UTC',initialView: 'dayGridMonth',
            headerToolbar: {left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek,timeGridDay'},
            dateClick: function(info) { addEvent(info); },// load popup
            eventClick: function(info) { 
                info.jsEvent.preventDefault();//disable go to url by default
                rsvp(info); //load popup
            },
            events: calendarEvents//load events
            });
            calendar.render();//render calendar
        }
    });
}
function rsvp(info){
    var data = {//set event data
            title : info.event.title,
            url : info.event.url,
            start : info.event.start,
            end : info.event.end,
            address : info.event.address//location
        };
    //workaround - info.event.address no good, info.event.end possibly no good
    for(var i = 0; i < calendarEvents.length;i++){
        var current = calendarEvents[i];
        if(current.title === data.title ){
            data.address = current.address;
            data.end = current.end;
            data.start = current.start;
            data.title = current.title;
            data.url = current.url;
        }
    }
    titleCurrent = data.title;//set global variable
    addressCurrent = data.address;//set global variable
    startTime = data.start;//set global variable
    endTime = data.start;//set global variable
    $('#title-rsvp').html(data.title);//set text in popup
    $('#rsvp-url').html(data.url);//set text in popup
    $('#rsvp-start').html(data.start);//set text in popup
    $('#rsvp-end').html(data.end);//set text in popup
    $('#rsvp-location').html(data.address);//set text in popup
    $('#rsvp').removeClass('d-none').hide().fadeIn('fast');//show popup
    $(window).on('mouseup touchend',function(e){//close popup
        var container = $("#rsvp .container");//the popup (inner) container
        // if the target of the click isn't the container and not a descendant of the container or is the close btn
        if (!$(e.target).is(e.container) && container.has(e.target).length === 0 || $(e.target).is($('#event-close'))) {
            if(!$('#rsvp').hasClass('d-none'))$('#rsvp').fadeOut('fast').addClass('d-none');
        }
    });
}
//all this function does is show the popup and set the global variables
//@param Object info - data from click event (see Calendar.io)
function addEvent(info){
    startTime = new Date(info.dateStr);//set global variable
    startTime.setDate(startTime.getDate() + 1);//fix date (starts from 0) month
    endTime = new Date(info.dateStr);//set global variable
    endTime.setDate(endTime.getDate() + 1);//fix date (starts from 0) month
    //show add event container
    $('#addEvent').removeClass('d-none').hide().fadeIn('fast');
    $(window).on('mouseup touchend',function(e){
        var container = $("#addEvent .container");
        // if the target of the click isn't the container and not a descendant of the container or is the close btn
        if (!$(e.target).is(e.container) && container.has(e.target).length === 0 || $(e.target).is($('#event-close'))) {
            if(!$('#addEvent').hasClass('d-none'))$('#addEvent').fadeOut('fast').addClass('d-none');
        }
    });
}
setTimeout(function(){//wait for events[] GET request to process
    if(calendarEvents.length < 1){//no events - load demo data
        calendar = new FullCalendar.Calendar(calendarEl, {timeZone: 'UTC',initialView: 'dayGridMonth',
            headerToolbar: {left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek,timeGridDay'},
            dateClick: function(info) {
                addEvent(info);
            },
            select: function(info) {
                //addEvent(info);
            },
            events: 'https://fullcalendar.io/api/demo-feeds/events.json'
        });
        calendar.render();
    }
},1000);//1 full second should be enough 95% of the time
$('#btn-rsvp').on('click',function(event){//RSVP btn
    var email = $('#email-rsvp').val();//get email address
    if(isEmail(email)){//if valid email
        $('#addEvent').fadeOut('fast').hide().addClass('d-none');//close popup
        //send RSVP to email address UnivHikingUSM@gmail.com
        $.post('../workers/events.php',{'start':startTime,'postType':'regEvents','email':email,'title':titleCurrent,'address':addressCurrent},function(data){
            data = JSON.parse(data);//parse data
            if(data.length)//check valid data
                alert(data.msg);//show success/fail
        });
    }else{//invalid email - show message
        alert("you must enter a valid email address to register");
    }
});
//export events as csv file
$('#export').on('click',function(){//export events database btn
    window.location.href = "../workers/exportDatabase.php";//generates a csv file
});
//sets a new event - "Add Event" popup btn
$('#btn-event').on('click',function(e){
    e.preventDefault();
    console.log(startTime.toDateString());
    var data = {
        "postType":'setEvent',
        "title":$('#event_title').val(),//event title
        "url":$('#event_url').val(),//event url
        "address":$('#event_address').val(),//event location
        "year":startTime.getFullYear(),
        "month":startTime.getMonth()+1,
        "day":startTime.getDate(),
        "start":$('#event_start').val()/100,
        "end":$('#event_end').val()/100
    };
    console.log(data);
    if(data.title !== null && data.title.length > 1){
        //console.log('event start: '+data.start);
        $.post('../workers/events.php',data,function(result){
            console.log(result);
            result = JSON.parse(result);
            if(result.error === 0){
                $('#addEvent').fadeOut('fast').addClass('d-none');//hide popup
                initializeCalendar();//show changes
            }
            alert(result.msg);
        });
    }else{
        alert('A title is required to create an event.');
    }
});//end btn click

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}