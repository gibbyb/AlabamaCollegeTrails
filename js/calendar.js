/* global FullCalendar */
document.addEventListener('DOMContentLoaded', function() {
    var calendarEvents = [],//Calendar Object [{}] of arrays
        calendarEl = document.getElementById('calendar'),
        calendar = null;
    var startTime, endTime; 
    initializeCalendar();
    function initializeCalendar(){
         $.post('../workers/events.php',{'postType':'getEvents'},function(result){
            console.log(result);
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
                dateClick: function(info) {
                    addEvent(info);
                },
                select: function(info) {
                    //addEvent(info);
                },
                events: calendarEvents
                });
                calendar.render();
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
        console.log('end: '+endTime);
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


});//DOM loaded