<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

function rivendellweb_custom_glossary_type() {
  $labels = array( 
    'name' => __( 'Glossary Entries', RWPDOMAIN ),
    'singular_name' => __( 'Glossary Entry', RWPDOMAIN ),
    'featured_image' => __( 'Entry Image', RWPDOMAIN ),
    'set_featured_image' => __( 'Set Entry Image', RWPDOMAIN ),
    'remove_featured_image' => __( 'Remove Entry Image', RWPDOMAIN ),
    'use_featured_image' => __( 'Use Glosary Entry Image', RWPDOMAIN ),
    'archives' => __( 'Glossary', RWPDOMAIN ),
    'add_new' => __( 'Add Glosary Entry', RWPDOMAIN ),
    'add_new_item' => __( 'Add Glosary Entry', RWPDOMAIN ),
  );

  $args = array(
    'labels'       => $labels,
    'public'       => true,
    'has_archive'  => 'glossary',
    'rewrite'      => array( 'has_front' => true ),
    'menu_icon'    => 'dashicons-book',
    'supports'     => array( 'title', 'editor', 'thumbnail' ),
    // Line below makes CPT available in rest
    // Line below makes CPT use Gutenberg/Block editor
    'show_in_rest' => true,
  );

  register_post_type( 'glossary', $args );
}
add_action( 'init', 'rivendellweb_custom_glossary_type' );
