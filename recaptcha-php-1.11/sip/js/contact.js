	
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
                type:'post',
                url: './captcha.php',
                data: {
                    recaptcha_challenge_field:$('#recaptcha_challenge_field').val(),
                    recaptcha_response_field:$('#recaptcha_response_field').val()
                }
            }).done(function(data, textStatus, jqXHR){
                if (data == 'success'){
                    $('#err').addClass('hidden');
                    $.ajax({
			type: "POST",
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
			}
                    });
                } else {
                    $('#err').removeClass('hidden');
                }
            }).fail(function(jqXHR,textStatus,errorThrown){
                console.log('proxy or service failure');
            });
        }
 
    // WHEN CALLED THIS INSETS THE reCAPTCHA INTO THE PAGE
    function reCapInsert(){
        Recaptcha.create('6LeHg_YSAAAAAACOtzSaeQ0UGK8PCc3xWx62N-7S',  // public key
        'recap',
            {
                theme: 'custom',
                custom_theme_widget: 'recap',
                callback: Recaptcha.focus_response_field
            }
	);
    }
 
    // WHEN THE DOM HAS LOADED FIRE THE reCapInsert FUNCTION TO INSERT THE reCAPTCHA
    $( document ).ready(function(){
        reCapInsert();
    });
	

