<?php
/**
 * Plugin Name: WPS - Slider Posts
 * Description: Custom widget. Show posts in a jQuery powered slider.
 * Version: 1.0
 */
 
 /* Actions */
add_action( 'widgets_init', 'jw_slider_posts_widget_load' );

/* Register widget */
function jw_slider_posts_widget_load() {
	register_widget( 'JW_Slider_Posts_Widget' );
}

/* The class */
class JW_Slider_Posts_Widget extends WP_Widget {
	

	/* ---------------------------------------------------------------------------------------------------
		Widget settings
	--------------------------------------------------------------------------------------------------- */
	function JW_Slider_Posts_Widget() {
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'jw-slider-posts-widget', 'description' => __('Show posts in a jQuery powered slider.', 'jwlocalize') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'jw-slider-posts-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'jw-slider-posts-widget', __('Slider Posts Widget', 'jwlocalize'), $widget_ops, $control_ops );
		
	}
	

	/* ---------------------------------------------------------------------------------------------------
		Front-end output
	--------------------------------------------------------------------------------------------------- */
	function widget( $args, $instance ) {
		
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$amount = $instance['amount'];
		$post_type = $instance['post_type'];
		$slide_speed = $instance['slide_speed'];
		$order = $instance['order'];
		$cat = $instance['cat'];
		$show_thumb = $instance['show_thumb'];
		$show_title = $instance['show_title'];
		$show_excerpt = $instance['show_excerpt'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . '<a href="#" class="slider-posts-next"></a><a href="#" class="slider-posts-prev"></a>' . $after_title;

		echo do_shortcode('[slider_posts_widget amount="'.$amount.'" post_type="'.$post_type.'" slide_speed="'.$slide_speed.'" order="'.$order.'" cat="'.$cat.'" show_thumb="'.$show_thumb.'" show_title="'.$show_title.'" show_excerpt="'.$show_excerpt.'" /]');

		/* After widget (defined by themes). */
		echo $after_widget;
		
	}

	
	/* ---------------------------------------------------------------------------------------------------
		Process update from back-end
	--------------------------------------------------------------------------------------------------- */
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		/* Get new values */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['amount'] = $new_instance['amount'];
		$instance['post_type'] = $new_instance['post_type'];
		$instance['slide_speed'] = $new_instance['slide_speed'];
		$instance['order'] = $new_instance['order'];
		$instance['cat'] = $new_instance['cat'];
		$instance['show_thumb'] = $new_instance['show_thumb'];
		$instance['show_title'] = $new_instance['show_title'];
		$instance['show_excerpt'] = $new_instance['show_excerpt'];

		return $instance;
		
	}
	

	/* ---------------------------------------------------------------------------------------------------
		Back-end output
	--------------------------------------------------------------------------------------------------- */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Slider Posts', 'jwlocalize'), 'amount' => '5', 'post_type' => 'post', 'slide_speed' => '5000', 'order' => 'date', 'cat' => 'all', 'show_thumb' => 'yes', 'show_title' => 'yes', 'show_excerpt' => 'yes' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		/* Portfolio Categories */
		$portfolio_categories_array = array();
		$portfolio_categories_object = get_terms( 'jw_portfolio_categories', 'orderby=count&hide_empty=0' );

		if(!empty($portfolio_categories_object)){
			$portfolio_categories_array['Show All'] = 'all';
			foreach($portfolio_categories_object as $portfolio_category_object){
				$portfolio_category_object_title = $portfolio_category_object->name;
				$portfolio_category_object_value = $portfolio_category_object->term_id;
				$portfolio_categories_array[$portfolio_category_object_title] = $portfolio_category_object_value;
			}
		}
		
		/* Blog Categories */
		$blog_categories_array = array();
		$blog_categories_object = get_categories();

		$blog_categories_array['Show All'] = 'all';

		foreach($blog_categories_object as $blog_category_object){
			$blog_category_object_title = $blog_category_object->name;
			$blog_category_object_value = $blog_category_object->term_id;
			$blog_categories_array[$blog_category_object_title] = $blog_category_object_value;
		}
		
		?>
		
		<script>
			
			jQuery(document).ready(function(){
				
				jQuery('.jw-blog-cat, .jw-portfolio-cat').hide();
				
				jQuery('.jw-slider-posts-widget-post-type').each(function(){
				
					var container = jQuery(this).parents('.widget-inside');
					var post_type = jQuery(this).val();
					
					if(post_type == 'post'){
					
						container.find('.jw-portfolio-cat').hide();
						container.find('.jw-blog-cat').show();
						
					}else if(post_type == 'jw_portfolio'){
					
						container.find('.jw-blog-cat').hide();
						container.find('.jw-portfolio-cat').show();
					
					}
					
				});
				
				jQuery('.jw-slider-posts-widget-post-type').change(function(){
					
					var container = jQuery(this).parents('.widget-inside');
					var post_type = container.find('.jw-slider-posts-widget-post-type').val();
					
					if(post_type == 'post'){
					
						container.find('.jw-portfolio-cat').hide();
						container.find('.jw-blog-cat').show();
						
					}else if(post_type == 'jw_portfolio'){
					
						container.find('.jw-blog-cat').hide();
						container.find('.jw-portfolio-cat').show();
					
					}
					
				});
				
			});
			
