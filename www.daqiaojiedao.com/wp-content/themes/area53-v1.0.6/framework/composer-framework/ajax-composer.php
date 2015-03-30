<?php
/* ---------------------------------------------------------------------------------------------------
	
	AJAX Composer
	
--------------------------------------------------------------------------------------------------- */

define('WP_USE_THEMES', false);
define('WP_ADMIN', true);
define('WP_DEBUG', false);
require('../../../../../wp-load.php');

if(!current_user_can('administrator') && !current_user_can('editor')){ die(); }

if(isset($_GET['action'])){
	$action = $_GET['action'];
}else{
	$action = '';
}

if(isset($_GET['module'])){
	$module_title = $_GET['module'];
}else{
	$module_title = '';
}

if($action == ''){

	$options = array();

	include get_template_directory().'/framework/composer-framework/modules/'.$module_title.'/'.$module_title.'.php';

	$accept_parameters = false;

	foreach($module as $module_item){
			
		if($module_item['type'] == 'module_start'){
			
			if($module_item['sc'] == $module_title){
				
				$accept_parameters = true;
				
			}else{
				
				$accept_parameters = false;
				
			}
			
		}
		
		if($accept_parameters == true){
			
			if($module_item['type'] != 'module_start' && $module_item['type'] != 'module_end'){
			
				$options[] = $module_item;
				
			}
			
		}
		
	}

	/* Include the fields helper. Returns $jw_content and $jw_sidebar. */
	$fields_for = 'composer';
	
	include get_template_directory().'/framework/_lib/helper.fields.php';
	
	$jw_content = '<p style="margin-bottom:30px;"><a href="#" class="button-primary module-edit-action-save">Save</a> <a href="#" class="button-secondary module-edit-action-close">Close</a></p>'.$jw_content.'<p><a href="#" class="button-primary module-edit-action-save">Save</a> <a href="#" class="button-secondary module-edit-action-close">Close</a></p>';

	echo $jw_content;
	
}else if($action == 'import'){
	
	$code_main = $_POST['code_main'];
	$code_top = $_POST['code_top'];
	$code_bottom = $_POST['code_bottom'];
	
	/* Include Modules */
	global $jw_composer_modules_support;
	foreach($jw_composer_modules_support as $jw_composer_module){
		include get_template_directory().'/framework/composer-framework/modules/'.$jw_composer_module.'/'.$jw_composer_module.'.php';
	}
	
	$return = array();
	$return['code_main'] = do_shortcode(str_replace('\\', '', $code_main));
	$return['code_top'] = do_shortcode(str_replace('\\', '', $code_top));
	$return['code_bottom'] = do_shortcode(str_replace('\\', '', $code_bottom));
	
	echo json_encode($return);
	
}else if($action == 'load'){
	
	$template_id = $_POST['template_id'];
	
	include get_template_directory().'/framework/composer-framework/templates.php';
	
	/* Include Modules */
	global $jw_composer_modules_support;
	foreach($jw_composer_modules_support as $jw_composer_module){
		include get_template_directory().'/framework/composer-framework/modules/'.$jw_composer_module.'/'.$jw_composer_module.'.php';
	}
	
	$tpl_code = 'none';
	
	foreach($tpl as $tpl_item){
		
		if($tpl_item['id'] == $template_id){
			
			$tpl_code_main = $tpl_item['code_main'];
			$tpl_code_top = $tpl_item['code_top'];
			$tpl_code_bottom = $tpl_item['code_bottom'];
			
		}
		
	}
	
	$return = array();
	$return['code_main'] = do_shortcode($tpl_code_main);
	$return['code_top'] = do_shortcode($tpl_code_top);
	$return['code_bottom'] = do_shortcode($tpl_code_bottom);
	
	echo json_encode($return);

}else if($action == 'load_user_made'){

	/* Include Modules */
	global $jw_composer_modules_support;
	foreach($jw_composer_modules_support as $jw_composer_module){
		include get_template_directory().'/framework/composer-framework/modules/'.$jw_composer_module.'/'.$jw_composer_module.'.php';
	}

	/* Template info */
	$tpl_title = $_POST['template_title'];
	
	/* Current templates */
	$current_tpls = unserialize(get_option('jw_user_made_composer_templates'));
	
	/* Find the needed template */
	foreach($current_tpls as $current_tpl){
		
		if($current_tpl['title'] == $tpl_title){
			
			$tpl_code_main = str_replace('\\', '', $current_tpl['code_main']);
			$tpl_code_top = str_replace('\\', '', $current_tpl['code_top']);
			$tpl_code_bottom = str_replace('\\', '', $current_tpl['code_bottom']);
			
		}
		
	}
	
	/* Prepare the return array */
	$return = array();
	$return['code_main'] = do_shortcode($tpl_code_main);
	$return['code_top'] = do_shortcode($tpl_code_top);
	$return['code_bottom'] = do_shortcode($tpl_code_bottom);
	
	/* Pass it on to JS */
	echo json_encode($return);
	
}else if($action == 'save'){
	
	/* Current templates */
	$current_tpls = unserialize(get_option('jw_user_made_composer_templates'));
	
	/* New template info */
	$title = $_POST['title'];
	$code_main = $_POST['code_main'];
	$code_top = $_POST['code_top'];
	$code_bottom = $_POST['code_bottom'];
	
	/* New template array */
	$new_tpl = array(	'title' 		=> $title,
						'code_main' 	=> $code_main,
						'code_top' 		=> $code_top,
						'code_bottom'	=> $code_bottom );
	
	/* Append new template to current ones */
	$current_tpls[] = $new_tpl;
	
	/* Serialize array */
	$current_tpls_serialized = serialize($current_tpls);
	
	/* Save new templates */
	update_option('jw_user_made_composer_templates', $current_tpls_serialized);
	
	echo 'end';
	
	
}else if($action == 'remove_user_made'){
	
	/* Current templates */
	$current_tpls = unserialize(get_option('jw_user_made_composer_templates'));
	
	/* template info */
	$title = $_POST['template_title'];
	
	$new_tpls = array();
	
	foreach($current_tpls as $current_tpl){
		
		if($current_tpl['title'] != $title){
			
			$new_tpls[] = array(	'title' 		=> $current_tpl['title'],
									'code_main' 	=> $current_tpl['code_main'],
									'code_top' 		=> $current_tpl['code_top'],
									'code_bottom'	=> $current_tpl['code_bottom'] );
			
		}
		
	}
	
	/* Serialize array */
	$new_tpls_serialized = serialize($new_tpls);
	
	/* Save new templates */
	if(update_option('jw_user_made_composer_templates', $new_tpls_serialized)){
		echo 'true';
	}else{
		echo 'false';
	}
	
}elseif($action == 'slider_slides'){
	
	$slider_slides = $_POST['val'];
	$slider_slides = str_replace('\"', '"', $slider_slides);
	
	echo do_shortcode($slider_slides);
	
}

?>