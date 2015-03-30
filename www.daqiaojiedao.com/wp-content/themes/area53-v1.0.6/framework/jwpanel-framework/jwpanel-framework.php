<?php
/* ---------------------------------------------------------------------------------------------------
	
	JWPanel Framework
	
--------------------------------------------------------------------------------------------------- */

/* ---------------------------------------------------------------------------------------------------
	Redirect to JWPANEL on theme activation
--------------------------------------------------------------------------------------------------- */
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	header( 'Location: '.admin_url().'admin.php?page=jwpanel-framework.php&jw_first_start=true');
}

/* ---------------------------------------------------------------------------------------------------
	Javascript
--------------------------------------------------------------------------------------------------- */
add_action('admin_enqueue_scripts', 'jwpanel_include_js');
function jwpanel_include_js( $hook ){

	/* Register scripts */
	wp_register_script('jw_admin_colorpicker', get_template_directory_uri().'/framework/_scripts/colorpicker/colorpicker.js', false);
	wp_register_script('jw_custom', get_template_directory_uri().'/framework/_lib/js/jw-custom.js', false);
	wp_register_script('jwpanel_custom', get_template_directory_uri().'/framework/jwpanel-framework/js/jwpanel-custom.js', false);
	
	/* Enqueue scripts */
	wp_enqueue_script('jw_admin_colorpicker');
	wp_enqueue_script('jw_custom');
	
	if ( 'toplevel_page_jwpanel-framework' == $hook ) {
		wp_enqueue_media();
		wp_enqueue_script('jwpanel_custom');
	}
	
}/* jwpanel_include_js() */


/* ---------------------------------------------------------------------------------------------------
	CSS
--------------------------------------------------------------------------------------------------- */
add_action('admin_print_styles', 'jwpanel_include_css');
function jwpanel_include_css(){

	/* Register styles */
	wp_register_style('jw_admin_colorpicker_css', get_template_directory_uri().'/framework/_scripts/colorpicker/colorpicker.css', false);
	wp_register_style('jw_style', get_template_directory_uri().'/framework/_lib/css/jw-style.css', false);
	wp_register_style('jwpanel_style', get_template_directory_uri().'/framework/jwpanel-framework/css/jwpanel-style.css', false);
	
	/* Enqueue styles */
	wp_enqueue_style('jw_admin_colorpicker_css');
	wp_enqueue_style('jw_style');
	wp_enqueue_style('jwpanel_style');
	

}/* jwpanel_include_css() */



function jwpanel_init(){
	
	include get_template_directory().'/functions/jwpanel-options.php';
	 
	/* Save & Reset */
	if (isset($_GET['page']) && $_GET['page'] == basename(__FILE__)) {
		
		/* Save */
		if (isset($_REQUEST['action']) && 'save' == $_REQUEST['action']){
			
			/* Loop the options, cross reference the current and the submitted values, and save if they're different */
			foreach ($options as $option){
				
				if($option['type'] != 'open' && $option['type'] != 'close'){
				
					if(!is_array($_REQUEST[$option['id']])){ $the_value = htmlspecialchars_decode(stripslashes($_REQUEST[$option['id']])); }else{ $the_value = serialize($_REQUEST[$option['id']]); }
					
					if(isset($_REQUEST[$option['id']])){ update_option($option['id'], $the_value); }else{ delete_option($option['id']); } 
					
				}
				
			}
			
			/* Redirect to the theme options page */
			header('Location: admin.php?page=jwpanel-framework.php&saved=true');
			
			/* Chuck Norris */
			die;
		 
		/* Reset */
		}else if(isset($_REQUEST['action']) && 'reset' == $_REQUEST['action']) {
			
			/* Loop the options and delete them (setting the default values will happen on next page load) */
			foreach ($options as $option) {
				delete_option($option['id']); 
			}
			
			/* Redirect to the theme options page */
			header("Location: admin.php?page=jwpanel-framework.php&reset=true");
			
			/* Steven Seagal */
			die;
		 
		}
	}
	
	/* Add the page */
	add_menu_page($themename." Options", "Theme Options", 'edit_themes', basename(__FILE__), 'jwpanel_output', false, 30);
	
}


function jwpanel_output(){
	
	if(isset($_GET['jw_first_start']) && $_GET['jw_first_start'] == true){
		
		?>		
		
		<p>&nbsp;</p>
		
		<h2><strong>Successfully Activated</strong></h2>
		
		<p>&nbsp;</p>
		
		<p>Thank you for purchasing our theme which you just succesfuly activated.</p>
		
		<p>Even thou everything should be quite clear(here and throughout the rest of the theme), due to the amount of unique features our themes have it is quite important that you take a <strong>look at the documentation</strong> (located in the download you got from ThemeForest). But that's up to you, if you want you can learn as you go.</p>
		
		<p>This message will self-destruct in 5 seconds, 5...4...3...2...1... just kidding, you can follow the links bellow or use the sidebar menu.</p>
		
		<p>&nbsp;</p>
		
		<p><em><a href="<?php echo admin_url().'admin.php?page=jwpanel-framework.php'; ?>" class="button-primary">Theme Options Page</a> &nbsp;&nbsp; <a href="http://themeforest.net/user/WPScientist/portfolio" class="button-secondary" target="_blank">Our ThemeForest Portfolio</a> &nbsp;&nbsp; <a href="http://themeforest.net/user/WPScientist" class="button-secondary" target="_blank">Our ThemeForest Profile</a><em></p>
		
		<?php
		
	}else{
	
		include get_template_directory().'/functions/jwpanel-options.php';
		
		$fields_for = 'jwpanel_framework';
		include get_template_directory().'/framework/_lib/helper.fields.php';
		
		?>
		
		<form method="post" enctype="multipart/form-data">
			
			<div class="jw-custom col-clear" id="jwpanel">
				
				<div class="jw-sidebar">
					
					<ul>
						<?php echo $jw_sidebar; ?>
					</ul>
					
				</div><!-- .jw-sidebar -->
				
				<div class="jw-content col-clear">
					
					<?php echo $jw_content; ?>
						
					<input type="hidden" name="action" value="save" />
					<input type="submit" class="button-primary" value="Save Changes" style="float:right;" />
						
				</div><!-- .jw-content -->
				
			</div><!-- #jwpanel -->
			
			
			
		</form>
		<br />
		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="reset" />
			If you want you can <input type="submit" class="button-secondary" value="reset" /> all the options back to default values.
		</form>
	
	<?php } ?>
	
	<?php
	
}

add_action('admin_menu', 'jwpanel_init');