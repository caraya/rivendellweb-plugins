<?php
/*
  Plugin Name: Rivendellweb Custom Post Types
  Plugin URI: https://publishing-project.rivendellweb.net/
  description: Plugin to store custom post types
  Version: 1.0
  Author: Carlos Araya
  Author URI: https://publishing-project.rivendellweb.net/
  License: MIT
  Text Domain:       rivendellweb
  Domain Path:       /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

define( 'RWP_VERSION', '1.0.0' );
define( 'RWPDOMAIN', 'rivendellweb' );

require_once 'books/index.php';
// require_once 'essays/index.php';
require_once 'glossary/index.php';

function my_rewrite_flush() {
    rivendellweb_custom_book_type();
    rivendellweb_custom_glossary_type();
 
    // ATTENTION: 
    // This is *only* done during plugin activation hook 
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'my_rewrite_flush' );
?>
