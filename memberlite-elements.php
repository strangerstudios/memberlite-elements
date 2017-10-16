<?php
/*
Plugin Name: Memberlite Elements
Plugin URI: http://www.memberlitetheme.com/plugins/memberlite-elements/
Description: Theme elements designed to work with the Memberlite Theme and Memberlite Child Themes.
Version: 1.0
Author: kimannwall, strangerstudios
Author URI: http://www.memberlitetheme.com
*/

define('MEMBERLITE_ELEMENTS_DIR', dirname(__FILE__) );
define('MEMBERLITE_ELEMENTS_URL', plugins_url('', __FILE__));
define('MEMBERLITE_ELEMENTS_VERSION', '1.0');

/*
	Enqueue Stylesheets and Javascript
*/
function memberlite_elements_init_styles() {
	//need jquery
	wp_enqueue_script('jquery');
	
	wp_enqueue_style('memberlite_fontawesome', MEMBERLITE_ELEMENTS_URL . "/font-awesome/css/font-awesome.min.css", array(), "4.6.1");
	wp_enqueue_style("memberlite_elements_frontend", MEMBERLITE_ELEMENTS_URL . "/css/memberlite-elements.css", array(), MEMBERLITE_ELEMENTS_VERSION);	
}
add_action("wp_enqueue_scripts", "memberlite_elements_init_styles");	

/*
	Load all Elements
*/
function memberlite_elements_init_elements() {
	require_once(MEMBERLITE_ELEMENTS_DIR . "/elements/page_banners.php");
	require_once(MEMBERLITE_ELEMENTS_DIR . "/elements/sidebars.php");
}
add_action('init', 'memberlite_elements_init_elements');
