<?php
 
require_once('recaptchalib.php');
 
// Get keys from https://www.google.com/recaptcha/admin/create
$publickey = "6LeHg_YSAAAAAACOtzSaeQ0UGK8PCc3xWx62N-7S";
$privatekey = "6LeHg_YSAAAAACJR3k1JOW3zJwu0j0iD-CXiW9mQ";
 
# the response from reCAPTCHA
$resp = null;
 
# was there a reCAPTCHA response?
if ($_POST["recaptcha_response_field"]) {
    $resp = recaptcha_check_answer ($privatekey,
        $_SERVER["REMOTE_ADDR"],
        $_POST["recaptcha_challenge_field"],
        $_POST["recaptcha_response_field"]);
 
    if ($resp->is_valid) {
        echo "success";
        exit;
        return false;
    } else {
        echo "failure";
        exit;
        return false;
    }
}
?>