<?php
/**
 * This file adds the Single Page to the Parallax Pro Theme.
 *
 * @author StudioPress
 * @package Parallax
 * @subpackage Customizations
 */

function acf_project_content() {

   the_field('project_info');
   echo '<p>'.get_field('project_date').'</p>';
   echo '<p>'.get_field('tools_used').'</p>';

   if( have_rows('project_images') ) {
   		// loop through the rows of data
      // echo '<div id="project_slider" class="flexslider">';
      // echo '<ul class="slides">';
      while ( have_rows('project_images') ) : the_row();
        // display a sub field value
         $image_array = get_sub_field('image');
         echo '<img src="'.$image_array['sizes']['project-image'].'" alt="'.$image_array['title'].'">';
      endwhile;
      // echo '</ul>';
      // echo '</div>';
	}

}
add_action( 'genesis_entry_content', 'acf_project_content' );

//Remove date added and posted by
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the entry meta in the entry footer (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

genesis();
