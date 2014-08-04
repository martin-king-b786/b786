<?php

/* Code by David McKeown - craftedbydavid.com */
/* Editable entries are bellow */

$send_to = "callback@brand786.com";
$send_subject = "Website Callback Request";



/*Be careful when editing below this line */

$f_name = cleanupentries($_POST["name"]);
$f_email = cleanupentries($_POST["email"]);
$f_phone = cleanupentries($_POST["phone"]);
$f_time = cleanupentries($_POST["time"]);
$f_message = cleanupentries($_POST["message"]);
$from_ip = $_SERVER['REMOTE_ADDR'];
$from_browser = $_SERVER['HTTP_USER_AGENT'];

function cleanupentries($entry) {
	$entry = trim($entry);
	$entry = stripslashes($entry);
	$entry = htmlspecialchars($entry);

	return $entry;
}

$message = "Name: " . $f_name . 
"\n\nE-Mail: " . $f_email . 
"\nPhone: " . $f_phone . 
"\nTime: " . $f_time . 
"\n\nMessage: \n" . $f_message . 
"\n\n\nTechnical Details:\n" . date('d/m/Y H:i:s') . "\n" . $from_ip . "\n" . $from_browser;

$send_subject .= " - {$f_name}";

$headers = "From: " . $f_email . "\r\n" .
    "Reply-To: " . $f_email . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

if (!$f_email) {
	echo "no email";
	exit;
}else if (!$f_name){
	echo "no name";
	exit;
}else{
	if (filter_var($f_email, FILTER_VALIDATE_EMAIL)) {
		mail($send_to, $send_subject, $message, $headers);
		echo "true";
	}else{
		echo "invalid email";
		exit;
	}
}

?>