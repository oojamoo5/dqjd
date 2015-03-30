<?php
/* ---------------------------------------------------------------------------------------------------

	Shortcodes

--------------------------------------------------------------------------------------------------- */

/* Actions and filters */
add_action('init', 'jw_register_post_types');

/* -----------------------------------------------------------------
		
	Name: jw_register_post_types
	
----------------------------------------------------------------- */
function jw_register_post_types(){
		
		register_taxonomy('jw_page_categories', 'page', array( 'label' => 'Categories', 'hierarchical' => true, 'public' => true));
		
		/* -----------------------------------------------------------------
			Portfolio
		----------------------------------------------------------------- */
		register_post_type( 'jw_portfolio',
			array(
				'labels' => array(
					'name' => __( 'Portfolio', 'jwlocalize' ),
					'singular_name' => __( 'Portfolio Post', 'jwlocalize' ),
					'add_new' => __( 'Add New', 'jwlocalize' ),
					'add_new_item' => __( 'Add New Portfolio Post', 'jwlocalize' ),
					'edit' => __( 'Edit', 'jwlocalize' ),
					'edit_item' => __( 'Edit Portfolio Post', 'jwlocalize' ),
					'new_item' => __( 'New Portfolio Post', 'jwlocalize' ),
					'view' => __( 'View Portfolio', 'jwlocalize' ),
					'view_item' => __( 'View Portfolio Post', 'jwlocalize' ),
					'search_items' => __( 'Search Portfolio Posts', 'jwlocalize' ),
					'not_found' => __( 'No portfolio posts found', 'jwlocalize' ),
					'not_found_in_trash' => __( 'No portfolio posts in Trash', 'jwlocalize' ),
					'parent' => __( 'Parent Portfolio', 'jwlocalize' ),
				),
				'public' => true,
				'menu_position' => 5,
				'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'comments' ),
				'rewrite' =>  array( 'slug' => 'portfolio-view', 'with_front' => false )
			)
		);
		register_taxonomy('jw_portfolio_categories', 'jw_portfolio', array( 'label' => 'Categories', 'hierarchical' => true, 'public' => true));
		register_taxonomy('jw_portfolio_tags', 'jw_portfolio', array( 'label' => 'Tags', 'hierarchical' => false, 'public' => true));
		
		
		/* -----------------------------------------------------------------
			Testimonials
		----------------------------------------------------------------- */
		register_post_type( 'jw_testimonials',
			array(
				'labels' => array(
					'name' => __( 'Testimonials', 'jwlocalize' ),
					'singular_name' => __( 'Testimonial', 'jwlocalize' ),
					'add_new' => __( 'Add New', 'jwlocalize' ),
					'add_new_item' => __( 'Add New Testimonial', 'jwlocalize' ),
					'edit' => __( 'Edit', 'jwlocalize' ),
					'edit_item' => __( 'Edit Testimonial', 'jwlocalize' ),
					'new_item' => __( 'New Testimonial Post', 'jwlocalize' ),
					'view' => __( 'View Testimonials', 'jwlocalize' ),
					'view_item' => __( 'View Testmonial', 'jwlocalize' ),
					'search_items' => __( 'Search Testimonials', 'jwlocalize' ),
					'not_found' => __( 'No testimonial found', 'jwlocalize' ),
					'not_found_in_trash' => __( 'No testimonial in Trash', 'jwlocalize' ),
					'parent' => __( 'Parent Testimonial', 'jwlocalize' ),
				),
				'public' => true,
				'menu_position' => 5,
				'supports' => array( 'title', 'custom-fields' ),
				'rewrite' =>  array( 'slug' => 'testimonial-view', 'with_front' => false ),
				'exclude_from_search' => true
			)
		);
		register_taxonomy('jw_testimonials_categories', 'jw_testimonials', array( 'label' => 'Categories', 'hierarchical' => true));
		register_taxonomy('jw_testimonials_tags', 'jw_testimonials', array( 'label' => 'Tags', 'hierarchical' => false));
		
		/* -----------------------------------------------------------------
			Staff
		----------------------------------------------------------------- */
		register_post_type( 'jw_staff',
			array(
				'labels' => array(
					'name' => __( 'Staff', 'jwlocalize' ),
					'singular_name' => __( 'Staff', 'jwlocalize' ),
					'add_new' => __( 'Add Staff Member', 'jwlocalize' ),
					'add_new_item' => __( 'Add Staff Member', 'jwlocalize' ),
					'edit' => __( 'Edit', 'jwlocalize' ),
					'edit_item' => __( 'Edit Staff Member', 'jwlocalize' ),
					'new_item' => __( 'New Staff Member', 'jwlocalize' ),
					'view' => __( 'View Staff', 'jwlocalize' ),
					'view_item' => __( 'View Staff Member', 'jwlocalize' ),
					'search_items' => __( 'Search Staff', 'jwlocalize' ),
					'not_found' => __( 'No Staff Members Found', 'jwlocalize' ),
					'not_found_in_trash' => __( 'No Staff Members Found in Trash', 'jwlocalize' ),
					'parent' => __( 'Parent Staff Member', 'jwlocalize' ),
				),
				'public' => true,
				'menu_position' => 5,
				'supports' => array( 'title', 'custom-fields', 'thumbnail' ),
				'rewrite' =>  array( 'slug' => 'staff-member', 'with_front' => false ),
				'exclude_from_search' => true
			)
		);
		register_taxonomy('jw_staff_categories', 'jw_staff', array( 'label' => 'Categories', 'hierarchical' => true));
		
} /* jw_register_post_types() END */