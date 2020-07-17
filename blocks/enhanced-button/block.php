<?php
/**
 * Block functionality for the Enhanced Button block.
 *
 * @package memberlite
 */

/**
 * Register enhanced button block and attributes.
 */
function memberlite_register_enhanced_button_block() {
	// Check if the register function exists.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	register_block_type(
		'memberlite/enhanced-button',
		array(
			'attributes'      => array(
				'buttonStyle' => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'content'     => array(
					'type'    => 'string',
					'default' => '',
				),
				'btnId'          => array(
					'type'    => 'string',
					'default' => '',
				),
				'rel'         => array(
					'type'    => 'string',
					'default' => '',
				),
				'buttonURL'   => array(
					'type'    => 'string',
					'default' => '',
				),
				'newTab'      => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'noFollow'    => array(
					'type'    => 'boolean',
					'default' => false,
				),
			),
			'render_callback' => 'memberlite_elements_enhanced_button_block_output',
			'editor_script'   => 'memberlite_elements_blocks',
			'editor_style'    => 'memberlite_elements_blocks_css',
		)
	);
}
add_action( 'init', 'memberlite_register_enhanced_button_block' );

/**
 * Return the contents of the enhanced button for display.
 *
 * @param array $attributes Passed block attributes.
 *
 * @return string Block output.
 */
function memberlite_elements_enhanced_button_block_output( $attributes ) {
	$message_style = isset( $attributes['messageStyle'] ) ? $attributes['messageStyle'] : 'default';
	$message       = isset( $attributes['message'] ) ? $attributes['message'] : '';

	ob_start();
	?>
	<div class="pmpro_message pmpro_<?php echo esc_attr( $message_style ); ?>">
		<?php echo wp_kses_post( $message ); ?>
	</div>
	<?php
	return ob_get_clean();
}
