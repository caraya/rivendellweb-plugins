<?php
/**
 * Plugin Name:       Metabox Sidebar
 * Description:       Example block written with ESNext standard and JSX support – build step required.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Carlos Araya
 * License:           MIT
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       metabox-sidebar
 *
 * @package           rivendellweb
 */
if( ! defined( 'ABSPATH') ) {
    exit;
}

include_once( 'src/compat.php' );

function rivendellweb_register_meta() {
	register_meta('post', '_rivendellweb_text_metafield', array(
		'show_in_rest' => true,
		'type' => 'string',
		'single' => true,
		'sanitize_callback' => 'sanitize_text_field',
		'auth_callback' => function() {
			  return current_user_can('edit_posts');
		}
	));
}
add_action('init', 'rivendellweb_register_meta');

function rivendellweb_enqueue_assets() {
	wp_enqueue_script(
	  'metabox-sidebar',
	  plugins_url( 'build/index.js', __FILE__ ),
	  array(
		  'wp-plugins',
		  'wp-edit-post',
		  'wp-i18n',
		  'wp-components',
		  'wp-data',
		  'wp-element' )
	);
  }

add_action( 'enqueue_block_editor_assets', 'rivendellweb_enqueue_assets' );
