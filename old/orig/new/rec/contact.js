	
	function doForm(){ 
            
                recapVerify();
            
            /* var data_string = $('#ajax-form').serialize(); // Collect data from form

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
                    success: function() {
                            $('#ajax-form').slideUp('slow');
                            $('#ajaxsuccess').slideDown('slow');
                    }
            });*/

            return false; // stops user browser being directed to the php file
	}
        
        function recapVerify(){
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
                    document.forms[0].submit();
                    $('#ajax-form').slideUp('slow');
                    $('#ajaxsuccess').slideDown('slow');
                    $('#ajaxsuccess').html(data);
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
                theme: 'clean',
                callback: Recaptcha.focus_response_field
            }
	);
    }
 
    // WHEN THE DOM HAS LOADED FIRE THE reCapInsert FUNCTION TO INSERT THE reCAPTCHA
    $( document ).ready(function(){
        reCapInsert();
    });
	

