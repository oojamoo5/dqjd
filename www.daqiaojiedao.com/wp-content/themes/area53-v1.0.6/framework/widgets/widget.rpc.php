<?php
/**
 * Plugin Name: WPS - Recent/Popular/Comments Tabs
 * Description: Custom widget. Show recent posts, popular posts and comments in tabs.
 * Version: 1.0
 */
 
 /* Actions */
add_action( 'widgets_init', 'jw_rpc_widget_load' );

/* Register widget */
function jw_rpc_widget_load() {
	register_widget( 'Rpc_Widget' );
}

/* The class */
class Rpc_Widget extends WP_Widget {
	

	/* ---------------------------------------------------------------------------------------------------
		Widget settings
	--------------------------------------------------------------------------------------------------- */
	function Rpc_Widget() {
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'jw-rpc-widget', 'description' => __('A tabbed listing of your recent posts, popular post and comments.', 'jwlocalize') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'jw-rpc-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'jw-rpc-widget', __('RPC Widget', 'jwlocalize'), $widget_ops, $control_ops );
		
	}
	

	/* ---------------------------------------------------------------------------------------------------
		Front-end output
	--------------------------------------------------------------------------------------------------- */
	function widget( $args, $instance ) {
		
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$amount = $instance['amount'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		echo do_shortcode('[rpc amount="'.$amount.'" /]');

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

		return $instance;
		
	}
	

	/* ---------------------------------------------------------------------------------------------------
		Back-end output
	--------------------------------------------------------------------------------------------------- */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Posts and Comments', 'jwlocalize'), 'amount' => '5' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

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

	<?php
	
	}
}

?>