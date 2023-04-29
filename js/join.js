$('#joinBtn').on('click', function(event)
{
    event.preventDefault();
    var data = {
        'name':$('#name').val(),
        'email':$('#email').val(),
        'phone':$('#phone').val(),
        'msg':$('#message').val(),
        'social':$('#social').val(),
        'experience':$('experience').val(),
        'answer':$('answer').val(),
        'addinfo':$('addinfo').val
    };
});
