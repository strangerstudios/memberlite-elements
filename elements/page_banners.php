<?php
/**
 * Page banner settings for the edit posts page in the admin.
 *
 * @package Memberlite
 */

/* Load JS on the edit post page in the admin. */
function memberlite_elements_admin_enqueue_scripts_for_page_banners() {
	$screen = get_current_screen();

	if( $screen->base == 'post' && !empty( $_REQUEST['action'] ) && $_REQUEST['action'] == 'edit' ) {
		wp_enqueue_script( 'memberlite-elements-admin-page_banners',  MEMBERLITE_ELEMENTS_URL . '/js/admin-page_banners.js', array( 'jquery' ), MEMBERLITE_ELEMENTS_VERSION, true );
	}
}
add_action( 'admin_enqueue_scripts', 'memberlite_elements_admin_enqueue_scripts_for_page_banners' );

/* Adds a Memberlite settings meta box to the side column on the Page edit screens. */
function memberlite_elements_settings_add_meta_box() {
	$screens = array( 'page' );
	foreach ( $screens as $screen ) {
		add_meta_box(
			'memberlite_settings_section',
			__( 'Memberlite Elements Settings', 'memberlite-elements' ),
			'memberlite_elements_settings_meta_box_callback',
			$screen,
			'normal',
			'high'
		);
	}
}
add_action('add_meta_boxes', 'memberlite_elements_settings_add_meta_box');

