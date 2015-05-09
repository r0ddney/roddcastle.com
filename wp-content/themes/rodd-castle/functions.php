<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'agency', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'parallax' ) );

//* Add Image upload to WordPress Theme Customizer
add_action( 'customize_register', 'parallax_customizer' );
function parallax_customizer(){

	require_once( get_stylesheet_directory() . '/lib/customize.php' );
	
}

//* Include Section Image CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Parallax Pro Theme' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/parallax/' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'parallax_enqueue_scripts_styles' );
function parallax_enqueue_scripts_styles() {

	wp_enqueue_script( 'parallax-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'parallax-google-fonts', '//fonts.googleapis.com/css?family=Montserrat|Sorts+Mill+Goudy:400,400italic|Open+Sans:300,400', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 1 );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_nav' );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'parallax_secondary_menu_args' );
function parallax_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Add support for additional color styles
add_theme_support( 'genesis-style-selector', array(
	'parallax-pro-blue'   => __( 'Parallax Pro Blue', 'parallax' ),
	'parallax-pro-green'  => __( 'Parallax Pro Green', 'parallax' ),
	'parallax-pro-orange' => __( 'Parallax Pro Orange', 'parallax' ),
	'parallax-pro-pink'   => __( 'Parallax Pro Pink', 'parallax' ),
	'parallax-pro-yellow'   => __( 'Parallax Pro Yellow', 'parallax' ),
) );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 360,
	'height'          => 70,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'footer-widgets',
	'footer',
) );

//* Remove the site footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

