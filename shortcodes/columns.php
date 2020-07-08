<?php
/* Adapted from https://github.com/wp-plugins/easy-foundation-shortcodes/blob/master/shortcode/wpcolumns/plugin_shortcode.php */

// Rows
function memberlite_elements_row_shortcode($atts, $content = null) {
	// $atts    ::= array of attributes
	// $content ::= text within enclosing form of shortcode element
	// examples: [row class="examples"]
    extract(shortcode_atts(array(
        'class' => ''
    ), $atts));
    $result = '<div class="row ' . $class . '">';
    $content = str_replace("]<br />", ']', $content);
    $content = str_replace("<br />\n[", '[', $content);
    $result .= do_shortcode($content);
    $result .= '</div>';
    return force_balance_tags($result);
}
remove_shortcode('row');	//replace shortcode bundled with Memberlite 2.0 and prior or anywhere else
remove_shortcode('row_row');
remove_shortcode('row_row_row');
remove_shortcode('row_row_row_row_your_boat');
add_shortcode('row', 'memberlite_elements_row_shortcode');
add_shortcode('row_row', 'memberlite_elements_row_shortcode');
add_shortcode('row_row_row', 'memberlite_elements_row_shortcode');
add_shortcode('row_row_row_your_boat', 'memberlite_elements_row_shortcode');

//Columns
function memberlite_elements_col_shortcode($atts, $content = null) {
	// $atts    ::= array of attributes
	// $content ::= text within enclosing form of shortcode element
	// examples: [col large="3" medium="6" large_offset="3"]
    extract(shortcode_atts(array(
		'class' => '',
		'small' => '',
		'medium' => '',
		'large' => '',
		'small_offset' => '',
		'medium_offset' => '',
		'large_offset' => '',
    ), $atts));
    $arr = array('small'=>'small','medium'=>'medium','large'=>'large','small-offset' =>'small_offset','medium-offset' =>'medium_offset','large-offset' =>'large_offset');
    $classes = array();
    foreach ($arr as $k => $aa) {
		if(!empty(${$aa}))
			$classes[] = $k.'-' . ${$aa};
    }
    $result = '<div class="' . implode(' ', $classes) . ' ' . $class . ' columns">';
    $result .= do_shortcode($content);
    $result .= '</div>';
    return force_balance_tags($result);
}
remove_shortcode('col');	//replace shortcode bundled with Memberlite 2.0 and prior or anywhere else
remove_shortcode('col_col');
remove_shortcode('col_col_col');
remove_shortcode('col_col_col_me_maybe');
add_shortcode('col', 'memberlite_elements_col_shortcode');
add_shortcode('col_col', 'memberlite_elements_col_shortcode');
add_shortcode('col_col_col', 'memberlite_elements_col_shortcode');
add_shortcode('col_col_col_me_maybe', 'memberlite_elements_col_shortcode');