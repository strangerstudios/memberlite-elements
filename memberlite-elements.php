<?php
/*
Plugin Name: Memberlite Elements
Plugin URI: https://www.memberlitetheme.com/memberlite-elements/
Description: A set of elements designed enhance the appearance of sites using the Memberlite Theme.
Version: 1.1
Author: Stranger Studios
Author URI: https://www.memberlitetheme.com
Text Domain: memberlite-elements
Domain Path: /languages
*/

define( 'MEMBERLITE_ELEMENTS_DIR', dirname( __FILE__ ) );
define( 'MEMBERLITE_ELEMENTS_URL', plugins_url( '', __FILE__ ) );
define( 'MEMBERLITE_ELEMENTS_VERSION', '1.1' );

/**
 * Load text domain
 */
function memberlite_elements_load_plugin_text_domain() {
	load_plugin_textdomain( 'memberlite-elements', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}
add_action( 'plugins_loaded', 'memberlite_elements_load_plugin_text_domain' );

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

		/**
		 * Filter to allow themes to remove elements loaded 
		 *
		 */
		$memberlite_elements_supported_elements = apply_filters( 'memberlite_elements_supported_elements', array( 'landing_page', 'page_banners', 'sidebars' ) );
		if ( in_array( 'landing_page', $memberlite_elements_supported_elements ) ) {
			require_once( MEMBERLITE_ELEMENTS_DIR . '/elements/landing_page.php' );
		}
		if ( in_array( 'page_banners', $memberlite_elements_supported_elements ) ) {
			require_once( MEMBERLITE_ELEMENTS_DIR . '/elements/page_banners.php' );
		}
		if ( in_array( 'sidebars', $memberlite_elements_supported_elements ) ) {
			require_once( MEMBERLITE_ELEMENTS_DIR . '/elements/sidebars.php' );
		}
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