//* Customize the site footer
add_action( 'genesis_footer', 'rc_custom_footer' );
function rc_custom_footer() { ?>
 
	<!-- <div class="site-footer">
		<div class="wrap">
			<img src="<?php //echo get_stylesheet_directory_uri() . '/images/color_logo.svg'; ?>" alt="logo">
			<p>Coopers Beach, New Zealand</p>
			<p>***</p>
			<p>&copy;<?php //echo date("Y"); ?> RODD CASTLE</p>
		</div>
	</div> -->
 
<?php
	genesis_widget_area( 'footer-2', array(
		'before' => '<div class="site-footer"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

//$pre = apply_filters( "genesis_markup_{$args['context']}", false, $args );
//add_filter('genesis_markup_footer-widgets_output', 'add_footer_id_filter',10,2);
// function add_footer_id_filter($tag, $args) {
// 	echo '<pre>';
// 	print_r($tag);
// 	echo '</pre>';
// 	echo '<pre>';
// 	print_r($args);
// 	echo '</pre>';
// }
// add_filter('genesis_markup_footer-widgets', 'add_footer_id_filter',10,1);

// function add_footer_id_filter($args) {
// 	// echo '<pre>';
// 	// print_r($args);
// 	// echo '</pre>';
// 	$args = '<div id="xxx">';
// 	return $args;
// }

//* Include Featured Post Widget
include_once( CHILD_DIR . '/lib/featured-project-widget.php' );
function rc_replace_featured_post_widget() {
  // unregister the Genesis widget..
  unregister_widget( 'Genesis_Featured_Post' );
  
  // register our custom widget..
  register_widget( 'RC_Featured_Project' );
}
add_action( 'widgets_init', 'rc_replace_featured_post_widget' );


//* Add Featured Project image size
add_image_size( 'featured-project', 768, 768, true );
add_image_size( 'project-image', 1024, 768, false );


// register RC_About_Me_Widget widget
include_once( CHILD_DIR . '/lib/about-me-widget.php' );
function register_rc_about_me_widget() {
    register_widget( 'RC_About_Me_Widget' );
}
add_action( 'widgets_init', 'register_rc_about_me_widget' );


// register RC_Current_Highlights_Widget widget
include_once( CHILD_DIR . '/lib/current-highlights-widget.php' );
function register_rc_current_highlights_widget() {
    register_widget( 'RC_Current_Highlights_Widget' );
}
add_action( 'widgets_init', 'register_rc_current_highlights_widget' );


// register RC_Slider_Widget widget
include_once( CHILD_DIR . '/lib/slider-widget.php' );
function register_rc_slider_widget() {
    register_widget( 'RC_Slider_Widget' );
}
add_action( 'widgets_init', 'register_rc_slider_widget' );


include_once( CHILD_DIR . '/lib/footer-widget.php' );
function register_rc_footer_widget() {
    register_widget( 'RC_Footer_Widget' );
}
add_action( 'widgets_init', 'register_rc_footer_widget' );


// Add contact area scrim to instagram widget
// function instagram_widget_add_scrim() {
//     echo "string";
// }
// add_action( 'wpiw_before_widget', 'instagram_widget_add_scrim' );
//do_action( 'wpiw_before_widget', $instance );


//* Hook after post widget after the entry content
add_action( 'genesis_after_entry', 'parallax_after_entry', 5 );
function parallax_after_entry() {

	if ( is_singular( 'post' ) )
		genesis_widget_area( 'after-entry', array(
			'before' => '<div class="after-entry widget-area">',
			'after'  => '</div>',
		) );

}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'parallax_author_box_gravatar' );
function parallax_author_box_gravatar( $size ) {

	return 176;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'parallax_comments_gravatar' );
function parallax_comments_gravatar( $args ) {

	$args['avatar_size'] = 120;

	return $args;

}

/**
 *
 * Modify the size of the Gravatar in the User Profile Widget
 *
 * @author Calvin Koepke
 * @since 1.0.0
*/
add_filter( 'genesis_gravatar_sizes', 'rc_user_profile' );
function rc_user_profile( $sizes ) {
	$sizes['Extra Large'] = 250;
	return $sizes;
}

/**
 *
 * Remove post widget categories link
 *
*/
// add_filter( 'genesis_post_categories_shortcode', 'rc_remove_post_categories_link' );
// function rc_remove_post_categories_link( $atts ) {
// 	echo "<pre>";
// 	print_r($atts);
// 	print(arg)
// 	echo "</pre>";
// 	//return $output;
// }
//return apply_filters( 'genesis_post_categories_shortcode', $output, $atts );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-section-1',
	'name'        => __( 'Home Section 1', 'parallax' ),
	'description' => __( 'This is the home section 1 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-2',
	'name'        => __( 'Home Section 2', 'parallax' ),
	'description' => __( 'This is the home section 2 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-3',
	'name'        => __( 'Home Section 3', 'parallax' ),
	'description' => __( 'This is the home section 3 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-4',
	'name'        => __( 'Home Section 4', 'parallax' ),
	'description' => __( 'This is the home section 4 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-5',
	'name'        => __( 'Home Section 5', 'parallax' ),
	'description' => __( 'This is the home section 5 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'after-entry',
	'name'        => __( 'After Entry', 'parallax' ),
	'description' => __( 'This is the after entry widget area.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'footer-2',
	'name'        => __( 'Footer 2', 'parallax' ),
	'description' => __( 'This is the end of the page.', 'parallax' ),
) );

/**
	 * Register theme css and js
	 *
	 * @link http://teamtreehouse.com/library/wordpress-theme-development
	 */
function rc_theme_styles() {

	wp_enqueue_style( 'flexslider_css', 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.3.0/flexslider.css' );
	wp_enqueue_style( 'flexslider_font_eot', 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.3.0/fonts/flexslider-icon.eot' );
	wp_enqueue_style( 'flexslider_font_svg', 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.3.0/fonts/flexslider-icon.svg' );
	wp_enqueue_style( 'flexslider_font_ttf', 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.3.0/fonts/flexslider-icon.ttf' );
	wp_enqueue_style( 'flexslider_font_woff', 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.3.0/fonts/flexslider-icon.woff' );
	wp_enqueue_style( 'flexslider_images', 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.3.0/images/bg_play_pause.png' );
	wp_enqueue_style( 'modal_css', get_stylesheet_directory_uri() . '/js/jquery-modal-master/jquery.modal.css' );

}
add_action( 'wp_enqueue_scripts', 'rc_theme_styles' );

function rc_theme_js() {

	wp_enqueue_script( 'flexslider_js', 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.3.0/jquery.flexslider.js', array('jquery'), '', true );
	wp_enqueue_script( 'modal_js', get_stylesheet_directory_uri() . '/js/jquery-modal-master/jquery.modal.min.js', array('jquery'), '', true );	
	wp_enqueue_script( 'rc_js', get_stylesheet_directory_uri() . '/js/rc-scripts.js', array('jquery', 'jquery-color'), '', true );	

	wp_register_script( "rc_personal_project_js", get_stylesheet_directory_uri().'/js/rc-personal-project.js', array('jquery') );
	wp_localize_script( 'rc_personal_project_js', 'rcAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        
	wp_enqueue_script( 'rc_personal_project_js' );
	
	wp_enqueue_script( 'jquery_timing', 'http://creativecouple.github.com/jquery-timing/jquery-timing.min.js', array('jquery'), '', true );


}
add_action( 'wp_enqueue_scripts', 'rc_theme_js' );

//Personal Projects Ajax Function
add_action("wp_ajax_rc_personal_project", "rc_personal_project");
add_action("wp_ajax_nopriv_rc_personal_project", "rc_personal_project");

function rc_personal_project() {

   $post_id = $_REQUEST["post_id"];

   $query = new WP_Query( 'p='.$post_id );
   $the_title;
   $images = [];
   if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
   	$the_title = get_the_title();

   	if( have_rows('project_images') ) {
   		// loop through the rows of data
	    while ( have_rows('project_images') ) : the_row();
	        // display a sub field value
	    	array_push($images, get_sub_field('image'));
	    endwhile;
   	}

   	$project_info = get_field('project_info');
   	$project_date = get_field('project_date');
   	$project_tools = get_field('tools_used');

   endwhile; 
   wp_reset_postdata();
   else :
   	//_e( 'Sorry, no posts matched your criteria.' )
   	endif;

   if($the_title === false) {
      $result['type'] = "error";
   }
   else {
      $result['type'] = "success";
      $result['the_title'] = $the_title;
      $result['project_images'] = $images;
      $result['project_info'] = $project_info;
      $result['project_date'] = $project_date;
      $result['project_tools'] = $project_tools;
   }

   if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $result = json_encode($result);
      echo $result;
   }
   else {
      header("Location: ".$_SERVER["HTTP_REFERER"]);
   }

   die();

}