<?php

//Load WordPress
define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

$mail_to = $_REQUEST['email_to'];
$mail_subject = 'Message from '.get_bloginfo('name');

$success_msg = $_REQUEST['success_msg'];
$fail_msg = $_REQUEST['fail_msg'];

$sendmail = false;

if(isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['message'])) {
	
	$mailbody = "Message sent from IP: {$_SERVER['REMOTE_ADDR']}\n";
	$mailbody .= "Name: ".strip_tags($_REQUEST['name'])."\n";
	$mailbody .= "Email: ".strip_tags($_REQUEST['email'])."\n\n";
	$mailbody .= "Message:\n";
	$mailbody .= strip_tags($_REQUEST['message']);
	@mail($mail_to, $mail_subject, $mailbody);
	$sendmail = true;
	
}

if($sendmail === true) {
	echo $success_msg;
}else{
	echo $fail_msg;
}

?>