<?php
	function rivendellweb_add_meta_box() {
		add_meta_box(
			'rivendellweb_post_options_metabox',
			'Post Options',
			'rivendellweb_post_options_metabox_html',
			'post',
			'normal',
			'default',
			array('__back_compat_meta_box' => true)
		);
	}
	add_action( 'add_meta_boxes', 'rivendellweb_add_meta_box' );


	function rivendellweb_post_options_metabox_html($post) {
	$field_value = get_post_meta($post->ID, '_rivendellweb_text_metafield', true);
	wp_nonce_field( 'rivendellweb_update_post_metabox', 'rivendellweb_update_post_nonce' );
	?>
	<p>
		<label for="rivendellweb_text_metafield"><?php esc_html_e( 'Text Custom Field', 'textdomain' ); ?></label>
		<br />
		<input class="widefat" type="text" name="rivendellweb_text_metafield" id="rivendellweb_text_metafield" value="<?php echo esc_attr( $field_value ); ?>" />
	</p>
	<?php
	}

	function rivendellweb_save_post_metabox($post_id, $post) {
	$edit_cap = get_post_type_object( $post->post_type )->cap->edit_post;
	if( !current_user_can( $edit_cap, $post_id )) {
		return;
	}
	if( !isset( $_POST['rivendellweb_update_post_nonce']) || !wp_verify_nonce( $_POST['rivendellweb_update_post_nonce'], 'rivendellweb_update_post_metabox' )) {
		return;
	}
	if(array_key_exists('rivendellweb_text_metafield', $_POST)) {
		update_post_meta(
		$post_id,
		'_rivendellweb_text_metafield',
		sanitize_text_field($_POST['rivendellweb_text_metafield'])
		);
	}
	}
	add_action( 'save_post', 'rivendellweb_save_post_metabox', 10, 2 );
