<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]>
<!--><html class="no-js" lang="en"><!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
        <script type="text/javascript">
 
            // VALIDATE THE FORM
            function doForm(){
                // your form validation would go here, for example:
                var isValid = $('#name').val().length != 0 ? true : false;

                if (!isValid){ // FORM VALIDATION FAILED
                    alert('Name is required');
                    return false;

                } else { //FORM VALIDATION SUCCEEDED, validate the reCAPTCHA
                    recapVerify(); // verify reCAPTCHA
                    return false;
                }
                return false;
            }

            // VALIDATE THE reCAPTCHA
            function recapVerify(){
                $.ajax({
                    type:'post',
                    url: 'captcha.php',
                    data: {
                        recaptcha_challenge_field:$('#recaptcha_challenge_field').val(),
                        recaptcha_response_field:$('#recaptcha_response_field').val()
                    }
                }).done(function(data, textStatus, jqXHR){
                    if (data == 'success'){
                        $('#err').addClass('hidden');
                        alert(data);
                        return false;
                    } else {
                        $('#err').removeClass('hidden');
                        alert(data);
                        return false;
                    }
                    
                }).fail(function(jqXHR,textStatus,errorThrown){
                    console.log('proxy or service failure');
                });
                return false;
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

        </script>
        
        <style type="text/css">
            /* place the style in your stylesheet or move this to the head of your document */
            .hidden{
                display:none;
            }
        </style>
</head>
<body>	
<form method="post" name="form1" id="form1" onsubmit="return doForm()">
 
    <!-- your form fields would go in here -->
    Name: <input class="textInput" name="Name" type="text" id="name" size="55" maxlength="55" />
 
    <!-- The reCAPTCHA wrapper is here - this is required!! -->
    <div id="recap"></div>
 
    <!-- the reCAPTCHA error div is next, edit/style as you see fit -->
    <div id="err" class="hidden" style="background-color:#FFFF00;color:#FF0000;margin:12px 0px 12px 0px;">The Captcha wasn't entered correctly. Please try again.</div>
 
    <!-- the submit button -->
    <input type="submit" name="button" id="button" value="Submit" />
</form>
							
</body>
</html>