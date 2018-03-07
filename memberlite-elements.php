<?php
/*
Plugin Name: Memberlite Elements
Plugin URI: http://www.memberlitetheme.com/plugins/memberlite-elements/
Description: A set of elements designed enhance the appearance of sites using the Memberlite Theme.
Version: 1.0
Author: kimannwall, strangerstudios
Author URI: http://www.memberlitetheme.com
*/

define( 'MEMBERLITE_ELEMENTS_DIR', dirname( __FILE__ ) );
define( 'MEMBERLITE_ELEMENTS_URL', plugins_url( '', __FILE__ ) );
define( 'MEMBERLITE_ELEMENTS_VERSION', '1.0' );

/*
	Load all Elements
*/
require_once( MEMBERLITE_ELEMENTS_DIR . "/elements/page_banners.php" );
require_once( MEMBERLITE_ELEMENTS_DIR . "/elements/sidebars.php" );
require_once( MEMBERLITE_ELEMENTS_DIR . "/elements/functions.php" );

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


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function memberlite_elements_body_classes( $classes ) {
	global $post;
	if( !empty( $post ) && is_page() ) {
		$memberlite_banner_show = get_post_meta( $post->ID, '_memberlite_banner_show', true );
		if( $memberlite_banner_show === '0' ) {
			$classes[] = 'memberlite-banner-hidden';
		}
	}
	return $classes;
}
add_filter( 'body_class', 'memberlite_elements_body_classes' );

/*
	Filter to hide the masthead banner based on post meta setting
*/
function memberlite_elements_banner_show( ) {
	global $post;
	if( !empty( $post) ) {
		$memberlite_banner_show = get_post_meta( $post->ID, '_memberlite_banner_show', true );
		if( $memberlite_banner_show === '0' ) {
			return false;
		} else {
			return true;
		}
	} else {
		return true;
	}
}
add_filter( 'memberlite_banner_show', 'memberlite_elements_banner_show' );

/*
	Filter to hide the masthead banner breadcrumbs based on post meta setting
*/
function memberlite_elements_show_breadcrumbs( ) {
	global $post;
	if( !empty( $post) ) {
		$memberlite_banner_hide_breadcrumbs = get_post_meta( $post->ID, '_memberlite_banner_hide_breadcrumbs', true );
		if( $memberlite_banner_hide_breadcrumbs === '1' ) {
			return false;
		} else {
			return true;
		}
	} else {
		return true;
	}
}
add_filter( 'memberlite_show_breadcrumbs', 'memberlite_elements_show_breadcrumbs' );

