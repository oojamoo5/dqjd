<?php

/* ---------------------------------------------------------------------------------------------------
	Javascript
--------------------------------------------------------------------------------------------------- */
add_action('admin_print_scripts', 'jw_admin_custom');
function jw_admin_custom(){
	
	/* Register scripts */
	wp_register_script('jw_admin_custom', get_template_directory_uri().'/functions/js/admin-custom.js', false);
	
	/* Enqueue scripts */
	wp_enqueue_script('jw_admin_custom');
	
}/* jw_admin_custom() */

?>