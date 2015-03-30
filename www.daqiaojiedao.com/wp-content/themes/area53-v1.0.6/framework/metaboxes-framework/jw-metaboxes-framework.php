<?php
/* ---------------------------------------------------------------------------------------------------
	
	JW Meta Boxes Framework
	
--------------------------------------------------------------------------------------------------- */

/* ---------------------------------------------------------------------------------------------------
	Javascript
--------------------------------------------------------------------------------------------------- */
add_action('admin_print_scripts', 'jw_metabox_include_js');
function jw_metabox_include_js(){
	
	/* Register scripts */
	wp_register_script('jw_custom', get_template_directory_uri().'/framework/_lib/js/jw-custom.js', false);
	wp_register_script('jw_metabox_framework', get_template_directory_uri().'/framework/metaboxes-framework/js/jw-metabox-framework.js', false);
	
	/* Enqueue scripts */
	wp_enqueue_script('jw_custom');
	wp_enqueue_script('jw_metabox_framework');
	
}/* jw_metabox_include_js() */


/* ---------------------------------------------------------------------------------------------------
	CSS
--------------------------------------------------------------------------------------------------- */
add_action('admin_print_styles', 'jw_metabox_include_css');
function jw_metabox_include_css(){

	/* Register styles */
	wp_register_style('jw_style', get_template_directory_uri().'/framework/_lib/css/jw-style.css', false);
	wp_register_style('jw_metabox_style', get_template_directory_uri().'/framework/metaboxes-framework/css/jw-metabox-style.css', false);
	
	/* Enqueue styles */
	wp_enqueue_style('jw_style');
	wp_enqueue_style('jw_metabox_style');

}/* jw_metabox_include_css() */

/* Actions */
add_action('admin_init', 'jw_metabox_init', 1);
add_action('save_post', 'jw_metabox_save');

function jw_metabox_init(){

	/* Add metaboxes */
	add_meta_box('jw_metabox_options', 'Page Options', 'jw_metabox_output', 'page', 'normal', 'high', null);
	add_meta_box('jw_metabox_options', 'Post Options', 'jw_metabox_output', 'post', 'normal', 'high', null);
	add_meta_box('jw_metabox_options', 'Portfolio Options', 'jw_metabox_output', 'jw_portfolio', 'normal', 'high', null);
	add_meta_box('jw_metabox_options', 'Testimonial Options', 'jw_metabox_output', 'jw_testimonials', 'normal', 'high', null);
	add_meta_box('jw_metabox_options', 'Staff Member Options', 'jw_metabox_output', 'jw_staff', 'normal', 'high', null);

}

function jw_metabox_output($post){
	
	$post_id = $post->ID;
	
	/* Include options */
	include get_template_directory().'/functions/metabox-options.php';
	
	/* Include the fields helper. Returns $jw_content and $jw_sidebar. */
	$fields_for = 'metaboxes_framework';
	include get_template_directory().'/framework/_lib/helper.fields.php';
	
	?>
	
	<div class="jw-custom" id="jw-metabox-options">
			
		<div class="jw-sidebar">
			
			<ul>
				<?php echo $jw_sidebar; ?>
			</ul>
			
		</div><!-- .jw-sidebar -->
		
		<div class="jw-content">
			
			<?php echo $jw_content; ?>

		</div><!-- .jw-content -->
		
	</div><!-- -->
		
	<?php
	
}

function jw_metabox_save($post_id){
	
	/* If the save is triggered by the autosave WordPress feature don't continue executing the script */
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){ return $post_id; }
	
	/* Include options */
	include get_template_directory().'/functions/metabox-options.php';
	
	/* Go through the options */
	foreach($options as $option){
		
		/* If not open or close */
		if($option['type'] != 'open' && $option['type'] != 'close'){
		
			/* If a values is set */
			if(isset($_POST[$option['id']])){
				
				$value = $_POST[$option['id']];
				
				/* Add if it's new */
				if (get_post_meta($post_id, $option['id']) == '') { add_post_meta($post_id, $option['id'], $value, true); }

				/* Update if already has a value */
				elseif ($value != get_post_meta($post_id, $option['id'], true)) { update_post_meta($post_id, $option['id'], $value); }

				/* Delete if empty */
				elseif ($value == '') { delete_post_meta($post_id, $option['id'], get_post_meta($post_id, $option['id'], true)); }
				
			}else{
				
				delete_post_meta($post_id, $option['id'], get_post_meta($post_id, $option['id'], true));
				
			}
		}
		
	}
	
}