<?php
/* ---------------------------------------------------------------------------------------------------
	
	Service Module
	
--------------------------------------------------------------------------------------------------- */

/* Create module */
$module[] = array( 	'title' => 'Service',
					'type'  => 'module_start',
					'sc'	=> 'service' );

$module[] = array( 	'title' => 'Content Before',
					'desc'  => 'Enter some content here that you want to show before the actual output of this module.',
					'id'    => 'content_before',
					'std'   => '',
					'type'  => 'textarea' );
					
$module[] = array( 	'title' => 'Icon',
					'desc'  => 'Choose the image related to the service.',
					'id'    => 'icon',
					'std'   => '',
					'type'  => 'service_icons' );
					
$module[] = array( 	'title' => 'Content',
					'desc'  => 'Enter the content here. <strong>HTML supported</strong>',
					'id'    => 'content',
					'std'   => '',
					'type'  => 'textarea' );
					
$module[] = array( 	'title' => 'Content After',
					'desc'  => 'Enter some content here that you want to show after the actual output of this module.',
					'id'    => 'content_after',
					'std'   => '',
					'type'  => 'textarea' );
					
$module[] = array( 	'type'  => 'module_end' );
					

										 

/* Module shortcode */
if(!is_admin()){
	add_shortcode('service', 'jw_service');
}else{
	add_shortcode('service', 'jw_service_admin');
}

function jw_service($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'icon' => '',
		'content' => '',
		'content_before' => '',
		'content_after' => ''
	), $atts));
	
	$output = '';
	
	global $sn;
	$style = get_option($sn.'_style');
	
	if(isset($style) && $style == 'dark'){
		$icon = str_replace('images/icons/', 'images/icons/dark/', $icon);
	}
	
	$output .= $content_before.'<div class="clear"></div>';
	
	$output .= '<div class="service">
		<img class="service-icon" src="'.get_template_directory_uri().$icon.'" />
		<div class="service-content">'.$content.'</div>
	</div>';
	
	$output .= '<div class="clear"></div>'.$content_after;
	
	return $output;
	
}

function jw_service_admin($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'icon' => '',
		'content' => '',
		'content_before' => '',
		'content_after' => ''
	), $atts));
	
	$output  = '<input type="hidden" class="jw-module-info-att jw-module-info-icon" title="icon" value="'.$icon.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content" title="content" value="'.$content.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_before" title="content_before" value="'.$content_before.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_after" title="content_after" value="'.$content_after.'">';
	
	return $output;
	
}