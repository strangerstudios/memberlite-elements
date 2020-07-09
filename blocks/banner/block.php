<?php
/**
 * Block functionality for the Banner block.
 *
 * @package memberlite
 */

/**
 * Register banner block and attributes.
 */
function memberlite_register_banner_block() {
	// Check if the register function exists.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	register_block_type(
		'memberlite/banner',
		array(
			'attributes'      => array(
				'backgroundColor' => array(
					'type'    => 'string',
					'default' => 'inherit',
				),
				'preview'         => array( /* Leave this in if you plan to have block previews */
					'type'    => 'boolean',
					'default' => false,
				),

			),
			'render_callback' => 'memberlite_banner_block_output',
			'editor_script'   => 'memberlite_elements_blocks',
			/*'editor_style'    => 'ptam-style-editor-css',*/
			/* Uncomment editor_style and point to stylesheet if we are to have one */
		)
	);
}
add_action( 'init', 'memberlite_register_banner_block' );

/**
 * Return the contents of the banner shortcode for display.
 *
 * @param array $attributes Passed block attributes.
 *
 * @return string Block output.
 */
function memberlite_banner_block_output( $attributes ) {
	// Begin sanitization of attributes.
	return 'hello world';
}
