<?php
/**
 * Plugin Name: Flickr Feed 
 * Description: Custom widget. Show flickr feed.
 * Version: 1.0
 */
 
 /* Actions */
add_action( 'widgets_init', 'jw_flickr_widget_load' );

/* Register widget */
function jw_flickr_widget_load() {
	register_widget( 'Flickr_Widget' );
}

/* The class */
class Flickr_Widget extends WP_Widget {
	

	/* ---------------------------------------------------------------------------------------------------
		Widget settings
	--------------------------------------------------------------------------------------------------- */
	function Flickr_Widget() {
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'jw-flickr-widget', 'description' => __('This is the description for the widget', 'jwlocalize') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'jw-flickr-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'jw-flickr-widget', __('Flickr Widget', 'jwlocalize'), $widget_ops, $control_ops );
		
	}
	

	/* ---------------------------------------------------------------------------------------------------
		Front-end output
	--------------------------------------------------------------------------------------------------- */
	function widget( $args, $instance ) {
		
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$profile = $instance['profile'];
		$amount = $instance['amount'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		echo do_shortcode('[flickr_stream profile="'.$profile.'" amount="'.$amount.'" /]');

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
		$instance['profile'] = strip_tags( $new_instance['profile'] );
		$instance['amount'] = $new_instance['amount'];

		return $instance;
		
	}
	

	/* ---------------------------------------------------------------------------------------------------
		Back-end output
	--------------------------------------------------------------------------------------------------- */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Flickr Stream', 'jwlocalize'), 'profile' => '66472150@N04', 'amount' => '6' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'jwlocalize'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<!-- Profile -->
		<p>
			<label for="<?php echo $this->get_field_id( 'profile' ); ?>"><?php _e('Profile:', 'jwlocalize'); ?></label>
			<input id="<?php echo $this->get_field_id( 'profile' ); ?>" name="<?php echo $this->get_field_name( 'profile' ); ?>" value="<?php echo $instance['profile']; ?>" style="width:100%;" />
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

	<?php
	
	}
}

?>