/*
	Filter to show additional content in the masthead banner
*/
function memberlite_elements_masthead_content( $content ) {
	global $post;
	if( !empty( $post) ) {
		//add a space to the front, to make sure the default masthead isn't shown
		$content .= ' ';

		//Get setting for masthead banner extra padding
		$memberlite_banner_extra_padding = get_post_meta( $post->ID, '_memberlite_banner_extra_padding', true );
		if( !empty( $memberlite_banner_extra_padding ) ) {
			//Add the masthead banner padding wrapper
			$content .= '<div class="masthead-padding">';
		}

		//Get setting for masthead banner right column content
		$memberlite_banner_right = get_post_meta( $post->ID, '_memberlite_banner_right', true );		

		//Get setting to show or hide masthead banner icon
		$memberlite_banner_icon = get_post_meta( $post->ID, '_memberlite_banner_icon', true );

		//Get setting for masthead banner icon content
		$memberlite_page_icon = get_post_meta( $post->ID, '_memberlite_page_icon', true );

		//Get settings for landing page
		$pmproal_landing_page_level = get_post_meta($post->ID,'_pmproal_landing_page_level',true);
		$memberlite_landing_page_checkout_button = get_post_meta($post->ID,'_memberlite_landing_page_checkout_button',true);
		$memberlite_landing_page_upsell = get_post_meta($post->ID,'_memberlite_landing_page_upsell',true);

		if( !empty( $memberlite_banner_right ) || ( !empty( $memberlite_banner_icon )  && !empty( $memberlite_page_icon ) ) ) {

			//Get the columns ratio for the masthead banner based on content setting in customizer.
			$memberlite_columns_primary = memberlite_getColumnsRatio();

			$content .= '<div class="memberlite_elements-masthead row">';								

			//Check that we should display a masthead banner icon and it is set
			if( !empty( $memberlite_banner_icon ) && !empty( $memberlite_page_icon ) ) {
				//Show the icon in a 2 column span
				$content .= '<div class="medium-1 columns"><i class="fa fa-4x fa-' . $memberlite_page_icon . '"></i></div>';

				//Add the column wrapper for page title and description
				if( empty( $memberlite_banner_right) ) {
					$content .= '<div class="medium-11 columns">';
				} else {
					$content .= '<div class="medium-' . ( $memberlite_columns_primary-1 ) .' columns">';
				}
			} else {
				$content .= '<div class="medium-' . $memberlite_columns_primary . '  columns">';
			}
		}

		//Show the landing page featured image
		if( is_page_template( 'templates/landing.php' ) && has_post_thumbnail( $post->ID ) ) {
			$content .= get_the_post_thumbnail( 'medium', array( 'class' => 'alignleft' ) );
		}

		//Get setting to show or hide page title in masthead banner
		$memberlite_banner_hide_title = get_post_meta( $post->ID, '_memberlite_banner_hide_title', true );
		if( empty( $memberlite_banner_hide_title ) ) {
			$content .= memberlite_page_title( false );	//false to not echo
		} 

		//Get content for masthead banner description
		$memberlite_banner_desc = get_post_meta( $post->ID, '_memberlite_banner_desc', true );
		if( !empty( $memberlite_banner_desc ) ) {
			//Show the masthead banner description
			$content .= wpautop( do_shortcode( $memberlite_banner_desc ) );
		}

		//Show the landing page level price and checkout button
		if( is_page_template( 'templates/landing.php' ) && !empty( $pmproal_landing_page_level ) && defined( 'PMPRO_VERSION' ) ) {
			$level = pmpro_getLevel( $pmproal_landing_page_level );
			
			//Set default checkout button text
			if( empty( $memberlite_landing_page_checkout_button ) ) {
				$memberlite_landing_page_checkout_button = 'Select';	
			}

			if( !empty( $level ) ) {
				if( empty( $memberlite_banner_desc ) ) {
					//Show the level descrpition of banner description is empty
					$content .= wpautop( do_shortcode( $level->description ) );
				}
				$content .= '<p class="pmpro_level-price">' . pmpro_getLevelCost($level, true, true) . '</p>';
				$content .= '<p><a class="btn btn_action" href="' . esc_url( add_query_arg( 'level', $pmproal_landing_page_level, pmpro_url( 'checkout' ) ) ) . '">' . esc_attr( $memberlite_landing_page_checkout_button ) . '</a></p>';
			}
		}

		if( !empty( $memberlite_banner_right ) || ( !empty( $memberlite_banner_icon )  && !empty( $memberlite_page_icon ) ) ) {
			//Close the masthead banner columns div 
			$content .= '</div> <!--.medium-X .columns -->';
		}

		if( !empty( $memberlite_banner_right ) ) {
			//Show the masthead banner right columns 
			$content .= '<div class="medium-' . memberlite_getColumnsRatio( 'sidebar' ) . ' columns">';
			$content .= wpautop( do_shortcode( $memberlite_banner_right ) );
			$content .= '</div> <!--.medium-X .columns -->';
		}

		if( !empty( $memberlite_banner_right ) || ( !empty( $memberlite_banner_icon )  && !empty( $memberlite_page_icon ) ) ) {
			//Close the masthead banner row div
			$content .= '</div> <!--.row -->';
		}

		if( !empty( $memberlite_banner_extra_padding ) ) {
			//Cloise the masthead banner padding wrapper
			$content .= '</div><!--.masthead-padding';
		}
	}

	return $content;
}
add_filter( 'memberlite_masthead_content', 'memberlite_elements_masthead_content' );

/*
	Filter to show the banner image from MultiPostThumbnails if it exists
*/
function memberlite_elements_banner_image_src( $memberlite_banner_image_src, $size ) {
	global $post;
	
	if( class_exists( 'MultiPostThumbnails') ) {
		//The Banner Image meta box is available
		$memberlite_banner_image_id = MultiPostThumbnails::get_post_thumbnail_id(
			$post->post_type,
			'memberlite_banner_image' . $post->post_type,
			$post->ID
		);

		if( !empty( $memberlite_banner_image_id ) ) {
			//Set memberlite_banner_image_src to the use Banner Image instead
			$memberlite_banner_image_src = wp_get_attachment_image_src( $memberlite_banner_image_id, $size );
		}
	}

	return $memberlite_banner_image_src;
}
add_filter( 'memberlite_banner_image_src', 'memberlite_elements_banner_image_src', 10, 2 );

/*
	Enable the use of shortcodes in text widgets.
*/
add_filter( 'widget_text', 'do_shortcode' );