		</script>
		
		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'jwlocalize'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<!-- Amount -->
		<p>
			<label for="<?php echo $this->get_field_id( 'amount' ); ?>"><?php _e('Amount:', 'jwlocalize'); ?></label> 
			<select id="<?php echo $this->get_field_id('amount'); ?>" name="<?php echo $this->get_field_name('amount'); ?>" class="widefat" style="width:100%;">
				<?php
				for ($i = 1; $i <= 15; $i++){
					?><option <?php if ($i == $instance['amount']) echo 'selected="selected"'; ?>><?php echo $i; ?></option><?php
				}
				?>
			</select>
		</p>
		
		<!-- Post Type -->
		<p>
			<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e('Post Type:', 'jwlocalize'); ?></label> 
			<select id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" class="widefat jw-slider-posts-widget-post-type" style="width:100%;">
				<option <?php if ('post' == $instance['post_type']) echo 'selected="selected"'; ?> value="post"><?php _e('Blog', 'jwlocalize'); ?></option>
				<option <?php if ('jw_portfolio' == $instance['post_type']) echo 'selected="selected"'; ?> value="jw_portfolio"><?php _e('Portfolio', 'jwlocalize'); ?></option>
			</select>
		</p>
		
		<!-- Category -->
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e('Category:', 'jwlocalize'); ?></label> 
			<select id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" class="widefat" style="width:100%;">
				<?php
				
				foreach($blog_categories_array as $key => $value){
					?>
					<option <?php if ($value == $instance['cat']) echo 'selected="selected"'; ?> class="jw-blog-cat" value="<?php echo $value; ?>"><?php echo $key; ?></option>
					<?php
				}
				
				foreach($portfolio_categories_array as $key => $value){
					?>
					<option <?php if ($value == $instance['cat']) echo 'selected="selected"'; ?> class="jw-portfolio-cat" value="<?php echo $value; ?>"><?php echo $key; ?></option>
					<?php
				}
				
				?>
			</select>
		</p>
		
		<!-- Automatic Slides -->
		<p>
			<label for="<?php echo $this->get_field_id( 'slide_speed' ); ?>"><?php _e('Automatic Slides (time in miliseconds):', 'jwlocalize'); ?></label>
			<input id="<?php echo $this->get_field_id( 'slide_speed' ); ?>" name="<?php echo $this->get_field_name( 'slide_speed' ); ?>" value="<?php echo $instance['slide_speed']; ?>" style="width:100%;" />
		</p>

		<!-- Order By -->
		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e('Order:', 'jwlocalize'); ?></label> 
			<select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>" class="widefat" style="width:100%;">
				<option <?php if ('date' == $instance['order']) echo 'selected="selected"'; ?> value="date"><?php _e('Normal', 'jwlocalize'); ?></option>
				<option <?php if ('rand' == $instance['order']) echo 'selected="selected"'; ?> value="rand"><?php _e('Random', 'jwlocalize'); ?></option>
			</select>
		</p>
		
		<!-- Thumbnail -->
		<p>
			<label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e('Show Thumbnail:', 'jwlocalize'); ?></label> 
			<select id="<?php echo $this->get_field_id('show_thumb'); ?>" name="<?php echo $this->get_field_name('show_thumb'); ?>" class="widefat" style="width:100%;">
				<option <?php if ('yes' == $instance['show_thumb']) echo 'selected="selected"'; ?> value="yes"><?php _e('Yes - Show the thumbnail', 'jwlocalize'); ?></option>
				<option <?php if ('no' == $instance['show_thumb']) echo 'selected="selected"'; ?> value="no"><?php _e('No - Do not show the thumbnail', 'jwlocalize'); ?></option>
			</select>
		</p>
		
		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'show_title' ); ?>"><?php _e('Show Title:', 'jwlocalize'); ?></label> 
			<select id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" class="widefat" style="width:100%;">
				<option <?php if ('yes' == $instance['show_title']) echo 'selected="selected"'; ?> value="yes"><?php _e('Yes - Show the title', 'jwlocalize'); ?></option>
				<option <?php if ('no' == $instance['show_title']) echo 'selected="selected"'; ?> value="no"><?php _e('No - Do not show the title', 'jwlocalize'); ?></option>
			</select>
		</p>
		
		<!-- Excerpt -->
		<p>
			<label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"><?php _e('Show Excerpt:', 'jwlocalize'); ?></label> 
			<select id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" class="widefat" style="width:100%;">
				<option <?php if ('yes' == $instance['show_excerpt']) echo 'selected="selected"'; ?> value="yes"><?php _e('Yes - Show the excerpt', 'jwlocalize'); ?></option>
				<option <?php if ('no' == $instance['show_excerpt']) echo 'selected="selected"'; ?> value="no"><?php _e('No - Do not show the excerpt', 'jwlocalize'); ?></option>
			</select>
		</p>
		
	<?php
	
	}
}

?>