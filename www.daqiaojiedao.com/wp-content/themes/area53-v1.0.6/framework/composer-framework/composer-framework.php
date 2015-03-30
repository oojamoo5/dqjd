<?php
/* ---------------------------------------------------------------------------------------------------
	
	Content Composer
	
--------------------------------------------------------------------------------------------------- */

/* ---------------------------------------------------------------------------------------------------
	Javascript
--------------------------------------------------------------------------------------------------- */
add_action('admin_print_scripts', 'jw_composer_include_js');
function jw_composer_include_js(){
	
	/* Register scripts */
	wp_register_script('jw_composer_custom', get_template_directory_uri().'/framework/composer-framework/js/composer-custom.js', false);
	
	/* Enqueue scripts */
	wp_enqueue_script('jw_composer_custom');
	
}/* jw_composer_include_js() */


/* ---------------------------------------------------------------------------------------------------
	CSS
--------------------------------------------------------------------------------------------------- */
add_action('admin_print_styles', 'jw_composer_include_css');
function jw_composer_include_css(){

	/* Register styles */
	wp_register_style('jw_composer_style', get_template_directory_uri().'/framework/composer-framework/css/composer-style.css', false);
	
	/* Enqueue styles */
	wp_enqueue_style('jw_composer_style');

}/* jw_composer_include_css() */


/* ---------------------------------------------------------------------------------------------------
	Add metabox
--------------------------------------------------------------------------------------------------- */
add_action('admin_init', 'jw_composer_add_metabox', 1);
function jw_composer_add_metabox(){
	
	global $domain;
	
	add_meta_box('jw_page_metabox_compose', 'Content Composer', 'jw_composer_output', 'page', 'normal', 'high');
	add_meta_box('jw_page_metabox_compose', 'Content Composer', 'jw_composer_output', 'post', 'normal', 'high');
	add_meta_box('jw_page_metabox_compose', 'Content Composer', 'jw_composer_output', 'jw_portfolio', 'normal', 'high');
	
}/* jw_composer_add_metabox() */


/* ---------------------------------------------------------------------------------------------------
	Save data
--------------------------------------------------------------------------------------------------- */
add_action('save_post', 'jw_composer_save');
function jw_composer_save($post_id){
	
	/* If the save is triggered by the autosave WordPress feature don't continue executing the script */
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){ return $post_id; }

	$options = array();

	/* Fields to save */
	$options[] = array( 'id' => 'jw_composer_status' );
	$options[] = array( 'id' => 'jw_composer_main_backend' );
	$options[] = array( 'id' => 'jw_composer_main_frontend' );
	$options[] = array( 'id' => 'jw_composer_top_backend' );
	$options[] = array( 'id' => 'jw_composer_top_frontend' );
	$options[] = array( 'id' => 'jw_composer_bottom_backend' );
	$options[] = array( 'id' => 'jw_composer_bottom_frontend' );
	
	
	/* Go through the options */
	foreach($options as $option){
		
		/* If a values is set */
		if(isset($_POST[$option['id']])){
			
			$value = $_POST[$option['id']];
			
			/* Add if it's new */
			if (get_post_meta($post_id, $option['id']) == '') { add_post_meta($post_id, $option['id'], $value, true); }

			/* Update if already has a value */
			elseif ($value != get_post_meta($post_id, $option['id'], true)) { update_post_meta($post_id, $option['id'], $value); }

			/* Delete if empty */
			elseif ($value == '') { delete_post_meta($post_id, $option['id'], get_post_meta($post_id, $option['id'], true)); }
			
		}
		
	}
	
}/* jw_composer_save() */

