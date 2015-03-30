<?php
/* ---------------------------------------------------------------------------------------------------

Define Sidebars

--------------------------------------------------------------------------------------------------- */

/* Actions and filters */
add_action('widgets_init', 'jw_register_sidebars');
add_action('widgets_init', 'jw_unregister_widgets');
add_action('widgets_init', 'jw_register_widgets');

/* -----------------------------------------------------------------
	
	Name: jw_register_sidebars
	
----------------------------------------------------------------- */
function jw_register_sidebars(){
	
	global $domain; /* The unique string used for translation */
	
	/* Page sidebar (left and right) */
	register_sidebar(
		array(
			'id' => 'sidebar_page',
			'name' => 'Page Widgets',
			'description' => 'Widgets inserted here will show up in the sidebar sections for pages.',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>'
		)
	);
	
	/* Blog sidebar (both listing and detailed view) */
	register_sidebar(
		array(
			'id' => 'sidebar_blog',
			'name' => 'Blog Widgets',
			'description' => 'Widgets inserted here will show up in the sidebar sections for the blog.',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>'
		)
	);
	
	/* Portfolio sidebar (both listing and detailed view) */
	register_sidebar(
		array(
			'id' => 'sidebar_portfolio',
			'name' => 'Portfolio Widgets',
			'description' => 'Widgets inserted here will show up in the sidebar sections for the portfolio.',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>'
		)
	);
	
	/* Footer */
	register_sidebar(
		array(
			'id' => 'sidebar_footer',
			'name' => 'Footer Widgets',
			'description' => 'Widgets inserted here will show up in the footer.',
			'before_widget' => '<div class="one-third"><div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>'
		)
	);
	
	/* User made sidebars */
	$w_count = 0;
	
	global $wpdb;
	
	$widgetized_pages = $wpdb->get_col( "SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = 'jw_sidebar'" );
	
	if($widgetized_pages){
		
		foreach($widgetized_pages as $w_page){
			
			$widget_id = strtolower(str_replace(' ', '_', $w_page));
		
			register_sidebar(array(
				'name' => $w_page,
				'id'   => 'jw_widgetsection_'.$widget_id,
				'description'   => '',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="widget-title"><span>',
				'after_title' => '</span></h3>'
			));
			
		}/* For each user created widget END */
		
	}/* If there are user created widgets END */
	
	
} /* jw_register_sidebars() END */	

/* -----------------------------------------------------------------
	
	Name: jw_unregister_widgets
	
	Unregister default WordPress widgets
	
----------------------------------------------------------------- */
function jw_unregister_widgets(){

		

}

/* -----------------------------------------------------------------
	
	Name: jw_register_widgets
	
	Register custom WordPress widgets
	
----------------------------------------------------------------- */
function jw_register_widgets(){

		

}