/* Meta box for Memberlite settings */
function memberlite_elements_settings_meta_box_callback( $post ) {
	global $fontawesome_icons;

	wp_nonce_field( 'memberlite_elements_settings_meta_box', 'memberlite_elements_settings_meta_box_nonce' );
	$memberlite_page_template = get_post_meta($post->ID, '_wp_page_template', true);
	$memberlite_banner_show = get_post_meta($post->ID, '_memberlite_banner_show', true);
	if($memberlite_banner_show === '')
		$memberlite_banner_show = 1;		//we want to default to showing if this has never been set
	$memberlite_page_icon = get_post_meta($post->ID, '_memberlite_page_icon', true);
	$memberlite_banner_desc = get_post_meta($post->ID, '_memberlite_banner_desc', true);
	$memberlite_banner_hide_title = get_post_meta($post->ID, '_memberlite_banner_hide_title', true);
	$memberlite_banner_hide_breadcrumbs = get_post_meta($post->ID, '_memberlite_banner_hide_breadcrumbs', true);
	$memberlite_banner_extra_padding = get_post_meta($post->ID, '_memberlite_banner_extra_padding', true);
	$memberlite_banner_right = get_post_meta($post->ID, '_memberlite_banner_right', true);
	$memberlite_banner_icon = get_post_meta($post->ID, '_memberlite_banner_icon', true);
	$memberlite_banner_bottom = get_post_meta($post->ID, '_memberlite_banner_bottom', true);
	$memberlite_landing_page_checkout_button = get_post_meta($post->ID, '_memberlite_landing_page_checkout_button', true);
	$pmproal_landing_page_level = get_post_meta($post->ID, '_pmproal_landing_page_level', true);
	$memberlite_landing_page_upsell = get_post_meta($post->ID, '_memberlite_landing_page_upsell', true);	
	echo '<h2><strong>' . __('Page Banner Settings', 'memberlite-elements') . '</strong></h2>';
	echo '<p style="margin: 1rem 0 0 0;"><strong>' . __('Show Page Banner', 'memberlite-elements') . '</strong> <em>Disable the entire page banner for this content.</em><br />';
	echo '<label class="screen-reader-text" for="memberlite_banner_show">';
	_e('Show Page Banner', 'memberlite-elements');
	echo '</label>';
	echo '<input type="radio" name="memberlite_banner_show" value="1" '. checked( $memberlite_banner_show, 1, false) .'> ';
	_e('Yes', 'memberlite-elements');
	echo '&nbsp;&nbsp;<input type="radio" name="memberlite_banner_show" value="0" '. checked( $memberlite_banner_show, 0, false) .'> ';
	_e('No', 'memberlite-elements');	
	echo '</p>';
	echo '<span id="memberlite_top_banner_settings_wrapper">';
	echo '<p style="margin: 1rem 0 0 0;"><strong>' . __('Banner Description', 'memberlite-elements') . '</strong> <em>Shown in the masthead banner below the page title.</em>';
	if(($memberlite_page_template == 'templates/landing.php') && function_exists('pmpro_getAllLevels'))
		echo ' <em>Leave blank to show landing page level description as banner description.</em>';
	echo '</p>';
	echo '<label class="screen-reader-text" for="memberlite_banner_desc">';
	_e('Banner Description', 'memberlite-elements');
	echo '</label>';
	wp_editor( $memberlite_banner_desc, 'memberltie_banner_desc', array( 'textarea_name' => 'memberlite_banner_desc', 'editor_class' => 'large-text', 'textarea_rows' => 3 ) );		
	echo '<input type="hidden" name="memberlite_banner_hide_title_present" value="1" />';
	echo '<label for="memberlite_banner_hide_title" class="selectit"><input name="memberlite_banner_hide_title" type="checkbox" id="memberlite_banner_hide_title" value="1" '. checked( $memberlite_banner_hide_title, 1, false) .'>' . __('Hide Page Title on Single View', 'memberlite-elements') . '</label>';
	echo '<input type="hidden" name="memberlite_banner_hide_breadcrumbs_present" value="1" />';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="memberlite_banner_hide_breadcrumbs" class="selectit"><input name="memberlite_banner_hide_breadcrumbs" type="checkbox" id="memberlite_banner_hide_breadcrumbs" value="1" '. checked( $memberlite_banner_hide_breadcrumbs, 1, false) .'>' . __('Hide Breadcrumbs', 'memberlite-elements') . '</label>';
	echo '<input type="hidden" name="memberlite_banner_extra_padding_present" value="1" />';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="memberlite_banner_extra_padding" class="selectit"><input name="memberlite_banner_extra_padding" type="checkbox" id="memberlite_banner_extra_padding" value="1" '. checked( $memberlite_banner_extra_padding, 1, false) .'>' . __('Add Extra Banner Padding', 'memberlite-elements') . '</label>';
	echo '<hr/>';
	echo '<p style="margin: 1rem 0 0 0;"><strong>' . __('Banner Right Column', 'memberlite-elements') . '</strong> <em>Right side of the masthead banner. (i.e. Video Embed, Image or Action Button)</em></p>';
	echo '<label class="screen-reader-text" for="memberlite_banner_right">';
	_e('Banner Right Column', 'memberlite-elements');
	echo '</label>';
	wp_editor( $memberlite_banner_right, 'memberltie_banner_right', array( 'textarea_name' => 'memberlite_banner_right', 'editor_class' => 'large-text', 'textarea_rows' => 3 ) );		
	echo '</span>';
	echo '<hr />';
	echo '<p style="margin: 1rem 0 0 0;"><strong>' . __('Page Bottom Banner', 'memberlite-elements') . '</strong> <em>Banner shown above footer on pages. (i.e. call to action)</em></p>';	
	echo '<label class="screen-reader-text" for="memberlite_banner_bottom">';
	_e('Page Bottom Banner', 'memberlite-elements');
	echo '</label>';
	wp_editor( $memberlite_banner_bottom, 'memberltie_banner_bottom', array( 'textarea_name' => 'memberlite_banner_bottom', 'editor_class' => 'large-text', 'textarea_rows' => 3 ) );		
	echo '<hr />';
	echo '<p style="margin: 1rem 0 0 0;"><strong>' . __('Page Icon', 'memberlite-elements') . '</strong>&nbsp;';
	echo '<label class="screen-reader-text" for="memberlite_page_icon">';
	_e('Select Icon', 'memberlite-elements');
	echo '</label>';
	echo '<select id="memberlite_page_icon" name="memberlite_page_icon">';
			echo '<option value="blank" ' . selected( $memberlite_page_icon, "blank" ) . '>- Select -</option>';
			foreach($fontawesome_icons as $fontawesome_icon)
			{			
				echo '<option value="' . $fontawesome_icon . '"' . selected( $memberlite_page_icon, $fontawesome_icon ) . '>' . $fontawesome_icon . '</option>';
			}
	echo '</select></p>';
	echo '<input type="hidden" name="memberlite_banner_icon_present" value="1" />';
	echo '<p style="margin: 1rem 0 0 0;"><label for="memberlite_banner_icon" class="selectit"><input name="memberlite_banner_icon" type="checkbox" id="memberlite_banner_icon" value="1" '. checked( $memberlite_banner_icon, 1, false) .'>' . __('Show Icon in Banner Title', 'memberlite-elements') . '</label></p>';
	if(($memberlite_page_template == 'templates/landing.php') && function_exists('pmpro_getAllLevels'))
	{
		echo '<hr />';
		echo '<h2>' . __('Landing Page Settings', 'memberlite-elements') . '</h2>';
		$membership_levels = pmpro_getAllLevels();
		if(empty($membership_levels))
			echo '<div class="inline notice error"><p><a href="' . admin_url('admin.php?page=pmpro-membershiplevels') . '">Add a Membership Level to Use These Landing Page Features &raquo;</a></p>';
		else
		{
			echo '<table class="form-table"><tbody>';
			echo '<tr><th scope="row">' . __('Membership Level', 'memberlite-elements') . '</th>';
			echo '<td><label class="screen-reader-text" for="pmproal_landing_page_level">';
				_e('Landing Page Membership Level', 'memberlite-elements');
			echo '</label>';
			echo '<select id="pmproal_landing_page_level" name="pmproal_landing_page_level">';
			echo '<option value="" ' . selected( $pmproal_landing_page_level, "" ) . '>- Select -</option>';
			foreach($membership_levels as $level)
			{			
				echo '<option value="' . $level->id . '"' . selected( $pmproal_landing_page_level, $level->id ) . '>' . $level->name . '</option>';
			}
			echo '</select></td></tr>';	
			echo '<tr><th scope="row">' . __('Checkout Button Text', 'memberlite-elements') . '</th>';
			echo '<td><label class="screen-reader-text" for="memberlite_landing_page_checkout_button">';
				_e('Checkout Button Text', 'memberlite-elements');
			echo '</label>';
			echo '<input type="text" id="memberlite_landing_page_checkout_button" name="memberlite_landing_page_checkout_button" value="' . $memberlite_landing_page_checkout_button . '"> <em>(default: "Select")</em></td></tr>';
			echo '<tr><th scope="row">' . __('Membership Level Upsell', 'memberlite-elements') . '</th>';
			echo '<td><label class="screen-reader-text" for="memberlite_landing_page_upsell">';
				_e('Landing Page Membership Level Upsell', 'memberlite-elements');
			echo '</label>';
			echo '<select id="memberlite_landing_page_upsell" name="memberlite_landing_page_upsell">';
			echo '<option value="" ' . selected( $memberlite_landing_page_upsell, "" ) . '>- Select -</option>';
			foreach($membership_levels as $level)
			{			
				echo '<option value="' . $level->id . '"' . selected( $memberlite_landing_page_upsell, $level->id ) . '>' . $level->name . '</option>';
			}
			echo '</select></td></tr>';
			echo '</tbody></table>';
		}
	}
}

