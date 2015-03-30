<?php

/* ------------------------------------------------------------------------------------------------------------

	Functions - Menus
	
	Description: Register menus, add filters, actions...
	
------------------------------------------------------------------------------------------------------------ */

	
	/* Actions and filters */
	add_action('init', 'jw_register_menus');
	add_filter('nav_menu_css_class', 'jw_nav_menu_active_class', 10, 2);
	add_filter('wp_list_pages', 'jw_list_pages_active_class', 10, 2);	
	
	
	/* -----------------------------------------------------------------
		
		Name: jw_register_menus
		
	----------------------------------------------------------------- */
	function jw_register_menus(){
	
		register_nav_menus(
			array(
			  'main_navigation' => 'Main Navigation'
			)
		);
	
	} /* jw_register_menus() END */
	
	include get_template_directory().'/functions/menus.php';
	
	
	/* -----------------------------------------------------------------
		
		Name: jw_nav_menu_active_class
		
		Additional classes for the currently active page when using the 
		"nav menu".
		
	----------------------------------------------------------------- */
	function jw_nav_menu_active_class($classes = array(), $menu_item = false){
		
		if(in_array('current-menu-item', $menu_item->classes)){
			$classes[] = 'active';
		}
		
		if(in_array('current-menu-parent', $menu_item->classes)){
			$classes[] = 'active';
		}
		
		return $classes;
	}
		
		
	/* -----------------------------------------------------------------
		
		Name: jw_list_pages_active_class
		
		Additional classes for the currently active page when using the 
		"wp_list_pages()".
		
	----------------------------------------------------------------- */
	function jw_list_pages_active_class($menu){
		
		$menu = str_replace('current_page_item', 'active', $menu);
		
		return $menu;
		
	}

?>