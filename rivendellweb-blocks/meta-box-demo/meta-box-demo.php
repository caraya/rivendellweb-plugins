<?php
/**
 * Plugin Name:       Meta Box Demo
 * Description:       Example block written with ESNext standard and JSX support – build step required.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Carlos Araya
 * License:           MIT
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       meta-box-demo
 *
 * @package           rivendellweb
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
register_post_meta(
	'post',
	'_my_data',
	[
		'show_in_rest' => true,
		'single'       => true,
		'type'         => 'string',
		'auth_callback' => function() {
			return current_user_can( 'edit_posts' );
		}
	]
);

function rivendellweb_enqueue() {
	wp_enqueue_script(
			'rivendellweb-script',
			plugins_url( 'build/index.js', __FILE__ ),
			array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-data', 'wp-core-data', 'wp-block-editor' )
	);
}
add_action( 'enqueue_block_editor_assets', 'rivendellweb_enqueue' );
