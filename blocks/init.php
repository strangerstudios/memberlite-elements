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