/* Save custom sidebar selection */
function memberlite_elements_settings_save_meta_box_data( $post_id ) {
	global $allowedposttags;
	
	if(!isset($_POST['memberlite_elements_settings_meta_box_nonce'])) {
		return;
	}
	if(!wp_verify_nonce($_POST['memberlite_elements_settings_meta_box_nonce'], 'memberlite_elements_settings_meta_box')) {
		return;
	}
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if ( isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} 
	else
	{
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}
	
	//banner show radio
	if(isset($_POST['memberlite_banner_show'])) {
		if(!empty($_POST['memberlite_banner_show']))
			$memberlite_banner_show = 1;
		else
			$memberlite_banner_show = 0;
		update_post_meta($post_id, '_memberlite_banner_show', $memberlite_banner_show);
	}
	
	//banner description
	if(isset($_POST['memberlite_banner_desc'])) {
		$memberlite_banner_desc = wp_kses( wp_unslash( $_POST['memberlite_banner_desc'] ), $allowedposttags );
		update_post_meta($post_id, '_memberlite_banner_desc', $memberlite_banner_desc);
	}
		
	//banner hide title checkbox	
	if(isset($_POST['memberlite_banner_hide_title_present'])) {
		if(!empty($_POST['memberlite_banner_hide_title']))
			$memberlite_banner_hide_title = 1;
		else
			$memberlite_banner_hide_title = 0;
			
		update_post_meta($post_id, '_memberlite_banner_hide_title', $memberlite_banner_hide_title);
	}
	
	//banner hide breadcrumbs checkbox
	if(isset($_POST['memberlite_banner_hide_breadcrumbs_present']))	{
		if(!empty($_POST['memberlite_banner_hide_breadcrumbs']))
			$memberlite_banner_hide_breadcrumbs = 1;
		else
			$memberlite_banner_hide_breadcrumbs = 0;
			
		update_post_meta($post_id, '_memberlite_banner_hide_breadcrumbs', $memberlite_banner_hide_breadcrumbs);
	}
	
	//banner extra padding checkbox
	if(isset($_POST['memberlite_banner_extra_padding_present']))	{
		if(!empty($_POST['memberlite_banner_extra_padding']))
			$memberlite_banner_extra_padding = 1;
		else
			$memberlite_banner_extra_padding = 0;
			
		update_post_meta($post_id, '_memberlite_banner_extra_padding', $memberlite_banner_extra_padding);
	}
	
	//banner right content
	if(isset($_POST['memberlite_banner_right'])) {
		$memberlite_banner_right = wp_kses( wp_unslash( $_POST['memberlite_banner_right'] ), $allowedposttags );
		
		update_post_meta($post_id, '_memberlite_banner_right', $memberlite_banner_right);
	}
	
	//banner bottom content
	if(isset($_POST['memberlite_banner_bottom'])) {
		$memberlite_banner_bottom = wp_kses( wp_unslash( $_POST['memberlite_banner_bottom'] ), $allowedposttags );
		
		update_post_meta($post_id, '_memberlite_banner_bottom', $memberlite_banner_bottom);
	}
	
	//page icon
	if(isset($_POST['memberlite_page_icon'])) {
		$memberlite_page_icon = sanitize_text_field($_POST['memberlite_page_icon']);
		
		update_post_meta($post_id, '_memberlite_page_icon', $memberlite_page_icon);
	}
	
	//page icon in banner right checkbox
	if(isset($_POST['memberlite_banner_icon_present']))	{
		if(!empty($_POST['memberlite_banner_icon']))
			$memberlite_banner_icon = 1;
		else
			$memberlite_banner_icon = 0;
			
		update_post_meta($post_id, '_memberlite_banner_icon', $memberlite_banner_icon);
	}	
	
	//landing page level
	if(isset($_POST['pmproal_landing_page_level'])) {
		$pmproal_landing_page_level = intval($_POST['pmproal_landing_page_level']);
		
		update_post_meta($post_id, '_pmproal_landing_page_level', $pmproal_landing_page_level);
	}
	
	//landing page checkout button
	if(isset($_POST['memberlite_landing_page_checkout_button'])) {
		$memberlite_landing_page_checkout_button = sanitize_text_field($_POST['memberlite_landing_page_checkout_button']);
		
		update_post_meta($post_id, '_memberlite_landing_page_checkout_button', $memberlite_landing_page_checkout_button);
	}
	
	//landing page upsell content
	if(isset($_POST['memberlite_landing_page_upsell'])) {
		$memberlite_landing_page_upsell = intval($_POST['memberlite_landing_page_upsell']);
		
		update_post_meta($post_id, '_memberlite_landing_page_upsell', $memberlite_landing_page_upsell);
	}	
}
add_action('save_post', 'memberlite_elements_settings_save_meta_box_data');

