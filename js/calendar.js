/* global FullCalendar */
document.addEventListener('DOMContentLoaded', function() {
    var calendarEvents = [],//Calendar Object [{}] of arrays
        calendarEl = document.getElementById('calendar'),
        calendar = null;
    var startTime, endTime, titleCurrent, addressCurrent; 
    initializeCalendar();
    function initializeCalendar(){
         $.post('../workers/events.php',{'postType':'getEvents'},function(result){
            //console.log(result);
            if(result.length){//if there are events
                result = JSON.parse(result);
                var title = result.title,
                    url = result.url,
                    start = result.start,
                    end = result.end,
                    address = result.address;
                calendarEvents = result.events;
                calendar = new FullCalendar.Calendar(calendarEl, {timeZone: 'UTC',initialView: 'dayGridMonth',
                headerToolbar: {left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek,timeGridDay'},
                dateClick: function(info) { addEvent(info); },
                eventClick: function(info) { rsvp(info); },
                events: calendarEvents
                });
                calendar.render();
            }
        });
    }
    function rsvp(info){
        var title = info.event.title,
                url = info.event.url,
                start = info.event.start,
                end = info.event.end,
                address = info.event.address;
        titleCurrent = title;
        startTime = start;
        $('#title-rsvp').html(title);
        $('#rsvp-url').html(url);
        $('#rsvp-start').html(start);
        $('#rsvp-end').html(end);
        if(address === undefined || address.length < 1)
            for(var i = 0; i < calendarEvents.length;i++){
                var current = calendarEvents[i];
                if(current.title === title)
                    address = current.address;
            }
        addressCurrent = address;
        $('#rsvp-location').html(address);
        $('#rsvp').removeClass('d-none').hide().fadeIn('fast');
        $(window).on('mouseup touchend',function(e){
            var container = $("#rsvp .container");
            // if the target of the click isn't the container and not a descendant of the container or is the close btn
            if (!$(e.target).is(e.container) && container.has(e.target).length === 0 || $(e.target).is($('#event-close'))) {
                if(!$('#rsvp').hasClass('d-none'))$('#rsvp').fadeOut('fast').addClass('d-none');
            }
        });
    }
    function addEvent(info){
        startTime = new Date(info.dateStr);
        startTime.setDate(startTime.getDate() + 1);
        endTime = new Date(info.dateStr);
        endTime.setDate(endTime.getDate() + 1);
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
    setTimeout(function(){//wait for get request to process
        if(calendarEvents.length < 1){
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
    },1000);
    $('#btn-rsvp').on('click',function(event){
        var email = $('#email-rsvp').val();
        if(isEmail(email)){
            $('#addEvent').fadeOut('fast').hide().addClass('d-none');
            $.post('../workers/events.php',{'start':startTime,'postType':'regEvents','email':email,'title':titleCurrent,'address':addressCurrent},function(data){
                data = JSON.parse(data);
                alert(data.msg);
            });
        }else{
            alert("you must enter a valid email address to register");
        }
    });
    $('#export').on('click',function(){
        window.location.href = "../workers/exportDatabase.php";
    });
    $('#btn-event').on('click',function(e){
        e.preventDefault();
        console.log(startTime.toDateString());
        var title = $('#event_title').val(),//event title
            address = $('#event_address').val(),//event location
            start = $('#event_start').val()/100,//event_start
            end = $('#event_end').val()/100;//event_end
            
        var year = endTime.getFullYear();
        var month = endTime.getMonth()+1;
        var day = startTime.getDate();
        var year = endTime.getFullYear();
        var hourStart = start;
        var hourEnd = end;
        console.log("year: "+year);
        console.log("month: "+month);
        console.log("day: "+day);
        console.log("hourStart: "+hourStart);
        console.log("hourEnd: "+hourEnd);

        var data = {
            "postType":'setEvent',
            "title":title,
            "address":address,
            "year":year,
            "month":month,
            "day":day,
            "start":hourStart,
            "end":hourEnd
        };
        console.log(data);
        if(title.length > 1){
            console.log('event start: '+data.start);
            $.post('../workers/events.php',data,function(result){
            //$.post("../index.php",data,function(result){
                console.log(result);
                result = JSON.parse(result);
                if(result.error === 0){
                    $('#addEvent').fadeOut('fast').addClass('d-none');
                    initializeCalendar();
                    
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
});//DOM loaded