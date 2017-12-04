<?php
/**
 *	General functions for Memberlite Elements.
 */

/*
	Add a Banner Image as a secondary thumbnail
*/
function memberlite_elements_banner_image_setup()
{
	//$memberlite_post_types = get_post_types( array('public' => true), 'names' );
	if (class_exists('MultiPostThumbnails')) {
	    $screens = get_post_types( array('public' => true), 'names' );
		foreach ($screens as $screen) 
		{
			if(in_array($screen, array('reply','topic')))
				continue;
			else
			{
				new MultiPostThumbnails(
					array(
						'label' => __( 'Banner Image', 'memberlite-elements' ),
						'id' => 'memberlite_banner_image' . $screen,
						'post_type' => $screen,
					)
				);
			}
		}
	}
}
add_action('wp_loaded', 'memberlite_elements_banner_image_setup');

/*
	Update the mce_buttons in Editor
*/
function memberlite_elements_mce_buttons( $buttons, $id ){
 
    /* only add this for content editor */
    if ( 'content' != $id )
        return $buttons;
 
    /* add next page after more tag button */
    array_splice( $buttons, 13, 0, 'wp_page' );
 
    return $buttons;
}
add_filter( 'mce_buttons', 'memberlite_elements_mce_buttons', 1, 2 );
