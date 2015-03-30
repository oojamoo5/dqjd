<?php
/* ---------------------------------------------------------------------------------------------------
	
	Blank Module
	
--------------------------------------------------------------------------------------------------- */

/* Create module */
$module[] = array( 	'title' => 'Separator',
					'type'  => 'module_start',
					'sc'	=> 'separator'
					);
					
$module[] = array( 	'title' => 'Type',
					'desc'  => 'Choose the type of the separator.',
					'id'    => 'type',
					'std'   => 'clean',
					'opts'	=> array( 'Clean' => 'clean', 'Line' => 'line' ),
					'type'  => 'select' );
					
$module[] = array( 	'title' => 'Size',
					'desc'  => 'Choose the size of the separator.',
					'id'    => 'sep_size',
					'std'   => 'normal',
					'opts'	=> array( 'Small' => 'small', 'Normal' => 'normal',  'Big' => 'big' ),
					'type'  => 'select' );
					
$module[] = array( 	'type'  => 'module_end' );
					

										 

/* Module shortcode */
if(!is_admin()){
	add_shortcode('separator', 'jw_separator');
}else{
	add_shortcode('separator', 'jw_separator_admin');
}

function jw_separator($atts, $content=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'type' => 'clean',
		'sep_size' => 'normal',
	), $atts));
	
	$content = '<div class="separator '.$type.' '.$sep_size.'"></div>';
	
	return do_shortcode($content);
	
}

function jw_separator_admin($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'type' => 'clean',
		'sep_size' => 'normal'
	), $atts));
	
	$output = '';
	
	$output .= '<input type="hidden" class="jw-module-info-att jw-module-info-type" title="type" value="'.$type.'">';
	$output .= '<input type="hidden" class="jw-module-info-att jw-module-info-sep_size" title="sep_size" value="'.$sep_size.'">';
	
	return $output;
	
}