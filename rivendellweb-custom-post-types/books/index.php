<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * Registers a genre taxonomy for the book custom post type.
 * add REST API support
 *
*/

function rivendellweb_custom_book_genre_tax() {
  $tax_labels = array(
    'name'          => 'Genres',
    'singular_name' => 'Genre',
    'search_items'  => 'Search Genres',
    'edit_item'     => 'Edit Genre',
    'add_new_item'  => 'Add New Genre'
  );
  
  $args = array(
    'labels' => $tax_labels,
    'show_in_rest' => true,
    'hierarchical' => true,
    'query_var'    => true,
    'rewrite' => array( 'has_front' => true ),
    'menu_icon' => 'dashicons-building',
    'supports' => array( 'title', 'editor', 'thumbnail' ),
    );
  register_taxonomy('genre', 'book', $args); // type taxonomy
}
add_action( 'init', 'rivendellweb_custom_book_genre_tax', 0 );

/**
 * Register a book post type, with REST API support
 *
 * See https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-rest-api-support-for-custom-content-types/
 * and https://developer.wordpress.org/reference/functions/add_post_type_support/
*/
function rivendellweb_custom_book_type() {
    $labels = array( 
      'name' => __( 'Books', RWPDOMAIN ),
      'singular_name' => __( 'Book', RWPDOMAIN ),
      'featured_image' => __( 'Book Cover', RWPDOMAIN ),
      'set_featured_image' => __( 'Set Book Cover', RWPDOMAIN ),
      'remove_featured_image' => __( 'Remove Cover', RWPDOMAIN ),
      'use_featured_image' => __( 'Use Cover', RWPDOMAIN ),
      'archives' => __( 'Book Collection', RWPDOMAIN ),
      'add_new' => __( 'Add New Book', RWPDOMAIN ),
      'add_new_item' => __( 'Add New Book', RWPDOMAIN ),
    );

    $args = array(
      'labels'       => $labels,
      'public'       => true,
      'has_archive'  => 'books',
      'rewrite'      => array( 'has_front' => true ),
      'menu_icon'    => 'dashicons-book',
      'supports'     => array( 'title', 'editor', 'thumbnail' ),
      // Line below makes CPT available in rest
      // Line below makes CPT use Gutenberg/Block editor
      'show_in_rest' => true,
      // 'taxonomies' => 
    );

    register_post_type( 'book', $args );
}
add_action( 'init', 'rivendellweb_custom_book_type' );
?>
