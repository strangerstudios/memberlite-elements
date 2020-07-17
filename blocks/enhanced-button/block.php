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
				'btnId'       => array(
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
	$button_style = isset( $attributes['buttonStyle'] ) ? $attributes['buttonStyle'] : 'default';
	$href         = isset( $attributes['buttonURL'] ) ? esc_url( $attributes['buttonURL'] ) : '#';
	$button_text  = isset( $attributes['content'] ) ? $attributes['content'] : '';
	$button_id    = isset( $attributes['btnId'] ) ? $attributes['btnId'] : '';
	$button_rel   = isset( $attributes['rel'] ) ? $attributes['rel'] : '';
	$new_tab      = isset( $attributes['newTab'] ) ? $attributes['newTab'] : false;
	$no_follow    = isset( $attributes['noFollow'] ) ? $attributes['noFollow'] : false;

	// Build button styles.
	$classes = array();
	if ( 'link' !== $button_style ) {
		$classes[] = 'btn';
		$classes[] = 'btn_' . $button_style;
	}

	// Build rel attributes.
	$rel = $button_rel;
	if ( $no_follow ) {
		$rel .= ' ' . 'nofollow';
	}
	$rel = trim( $rel );

	ob_start();
	// $href has been previously sanitized.
	?>
	<a href="<?php echo $href; ?>" id="<?php echo esc_attr( $button_id ); ?>" rel="<?php echo esc_attr( $rel ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" target="<?php echo $new_tab ? '_blank' : ''; ?>"><?php echo esc_html( $button_text ); ?></a>
	<?php
	return ob_get_clean();
}
