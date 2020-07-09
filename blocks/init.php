<?php
/**
 * Initialization file for the Gutenberg blocks.
 *
 * @package Memberlite
 */

/**
 * Add a block category for the Gutenberg block collection.
 *
 * @param array  $categories List of Gutenberg block categories.
 * @param object $post Post object.
 *
 * @return array $categories Updated list of block categories.
 */
function memberlite_add_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'memberlite',
				'title' => __( 'Memberlite Elements', 'memberlite-elements' ),
			),
		)
	);
}
add_filter( 'block_categories', 'memberlite_add_block_category', 10, 2 );

/**
 * Register admin scripts and styles.
 */
function memberlite_register_block_scripts_admin() {
	wp_register_script(
		'memberlite_elements_blocks',
		MEMBERLITE_ELEMENTS_URL . '/js/blocks.build.js',
		array(
			'wp-blocks',
			'wp-element',
		),
		MEMBERLITE_ELEMENTS_VERSION,
		true
	);
	wp_set_script_translations( 'memberlite_elements_blocks', 'memberlite-elements' );
}
add_action( 'wp_enqueue_scripts', 'memberlite_register_block_scripts_admin' );

/**
 * Register front-end block scripts and styles.
 */
function memberlite_register_block_scripts_front_end() {

}
add_action( 'wp_enqueue_scripts', 'memberlite_register_block_scripts_front_end' );

/**
 * Include blocks in PHP.
 */
function memberlite_include_blocks() {
	// Include the banner block and initialize via PHP.
	require 'banner/block.php';
}
add_action( 'plugins_loaded', 'memberlite_include_blocks', 11 );
