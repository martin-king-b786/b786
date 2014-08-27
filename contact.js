function doForm(){ 
    $('.error').fadeOut('slow'); // reset the error messages (hides them)

    var error = false; // we will set this true if the form isn't valid

    var name = $('input#name').val(); // get the value of the input field
    if(name == "" || name == " ") {
        $('#err-name').fadeIn('slow'); // show the error message
        error = true; // change the error state to true
    }

    var email_compare = /^([a-z0-9_.-]+)@([da-z0-9.-]+).([a-z.]{2,6})$/; // Syntax to compare against input
    var email = $('input#email').val(); // get the value of the input field
    if (email == "" || email == " ") { // check if the field is empty
        $('#err-email').fadeIn('slow'); // error - empty
        error = true;
    }
    else if (!email_compare.test(email)) { // if it's not empty check the format against our email_compare variable
        $('#err-emailvld').fadeIn('slow'); // error - not right format
        error = true;
    }

    if(error == true) {
        $('#err-form').slideDown('slow');
        return false;
    }
    else {
        recapVerify();
    }

    return false; // stops user browser being directed to the php file
}

function recapVerify(){
    var data_string = $('#ajax-form').serialize();
    $.ajax({
        type: "POST",
        url: $('#ajax-form').attr('action'),
        data:data_string,
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
        }
    });
}

function checkRecord () {
    
    if($(this).is(':checked')) {
        
    }
    
}

function deleteRecords () {
    var checkedRecords = $('input[type="checkbox"]:checked').length;
    var details_string = $('#details-form').serialize();
    $.ajax({
        type: "POST",
        url: $('#details-form').attr('action'),
        data: {checked:checkedRecords, details: details_string},
        timeout: 6000,
        error: function(request,error) {
            return false;
        },
        success: function(data) {
            var ids = data.split('&');
            var id;
            for (id in ids) {
                $('#id-'+ids[id]).slideUp();
            }
            return false;
        }
    });
    return false;
}

$(document).ready(function(){
    $('input[type="checkbox"]').change(checkRecord);
});

