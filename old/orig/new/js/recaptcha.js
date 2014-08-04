
$('#send').click(function(){
    var data_string = $('#ajax-form').serialize();
    $.ajax({
        type: 'POST',
        url: $('#ajax-form').attr('action'),
        data: data_string,
        timeout: 6000,
        error: function(request,error) {
            if (error == "timeout") {
                $('#err-timedout').slideDown('slow');
            }
            else {
                $('#err-state').slideDown('slow');
                $("#err-state").html('An error occurred: ' + error + '');
            }
        },
        
        success: function(data) {
            $('#ajax-form').slideUp('slow');
            $('#ajaxsuccess').slideDown('slow');
            $('#ajaxsuccess').html(data);
        }
    });
});

