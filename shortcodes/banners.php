<?php
function memberlite_elements_banner_shortcode($atts, $content = null) {
	// $atts    ::= array of attributes
	// $content ::= text within enclosing form of shortcode element
	// examples: [memberlite_banner align="center" background="primary" color="#FFFFFF" title="Banner Title"]
    extract(shortcode_atts(array(
		'align' => '',
		'background' => 'primary',
		'color' => '',
		'title' => '',
    ), $atts));
    
	if ( preg_match( '/^#[a-f0-9]{6}$/i', $background ) ) {
        // The background color was specified as a HEX value with the # symbol.
		$r = '<div class="banner banner_custom-color" style="background-color: ' . $background . ';">';
    } elseif ( preg_match( '/^[a-f0-9]{6}$/i', $background ) ) {
        // The background color was specified as a HEX value without the # symbol.
		$r = '<div class="banner banner_custom-color" style="background-color: #' . $background . ';">';
    } elseif( preg_match('/\.(gif|jpg|png|svg|jpeg)$/', $background ) ) {
        // A background image url was specified.
    	$r = '<div class="banner banner_background-image" style="background-image: url(' . esc_url( $background ) . ');">';
	} else {
        // A background color value of primary, secondary, action, or body was specified.
		$r = '<div class="banner banner_' . esc_attr( $background ) . '">';
    }
	$r .= '<div class="row"><div class="medium-12 columns';
	if($align)
		$r .= ' text-' . $align;
	$r .= '"';
	if(preg_match('/^#[a-f0-9]{6}$/i', $color)) 
		$r .= ' style="color: ' . $color . '"';
	elseif(preg_match('/^[a-f0-9]{6}$/i', $color))
		$r .= ' style="color: #' . $color . '"';
	$r .= '>';
	if(!empty($title))
		$r .= '<h2>' . $title . '</h2>';
    $r .= apply_filters('the_content', $content);
    $r .= '</div></div></div>';
    return $r;
}
remove_shortcode('memberlite_banner');	//replace shortcode bundled with Memberlite 2.0 and prior or anywhere else
add_shortcode('memberlite_banner', 'memberlite_elements_banner_shortcode');
