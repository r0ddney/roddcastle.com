<?php
/**
 *
 * @package Rodd-Castle\Widgets
 * @author  Rodd Castle
 * @license GPL-2.0+
 * @link    http://roddcastle.com
 */

/**
 * Rodd Castle Footer widget class.
 *
 * @since 0.0.1
 *
 * @package Rodd-Castle\Widgets
 */
class RC_Footer_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
			'footer_widget', // Base ID
			__( 'Footer', 'text_domain' ), // Name
			array( 'description' => __( 'A widget for displaying the footer info', 'text_domain' ), ) // Args
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
		if ( get_field('logo', 'widget_' . $widget_id) ) {
			$logo = get_field('logo', 'widget_' . $widget_id);
			//print_r($profile_image);
			echo '<div id="footer_logo">';
			echo '<img src="'.$logo['url'].'" alt="'.$logo['title'].'">';
			echo '</div>';
		}
		if ( get_field('info_text', 'widget_' . $widget_id) ) {
			echo '<div class="one-half center-column">';
			the_field('info_text', 'widget_' . $widget_id);
			echo '</div>';
		}
		if(get_field('contact_info', 'widget_' . $widget_id)) {
			while(the_repeater_field('contact_info', 'widget_' . $widget_id)) {
				$icon = get_sub_field('icon', 'widget_' . $widget_id);
				echo '<div class="one-third contact">';
				echo '<img src="'.$icon['url'].'" alt="'.$icon['title'].'">';
				echo '<hr>';
				echo '<p>'.get_sub_field('contact_text', 'widget_' . $widget_id).'</p>';
				echo '<hr>';
				echo '</div>';
			}
		}
		echo '<p id="copyright">Copyright &copy; '.date("Y").', Rodd Castle.</p>';
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		return $instance;
	}
}