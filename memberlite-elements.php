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
	Function to display the background image in the banner.
*/
function memberlite_elements_before_masthead_outer( ) {
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

function memberlite_elements_get_widget_areas( $widget_areas ) {
	global $post;

	$widget_areas = array();
	//Get the 'Custom Sidebar' settings for CPTs
	$memberlite_cpt_sidebars = get_option('memberlite_cpt_sidebars', array());

	if( !empty( $post->ID ) && is_single() ) {
		$memberlite_custom_sidebar = get_post_meta( $post->ID, '_memberlite_custom_sidebar', true );
		$memberlite_default_sidebar_position = get_post_meta($post->ID, '_memberlite_default_sidebar', true );
		$memberlite_hide_children = get_post_meta( $post->ID, '_memberlite_hide_children', true );
	}

	if( is_page() ) {
		if( empty( $memberlite_hide_children ) ) {
			$widget_areas[] = 'memberlite_nav_menu_submenu';
		}
		if( empty( $memberlite_default_sidebar_position ) || $memberlite_default_sidebar_position === 'default_sidebar_above' ) {
			$widget_areas[] = 'sidebar-1';
		}
		if( !empty( $memberlite_custom_sidebar ) && $memberlite_custom_sidebar != 'memberlite_sidebar_blank' ) {
			$widget_areas[] = $memberlite_custom_sidebar;
		}
		if( !empty( $memberlite_default_sidebar_position ) && $memberlite_default_sidebar_position === 'default_sidebar_below' ) {
			$widget_areas[] = 'sidebar-1';
		}
	} elseif( !empty( $post->ID ) && !empty( $memberlite_cpt_sidebars ) && !in_array( get_post_type( $post ), array( 'post','page' ) ) ) {
		//This is a CPT and may have a Custom CPT Sidebar defined
		$post_type = get_post_type($post);
		if( !empty( $memberlite_cpt_sidebars[$post_type] ) ) {
			//Set the default sidebar to the Custom CPT Sidebar
			$memberlite_custom_sidebar = $memberlite_cpt_sidebars[$post_type];
		}
	} elseif( function_exists( 'is_bbpress' ) && is_bbpress() ) { 
		if(bbp_is_single_topic() || bbp_is_single_forum() ) {
			//Show the sidebar as set in the topic's parent forum or forum
			$memberlite_custom_sidebar = get_post_meta( bbp_get_forum_id(), '_memberlite_custom_sidebar', true );
			$memberlite_default_sidebar_position = get_post_meta( bbp_get_forum_id(), '_memberlite_default_sidebar', true );
			if( empty( $memberlite_default_sidebar_position ) || $memberlite_default_sidebar_position === 'default_sidebar_above' ) {
				$widget_areas[] = 'sidebar-2';
			}
			if( !empty( $memberlite_custom_sidebar ) && $memberlite_custom_sidebar != 'memberlite_sidebar_blank' ) {
				$widget_areas[] = $memberlite_custom_sidebar;
			}
			if( !empty( $memberlite_default_sidebar_position ) && $memberlite_default_sidebar_position === 'default_sidebar_below' ) {
				$widget_areas[] = 'sidebar-2';
			}
		} else {
			$widget_areas[] = 'sidebar-2';
		}
/*
		if ( empty( $memberlite_custom_sidebar ) ||  $memberlite_custom_sidebar === 'memberlite_sidebar_blank' ) {
				$widget_areas[] = 'sidebar-2';
		} 
		elseif( empty( $memberlite_custom_sidebar ) && !empty( $memberlite_cpt_sidebars['forum'] ) ) {
			//Fallback to the 'forum' Custom CPT Sidebar
			$memberlite_custom_sidebar = $memberlite_cpt_sidebars['forum'];
		} else {
			$widget_areas[] = 'sidebar-2';
		}
*/
	} elseif( !empty( $post->ID ) && !empty( $memberlite_cpt_sidebars ) && !in_array( get_post_type( $post ), array( 'post','page' ) ) ) {
		//This is a CPT and may have a Custom CPT Sidebar defined
		$post_type = get_post_type($post);
		if( !empty( $memberlite_cpt_sidebars[$post_type] ) ) {
			//Set the default sidebar to the Custom CPT Sidebar
			$memberlite_custom_sidebar = $memberlite_cpt_sidebars[$post_type];
		}
	} elseif( is_home() || is_archive() || is_single() ) {
/*
		if( !is_single() ) {
			$memberlite_hide_children = get_post_meta( get_option( 'page_for_posts' ), '_memberlite_hide_children', true );
			if( empty( $memberlite_hide_children ) ) {
				$widget_areas[] = 'memberlite_nav_menu_submenu';
			}
		}
*/
		if ( empty( $memberlite_custom_sidebar) ) {
			//Check if the page_for_posts has a custom sidebar 
			$memberlite_custom_sidebar = get_post_meta( get_option( 'page_for_posts' ), '_memberlite_custom_sidebar', true );
		}
		if ( empty( $memberlite_default_sidebar_position) ) {
			//Check if the page_for_posts has a default sidebar position 
			$memberlite_default_sidebar_position = get_post_meta( get_option( 'page_for_posts' ), '_memberlite_default_sidebar', true);
		}
		if( empty( $memberlite_default_sidebar_position ) || $memberlite_default_sidebar_position === 'default_sidebar_above' ) {
			$widget_areas[] = 'sidebar-2';
		}
		if( !empty( $memberlite_custom_sidebar ) && $memberlite_custom_sidebar != 'memberlite_sidebar_blank' ) {
			$widget_areas[] = $memberlite_custom_sidebar;
		}
		if( $memberlite_default_sidebar_position === 'default_sidebar_below' ) {
			$widget_areas[] = 'sidebar-2';
		}		
	}

/*
	} else { 
		$memberlite_default_sidebar = 'sidebar-2';
	}

	//Custom sidebar isn't set on the post. Is it set in a global?
	if( empty( $memberlite_custom_sidebar ) ) {
		if( !empty( $post->ID ) && !empty( $memberlite_cpt_sidebars ) && !in_array( get_post_type( $post ), array( 'post','page' ) ) ) {
			//This is a CPT and may have a Custom CPT Sidebar defined
			$post_type = get_post_type($post);
			if( !empty( $memberlite_cpt_sidebars[$post_type] ) ) {
				//Set the default sidebar to the Custom CPT Sidebar
				$memberlite_custom_sidebar = $memberlite_cpt_sidebars[$post_type];
			}
		}

		if( function_exists( 'is_bbpress' ) && is_bbpress() ) { 
			if(bbp_is_single_topic() || bbp_is_single_forum() ) {
				//Show the sidebar as set in the topic's parent forum or forum
				$memberlite_custom_sidebar = get_post_meta( bbp_get_forum_id(), '_memberlite_custom_sidebar', true );
			} 
			if( empty( $memberlite_custom_sidebar ) && !empty( $memberlite_cpt_sidebars['forum'] ) ) {
				//Fallback to the 'forum' Custom CPT Sidebar
				$memberlite_custom_sidebar = $memberlite_cpt_sidebars['forum'];
			}
		}

		//Check if the page_for_posts has a custom sidebar 
		if ( is_home() || is_search() || is_single() || is_category() || is_author() || is_archive() || is_day() || is_month() || is_year() ) {
			$memberlite_custom_sidebar = get_post_meta( get_option( 'page_for_posts' ), '_memberlite_custom_sidebar', true );
		}
	} 

	//Get the default sidebar position from the post
	if( !empty( $post->ID ) ) {
		$memberlite_default_sidebar_position = get_post_meta($post->ID, '_memberlite_default_sidebar', true);
	}

/*
	//Default sidebar position isn't set on the post. Is it set in a parent or global?
	if( empty( $memberlite_default_sidebar_position ) ) {
		if( function_exists('is_bbpress') && is_bbpress() ) {
			if(bbp_is_single_topic() || bbp_is_single_forum() ) {
			$memberlite_custom_sidebar = get_post_meta(bbp_get_forum_id(), '_memberlite_custom_sidebar', true);
			$memberlite_default_sidebar = get_post_meta(bbp_get_forum_id(), '_memberlite_default_sidebar', true);			
		}
		else
		{
			$memberlite_default_sidebar = 'default_sidebar_above';
		}

			$memberlite_hide_children = get_post_meta( get_option( 'page_for_posts' ), '_memberlite_hide_children', true);
			if ( $memberlite_default_sidebar_position != 'default_sidebar_hide' ) {
				$memberlite_default_sidebar = 'sidebar-';
			}

	echo '<p>default = ' . $memberlite_default_sidebar . '</p>';
	echo '<p>default position = ' . $memberlite_default_sidebar_position . '</p>';
	echo '<p>custom = ' . $memberlite_custom_sidebar . '</p>';
	echo '<p>hide = ' . $memberlite_hide_children . '</p>';
*/
	return $widget_areas;
}
add_filter( 'memberlite_get_widget_areas', 'memberlite_elements_get_widget_areas' );
