<?php
function memberlite_elements_fa_shortcode($atts, $content = null) {
	// $atts    ::= array of attributes
	// $content ::= text within enclosing form of shortcode element
	// examples: [fa icon="comment" color="primary" type="solid" size="3x"]

    extract(shortcode_atts(array(
		'color' => '',
		'icon' => '',
		'size' => '',
        'type' => '',
    ), $atts));
    $r = '<i class="';

    $font_awesome_icons_brands = memberlite_elements_get_font_awesome_icons( 'brand' );

    // Check if the icon is a "brand" icon and set the type attribute.
    if ( in_array( $icon, $font_awesome_icons_brands ) ) {
        $type = 'brand';
    }

    if ( ! empty( $type ) ) {
        if ( $type === 'regular' ) {
            $r .= 'far';
        } elseif ( $type === 'solid' ) {
            $r .= 'fas';
        } elseif ( $type === 'brand' ) {
            $r .= 'fab';
        }
	} else {
        $r .= 'fa';
    }

    $r .= ' fa-' . $icon;

	if(!empty($color))
	{
		$r .= ' ' . $color;
	}
	if(!empty($size))
	{
		$r .= ' fa-' . $size;
	}
	$r .= '"></i>';
    return $r;
}
remove_shortcode('fa');	//replace shortcode bundled with Memberlite 2.0 and prior or anywhere else
add_shortcode('fa', 'memberlite_elements_fa_shortcode');