/* ---------------------------------------------------------------------------------------------------
	Metabox output
--------------------------------------------------------------------------------------------------- */
function jw_composer_output($post){
	
	global $domain;
	global $jw_composer_modules_support;
	
	/* Create vars */
	$module = array(); /* Will hold all modules info */
	$output = ''; /* Will hold the HTML of the content composer */
	$composer_back = ''; /*  */
	$composer_front = ''; /* */
	$composer_back_stripped = ''; /*  */
	$composer_front_stripped = ''; /*  */
	$composer_status = ''; /* active/inactive - To determine should the composer be shown on page load or not */
	$composer_modules_html = ''; /* Will hold the HTML for the composer modules listing in the sidebar */
	
	/* Get default modules */
	foreach($jw_composer_modules_support as $jw_composer_module){
		include get_template_directory().'/framework/composer-framework/modules/'.$jw_composer_module.'/'.$jw_composer_module.'.php';
	}
	
	/* Get module info */
	foreach($module as $module_item){
		
		if($module_item['type'] == 'module_start'){
			
			if($module_item['sc'] == 'separator'){
				$module_size = 'one_one';
			}else{
				$module_size = 'one_half';
			}
			
			$composer_modules_html .= '
			<li>
				<a href="#"><small>add</small> '.$module_item['title'].'</a>
				<!-- module values -->
				<div class="jw-module-info">
					<input type="hidden" class="jw-module-info-title" value="'.$module_item['title'].'" />
					<input type="hidden" class="jw-module-info-size" value="'.$module_size.'" />
					<input type="hidden" class="jw-module-info-shortcode" value="'.$module_item['sc'].'" />';
				
		}elseif($module_item['type'] == 'module_end'){
			
			$composer_modules_html .= '
				</div>
			</li>';
			
		}else{
			
			$composer_modules_html .= '<input type="hidden" class="jw-module-info-att jw-module-info-'.$module_item['id'].'" title="'.$module_item['id'].'" value="'.$module_item['std'].'" />';
			
		}
		
		
		
	}
	
	$post_custom = get_post_custom($post->ID);
	
	$composer_content_main_html = '<li class="jw-composer-sidebar-module">
						<div class="jw-composer-sidebar-module-inner">
							This area is not available.<br /><br />
							You have chosen a post/page layout that has a sidebar and this area represents it.<br /><br />
							If you want the sidebar on the other side or you do not want a sidebar change the "Layout" in the options bellow the content composer.
						</div>
					</li>';
	
	if(isset($post_custom['jw_composer_main_backend'])){
		$composer_content_main_html .= do_shortcode($post_custom['jw_composer_main_backend'][0]);
	}
	
	if(isset($post_custom['jw_composer_top_backend'])){
		$composer_content_top_html = do_shortcode($post_custom['jw_composer_top_backend'][0]);
	}else{
		$composer_content_top_html = '';
	}
	
	if(isset($post_custom['jw_composer_bottom_backend'])){
		$composer_content_bottom_html = do_shortcode($post_custom['jw_composer_bottom_backend'][0]);
	}else{
		$composer_content_bottom_html = '';
	}
	
	if(isset($post_custom['jw_composer_status'])){
		$composer_status = $post_custom['jw_composer_status'][0];
	}else{
		$composer_status = '';
	}
	
	/* Templates */
	$tpl_list_html = '';
	include get_template_directory().'/framework/composer-framework/templates.php';
	
	foreach($tpl as $tpl_item){
		
		$tpl_list_html .= '<li><a href="#" title="'.$tpl_item['id'].'">'.$tpl_item['title'].'</a></li>';
		
	}
	
	/* User templates */
	$tpl_user_list_html = '';
	$user_tpls = unserialize(get_option('jw_user_made_composer_templates'));
	
	if(!empty($user_tpls)){
	
		foreach($user_tpls as $user_tpl){
			
			$tpl_user_list_html .= '<li><a class="jw-load-user-template" href="#" title="'.$user_tpl['title'].'">'.$user_tpl['title'].'</a><a class="jw-remove-user-template" href="#" title="'.$user_tpl['title'].'">&nbsp;</a></li>';
			
		}
	
	}
	
	/* Generate output */
	if(empty($module)){
		
		$output .= '<p>There are no active modules</p>';
		
	}else{
		
		$output .= '
		
		<link href="http://fonts.googleapis.com/css?family=Shanti" rel="stylesheet" type="text/css">
		
		<input type="hidden" id="jw-composer-ajax-path" value="'.get_template_directory_uri().'/framework/composer-framework/ajax-composer.php" />
		
		<div id="jw-composer">
			
			<div id="jw-composer-modules">
				<div id="jw-composer-modules-inner">

					<ul>
						'.$composer_modules_html.'
					</ul>
					
				</div><!-- #jw-composer-modules-inner -->
			</div><!-- #jw-composer-modules -->
			
			<div id="jw-composer-content">
				
				<div id="jw-composer-content-inner">
				
					<ul id="jw-composer-content-top">
					
						'.$composer_content_top_html.'
					
					</ul><!-- #jw-composer-content-top -->
					
					<ul id="jw-composer-content-main">
						
						'.$composer_content_main_html.'
						
					</ul>
					
					<ul id="jw-composer-content-bottom">
						
						'.$composer_content_bottom_html.'
						
					</ul><!-- #jw-composer-content-bottom -->
					
				</div><!-- #jw-composer-content-inner -->
			</div><!-- #jw-composer-content -->
			
			<div id="jw-composer-edit">
			
				<div id="jw-composer-edit-loading">Acquiring required data...</div>
				
				<div id="jw-composer-edit-content"></div>
				
			</div><!-- #jw-composer-edit -->
			
			<div id="jw-composer-menu-overlay"></div>
			
			<div id="jw-composer-menu">
				
				<div id="jw-composer-menu-right">
				
					<ul id="jw-composer-menu-list">
						<li><a href="#jw-composer-menu-load" id="jw-composer-menu-list-action-load"><strong>Load</strong> Template</a></li>
						<li><a href="#jw-composer-menu-save" id="jw-composer-menu-list-action-save" id="jw-composer-menu-list-action-load"><strong>Save</strong> Template</a></li>
						<li><a href="#jw-composer-menu-import" id="jw-composer-menu-list-action-import"><strong>Import</strong> Template</a></li>
						<li><a href="#jw-composer-menu-export" id="jw-composer-menu-list-action-export"><strong>Export</strong> Template</a></li>
					</ul>
					
					<a href="#" id="jw-composer-menu-action" class="jw-composer-menu-action-show"></a>
			
				</div>
				
				<div id="jw-composer-menu-left">
				
					<div id="jw-composer-menu-load" class="jw-composer-menu-left-contents">
						
						<div id="jw-composer-menu-load-content">
						
							<span class="jw-composer-menu-title">Load Template</span>
							<p>Bellow you can see a list of templates we made for you and a list of templates that you saved. Simply choose which one you want to load into this post/page.</p>
							
							<p>&nbsp;</p>
							
							<p><span class="jw-composer-menu-subtitle">Our Templates</span></p>
							
							<ul id="jw-composer-menu-load-our">
								'.$tpl_list_html.'
							</ul>
							
							<p><span class="jw-composer-menu-subtitle">Your Templates</span></p>
							
							<ul id="jw-composer-menu-load-user">
								'.$tpl_user_list_html.'
							</ul>
							
						</div>
						
						<div class="jw-composer-menu-loader"></div>
						
					</div>
					
					<div id="jw-composer-menu-save" class="jw-composer-menu-left-contents">
						
						<span class="jw-composer-menu-title">Save Template</span>
						<p>Here you can save the content you have in the content composer on this post/page and reuse it (with possibility to modify) on any other post/page you want.</p>
						
						<p>&nbsp;</p>
						
						<p><span class="jw-composer-menu-subtitle">Title</span></p><p><input type="text" id="jw-composer-menu-save-title" />
						
						<p><button class="button-secondary" id="jw-composer-menu-save-action-submit">Save Template</button></p>
						
					</div>
				
					<div id="jw-composer-menu-export" class="jw-composer-menu-left-contents">
						
						<span class="jw-composer-menu-title">Export Template</span>
						<p>Bellow you can see 3 textareas with text in them. That text represents the code for the content composer. You can use that code to import the same content composer content to another page on this website or a different website where you use our themes.</p>
						
						<p>&nbsp;</p>
						
						<p><span class="jw-composer-menu-subtitle">Top Area</span></p><p><textarea id="jw-composer-menu-export-top-textarea"></textarea></p>
						<p><span class="jw-composer-menu-subtitle">Main Area</span></p><p><textarea id="jw-composer-menu-export-main-textarea"></textarea></p>
						<p><span class="jw-composer-menu-subtitle">Bottom Area</span></p><p><textarea id="jw-composer-menu-export-bottom-textarea"></textarea></p>
						
					</div>
					
					<div id="jw-composer-menu-import" class="jw-composer-menu-left-contents">
						
						<span class="jw-composer-menu-title">Import Template</span>
						<p>Bellow you can see 3 textareas with text in them. That text represents the code for the content composer. You can use that code to import the same content composer content to another page on this website or a different website where you use our themes.</p>
						
						<p>&nbsp;</p>
						
						<p><span class="jw-composer-menu-subtitle">Top Area</span></p><p><textarea id="jw-composer-menu-import-top-textarea"></textarea></p>
						<p><span class="jw-composer-menu-subtitle">Main Area</span></p><p><textarea id="jw-composer-menu-import-main-textarea"></textarea></p>
						<p><span class="jw-composer-menu-subtitle">Bottom Area</span></p><p><textarea id="jw-composer-menu-import-bottom-textarea"></textarea></p>
						
						<p><button class="button-secondary" id="jw-composer-menu-import-action-submit">Import</button></p>
						
					</div>
					
				</div>
			
			</div>
			
		</div><!-- #jw-composer -->
		
		<input type="hidden" name="jw_composer_status" id="jw_composer_status" value="'.$composer_status.'" />
		
		<textarea name="jw_composer_main_backend" id="jw_composer_main_backend" style="display:none;"></textarea>
		<textarea name="jw_composer_main_frontend" id="jw_composer_main_frontend" style="display:none;"></textarea>
		
		<textarea name="jw_composer_top_backend" id="jw_composer_top_backend" style="display:none;"></textarea>
		<textarea name="jw_composer_top_frontend" id="jw_composer_top_frontend" style="display:none;"></textarea>
		
		<textarea name="jw_composer_bottom_backend" id="jw_composer_bottom_backend" style="display:none;"></textarea>
		<textarea name="jw_composer_bottom_frontend" id="jw_composer_bottom_frontend" style="display:none;"></textarea>
		
		';
	
	}
	
	echo $output;
	
}

