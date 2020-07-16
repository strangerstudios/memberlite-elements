<?php
/**
 * Block functionality for the Contextual Messages block.
 *
 * @package memberlite
 */

/**
 * Register contextual message block and attributes.
 */
function memberlite_register_contextual_message_block() {
	// Check if the register function exists.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	register_block_type(
		'memberlite/contextual-message',
		array(
			'attributes'      => array(
				'messageStyle' => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'message'      => array(
					'type'    => 'string',
					'default' => '',
				),
			),
			'render_callback' => 'memberlite_elements_contextual_messages_block_output',
			'editor_script'   => 'memberlite_elements_blocks',
			'editor_style'    => 'memberlite_elements_blocks_css',
		)
	);
}
add_action( 'init', 'memberlite_register_contextual_message_block' );

/**
 * Return the contents of the contextual messages shortcode for display.
 *
 * @param array $attributes Passed block attributes.
 *
 * @return string Block output.
 */
function memberlite_elements_contextual_messages_block_output( $attributes ) {
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
