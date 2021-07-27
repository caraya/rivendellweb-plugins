<?php
/**
 * Plugin Name
 *
 * @author            Carlos Araya
 * @copyright         2021 Carlos Araya
 * @license           MIT
 *
 * @wordpress-plugin
 * Plugin Name:       AWESOME PLUGIN
 * Plugin URI:        https://publishing-project.rivendellweb.net
 * Description:       AWESOME PLUGIN DESCRIPTION
 * Version:           1.0.0
 * Requires at least: 5.6
 * Requires PHP:      7.0
 * Author:            Carlos Araya
 * Author URI:        https://example.com
 * Text Domain:       rivendellweb-cwv
 * License:           MIT
 * License URI:       https://caraya.mit-license.org/
 */

// Die if called directly
defined( 'ABSPATH' ) or die( 'Nope, not accessing this directly, punk' );

// Only run this code if the class doesn't already exist.
if ( ! class_exists( 'AwesomePlugin' ) ) {
  class AwesomePlugin {

    /**
     * Constructor
     */
    public function __construct() {
        $this->setup_actions();
    }

    /**
     * Setting up Hooks
     */
    public function setup_actions() {
        //Main plugin hooks
        register_activation_hook(
          __FILE__,
          array( 'AwesomePlugin', 'activate' )
        );
        register_deactivation_hook(
          __FILE__,
          array( 'AwesomePlugin', 'deactivate' )
        );
    }

    /**
     * Activate callback
     */
    public static function activate() {
        //Activation code in here
    }

    /**
     * Deactivate callback
     */
    public static function deactivate() {
        //Deactivation code in here
    }
}

  // instantiate the plugin class
  $wp_plugin_template = new AwesomePlugin();
}
