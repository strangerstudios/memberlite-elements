<?php
/*
Plugin Name: Memberlite Elements
Plugin URI: https://www.memberlitetheme.com/memberlite-elements/
Description: A set of elements designed enhance the appearance of sites using the Memberlite Theme.
Version: 1.0.3
Author: Stranger Studios
Author URI: https://www.memberlitetheme.com
*/

define( 'MEMBERLITE_ELEMENTS_DIR', dirname( __FILE__ ) );
define( 'MEMBERLITE_ELEMENTS_URL', plugins_url( '', __FILE__ ) );
define( 'MEMBERLITE_ELEMENTS_VERSION', '1.0.3' );

/**
 * Include plugin files.
 */
function memberlite_elements_load() {
	// First check if an older version of Memberlite is active
	if( defined( 'MEMBERLITE_VERSION' ) && version_compare( MEMBERLITE_VERSION, '4.0' ) === -1 ) {
		// Show an admin notice RE upgrading Memberlite
		if( is_admin() ) {
			add_action( 'admin_notices', 'memberlite_elements_upgrade_memberlite_notice' );
		}
	} else {
		// We're Gucci
		require_once( MEMBERLITE_ELEMENTS_DIR . "/elements/functions.php" );
		require_once( MEMBERLITE_ELEMENTS_DIR . "/elements/landing_page.php" );
		require_once( MEMBERLITE_ELEMENTS_DIR . "/elements/page_banners.php" );
		require_once( MEMBERLITE_ELEMENTS_DIR . "/elements/sidebars.php" );
	}
}
add_action( 'after_setup_theme', 'memberlite_elements_load', 1 );

/**
 * Admin notice if we need to upgrade Memberlite
 * Hook is added above if MEMBERLITE_VERSION < 4.0
 */
function memberlite_elements_upgrade_memberlite_notice() {
	$class = 'notice notice-error';
	$message = __( 'Memberlite Elements requires Memberlite version 4.0 or higher.', 'memberlite-elements' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}