/*
	Function to display the background image in the banner.
*/
function memberlite_elements_before_masthead_outer( ) {
	if( is_home() || is_post_type_archive( 'post' ) ) {
		$post_id = get_option('page_for_posts');
	} else {
		// get from queried object
		$queried_object = get_queried_object();
		if( !empty( $queried_object ) ) {
			$post_id = $queried_object->ID;
		}
	}

	if( !empty( $post_id ) && function_exists( 'memberlite_get_banner_image_src' ) ) {
		$memberlite_show_image_banner = get_post_meta( $post_id, '_memberlite_show_image_banner', true );
		$memberlite_banner_image_src = memberlite_get_banner_image_src( $post_id, 'full' );
		$the_post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );

		if( !empty( $memberlite_show_image_banner ) && !empty( $memberlite_banner_image_src ) || ( !empty( $memberlite_banner_image_src ) && ( $memberlite_banner_image_src != $the_post_thumbnail_src ) ) ) { ?>
			<div class="masthead-banner" style="background-image: url('<?php echo esc_attr($memberlite_banner_image_src[0]);?>');">
			<?php
		}
	}
}
add_action( 'memberlite_before_masthead_outer', 'memberlite_elements_before_masthead_outer' );

/*
	Function to display the background image in the banner.
*/
function memberlite_elements_after_masthead_outer( ) {
	global $post;
	
	if( !empty( $post ) ) {
		$post_id = $post->ID;
	}

	if( is_home() || is_archive() ) {
		$post_id = get_option('page_for_posts');
	}

	if( !empty( $post_id ) && function_exists( 'memberlite_get_banner_image_src' ) ) {
		$memberlite_show_image_banner = get_post_meta( $post_id, '_memberlite_show_image_banner', true );
		$memberlite_banner_image_src = memberlite_get_banner_image_src( $post_id, 'full' );
		$the_post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );

		if( !empty( $memberlite_show_image_banner ) && !empty( $memberlite_banner_image_src ) || ( !empty( $memberlite_banner_image_src ) && ( $memberlite_banner_image_src != $the_post_thumbnail_src ) ) ) { ?>
			</div><!--.masthead-banner-->
			<?php
		}
	}
}
add_action( 'memberlite_after_masthead_outer', 'memberlite_elements_after_masthead_outer' );

/*
	Function to display content after the page.
*/
function memberlite_elements_after_content_page( ) {
	global $post;
	//Show the landing page level checkout button and upsell
	if( is_page_template( 'templates/landing.php' ) && defined( 'PMPRO_VERSION' ) ) {
		//Get settings for landing page
		$pmproal_landing_page_level = get_post_meta($post->ID,'_pmproal_landing_page_level',true);
		$memberlite_landing_page_checkout_button = get_post_meta($post->ID,'_memberlite_landing_page_checkout_button',true);
		$memberlite_landing_page_upsell = get_post_meta($post->ID,'_memberlite_landing_page_upsell',true);

		$level = pmpro_getLevel( $pmproal_landing_page_level );
		
		//Set default checkout button text
		if( empty( $memberlite_landing_page_checkout_button ) ) {
			$memberlite_landing_page_checkout_button = 'Select';	
		}

		//Show the landing page level checkout button
		if( !empty( $level ) ) {
			echo '<p><a class="btn btn_action" href="' . esc_url( add_query_arg( 'level', $pmproal_landing_page_level, pmpro_url( 'checkout' ) ) ) . '">' . esc_attr( $memberlite_landing_page_checkout_button ) . '</a></p>';
		}

		//Show the landing page level upsell pricing block
		if( !empty( $memberlite_landing_page_upsell ) && ( is_numeric( $memberlite_landing_page_upsell ) ) && shortcode_exists( 'pmpro_advanced_levels' ) ) {
			echo '<hr />';
			echo do_shortcode('[pmpro_advanced_levels levels="' . intval($memberlite_landing_page_upsell) . '"]');
		}
	}
}
add_action( 'memberlite_after_content_page', 'memberlite_elements_after_content_page' );

function memberlite_elements_before_sidebar_widgets( ) {
	global $post;

	//Show the landing page level checkout button and upsell
	if( is_page_template( 'templates/landing.php' ) && defined( 'PMPRO_VERSION' ) && shortcode_exists( 'memberlite_signup' ) ) {
		$pmproal_landing_page_level = get_post_meta($post->ID,'_pmproal_landing_page_level',true);
		if( !empty( $pmproal_landing_page_level ) ) {
			echo do_shortcode('[memberlite_signup level="' . $pmproal_landing_page_level . '" short="true" title="' . str_replace('"', '', __('Sign Up Now', 'memberlite-elements')) . '"]'); 
		}
	}	
}
add_action( 'memberlite_before_sidebar_widgets' , 'memberlite_elements_before_sidebar_widgets' );