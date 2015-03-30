<?php
/* ---------------------------------------------------------------------------------------------------
	
	Blank Module
	
--------------------------------------------------------------------------------------------------- */

/* Create module */
$module[] = array( 	'title' => 'Blank',
					'type'  => 'module_start',
					'sc'	=> 'blank'
					);
					
$module[] = array( 	'title' => 'Content',
					'desc'  => 'Enter the content here. <strong>HTML supported</strong>',
					'id'    => 'content',
					'std'   => '',
					'type'  => 'textarea' );
					
$module[] = array( 	'type'  => 'module_end' );
					

										 

/* Module shortcode */
if(!is_admin()){
	add_shortcode('blank', 'jw_blank');
}else{
	add_shortcode('blank', 'jw_blank_admin');
}

function jw_blank($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'content' => '',
	), $atts));
	
	$content = str_replace("&#91;", "[", $content);
	$content = str_replace("&#93;", "]", $content);
	
	return do_shortcode($content);
	
}

function jw_blank_admin($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'content' => '',
	), $atts));
	
	$output  = '<input type="hidden" class="jw-module-info-att jw-module-info-content" title="content" value="'.$content.'">';
	
	return $output;
	
}