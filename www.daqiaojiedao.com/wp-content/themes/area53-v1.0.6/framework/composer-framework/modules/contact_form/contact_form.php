<?php
/* ---------------------------------------------------------------------------------------------------
	
	Contact Form Module
	
--------------------------------------------------------------------------------------------------- */

/* Create module */
$module[] = array( 	'title' => 'Contact Form',
					'type'  => 'module_start',
					'sc'	=> 'contact_form' );

$module[] = array( 	'title' => 'Content Before',
					'desc'  => 'Enter some content here that you want to show before the actual output of this module.',
					'id'    => 'content_before',
					'std'   => '',
					'type'  => 'textarea' );
					
$module[] = array( 	'title' => 'Email',
					'desc'  => 'The email address you want the emails to be sent to.',
					'id'    => 'email_to',
					'std'   => '',
					'type'  => 'text' );
					
$module[] = array( 	'title' => 'Success Message',
					'desc'  => 'The message user will see after the email is sent.',
					'id'    => 'success_msg',
					'std'   => '',
					'type'  => 'text' );
					
$module[] = array( 	'title' => 'Fail Message',
					'desc'  => 'The message user will see if the email has failed to be sent.',
					'id'    => 'fail_msg',
					'std'   => '',
					'type'  => 'text' );
					
$module[] = array( 	'title' => 'Content After',
					'desc'  => 'Enter some content here that you want to show after the actual output of this module.',
					'id'    => 'content_after',
					'std'   => '',
					'type'  => 'textarea' );
					
$module[] = array( 	'type'  => 'module_end' );
					

										 

/* Module shortcode */
if(is_admin()){
	add_shortcode('contact_form', 'jw_contact_form_admin');
}

function jw_contact_form_admin($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'email_to' => '',
		'success_msg' => '',
		'fail_msg' => '',
		'content_before' => '',
		'content_after' => ''
	), $atts));
	
	$output  = '<input type="hidden" class="jw-module-info-att jw-module-info-email_to" title="email_to" value="'.$email_to.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-success_msg" title="success_msg" value="'.$success_msg.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-fail_msg" title="fail_msg" value="'.$fail_msg.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_before" title="content_before" value="'.$content_before.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_after" title="content_after" value="'.$content_after.'">';
	
	return $output;
	
}