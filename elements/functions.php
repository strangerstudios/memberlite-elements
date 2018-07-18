<?php
/**
 *	General functions for Memberlite Elements.
 */

/*
	Enqueue Stylesheets and Javascript
*/
function memberlite_elements_init_styles() {
	//need jquery
	wp_enqueue_script( 'jquery' );

	wp_enqueue_style( 'font-awesome', MEMBERLITE_ELEMENTS_URL . "/font-awesome/css/font-awesome.min.css", array(), "4.7" );
	wp_enqueue_style( "memberlite_elements_frontend", MEMBERLITE_ELEMENTS_URL . "/css/memberlite-elements.css", array(), MEMBERLITE_ELEMENTS_VERSION );
}
add_action( "wp_enqueue_scripts", "memberlite_elements_init_styles" );

/*
	Enable the use of shortcodes in text widgets.
*/
add_filter( 'widget_text', 'do_shortcode' );

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
