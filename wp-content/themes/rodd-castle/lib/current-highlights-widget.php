<?php
/**
 *
 * @package Rodd-Castle\Widgets
 * @author  Rodd Castle
 * @license GPL-2.0+
 * @link    http://roddcastle.com
 */

/**
 * Rodd Castle Current Highlights widget class.
 *
 * @since 0.0.1
 *
 * @package Rodd-Castle\Widgets
 */
class RC_Current_Highlights_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
			'current_highlights_widget', // Base ID
			__( 'Current Highlights', 'text_domain' ), // Name
			array( 'description' => __( 'A widget for displaying my current highlights', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$widget_id = $args['widget_id'];

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		if ( get_field('bio', 'widget_' . $widget_id) ) {
			the_field('bio', 'widget_' . $widget_id);
		}

		if(get_field('highlight', 'widget_' . $widget_id)) {
			while(the_repeater_field('highlight', 'widget_' . $widget_id)) {
				$icon = get_sub_field('icon', 'widget_' . $widget_id);
				$icon_hover = get_sub_field('icon_hover', 'widget_' . $widget_id);
				//print_r($icon);
				echo '<div class="one-third">';
				echo '<div class="icons">';
				echo '<img class="icon" src="'.$icon['url'].'" alt="'.$icon['title'].'">';
				echo '<img class="icon_hover" src="'.$icon_hover['url'].'" alt="'.$icon_hover['title'].'">';
				echo "</div>";
				the_sub_field('content', 'widget_' . $widget_id);
				echo '</div>';
			}
		}

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}
}