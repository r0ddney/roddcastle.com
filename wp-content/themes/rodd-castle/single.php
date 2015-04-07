<?php
/**
 * This file adds the Single Page to the Parallax Pro Theme.
 *
 * @author StudioPress
 * @package Parallax
 * @subpackage Customizations
 */

function acf_do() {
   if( have_rows('project_images') ) {
   		// loop through the rows of data
	    while ( have_rows('project_images') ) : the_row();
	        // display a sub field value
	    	the_sub_field('image');
	    endwhile;
   	}

   	the_field('project_info');
   	the_field('project_date');
   	the_field('tools_used');
}
add_action( 'genesis_entry_content', 'acf_do' );

genesis();