/* Add Banner Image Setting meta box */
function memberlite_elements_featured_image_meta( $content, $post_id ) {
	if(has_post_thumbnail( $post_id) )
	{
		$id = '_memberlite_show_image_banner';
		$value = esc_attr( get_post_meta( $post_id, $id, true ) );
		$label = '<hr /><label for="' . $id . '" class="selectit"><input name="' . $id . '" type="checkbox" id="' . $id . '" value="' . $value . ' "'. checked( $value, 1, false) .'>' . __('Show as Banner Image', 'memberlite-elements') . '</label>';
		if( class_exists( 'MultiPostThumbnails' ) ) {
			$label .= '<p class="howto">' . __( 'If a banner image is set below, it will override this setting.', 'memberlite-elements' ) . '</p>';
		}
		return $content .= $label;
	}
	else
		return $content;
}
add_filter( 'admin_post_thumbnail_html', 'memberlite_elements_featured_image_meta', 10, 2 );

/* Save Setting in Featured Images meta box */
function memberlite_elements_save_featured_image_meta( $post_id, $post, $update ) {  
	$value = 0;
	if ( isset( $_REQUEST['_memberlite_show_image_banner'] ) ) {
		$value = 1;
	}
	// Set meta value to either 1 or 0
	update_post_meta( $post_id, '_memberlite_show_image_banner', $value );
}
add_action( 'save_post', 'memberlite_elements_save_featured_image_meta', 10, 3 );

function memberlite_elements_display_banner_bottom( ) {
	global $post;
	if( !empty( $post ) && !empty( $post->ID ) ) {
		$memberlite_banner_bottom = get_post_meta( $post->ID, '_memberlite_banner_bottom', true );
	} else {
		$memberlite_banner_bottom = false;
	}
	if( !empty( $memberlite_banner_bottom ) ) { ?>
		<div id="banner_bottom">
			<div class="row"><div class="large-12 columns">
				<?php echo apply_filters( 'the_content', $memberlite_banner_bottom ); ?>
			</div></div><!-- .row .columns --> 
		</div><!-- #banner_bottom -->
	<?php }
}
add_action( 'memberlite_after_content', 'memberlite_elements_display_banner_bottom' );

