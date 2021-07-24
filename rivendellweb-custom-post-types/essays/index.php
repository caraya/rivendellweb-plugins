<?php
/**
 * Register a essay post type, with REST API support
 *
 * See https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-rest-api-support-for-custom-content-types/
 * and https://developer.wordpress.org/reference/functions/add_post_type_support/
*/
function rivendellweb_custom_essay_type() {
    $args = array(
      'public'       => true,
      'show_in_rest' => true,
      'rest_base'    => 'essays',
      'label'        => 'Essays'
    );
    register_post_type( 'essay', $args );
}
add_action( 'init', 'rivendellweb_custom_essay_type' );