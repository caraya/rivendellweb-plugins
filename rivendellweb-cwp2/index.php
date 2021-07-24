<?php
/**
 * Plugin Name
 *
 * @author            Carlos Araya
 * @copyright         2021 Carlos Araya
 * @license           MIT
 *
 * @wordpress-plugin
 * Plugin Name:       Add Core Web Vitals
 * Plugin URI:        https://publishing-project.rivendellweb.net
 * Description:       Add Core Web Vitals to the site
 * Version:           1.0.0
 * Requires at least: 5.6
 * Requires PHP:      7.0
 * Author:            Carlos Araya
 * Author URI:        https://example.com
 * Text Domain:       rivendellweb-cwv
 * License:           MIT
 * License URI:       https://caraya.mit-license.org/
 */

$handle = 'google_gtagjs';
$list = 'enqueued';
// Property ID
$tag_id = 'UA-XXXXXXXX-X';
$url = 'https://www.googletagmanager.com/gtag/js?id=' . rawurlencode( $tag_id );


if (! wp_script_is( $handle, $list )) {
    wp_enqueue_script( $handle, $url, array(), null, false, 100 );
    wp_script_add_data( $handle, 'script_execution', 'async' );
    wp_add_inline_script( $handle, 'window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}' );
} else {
    return;
}

// Enqueue the web vitals script
wp_enqueue_script(
  'web-vitals', 
  'https://unpkg.com/web-vitals?module',
  array(),
  null,
  true );

function web_vitals_init() {
echo '<script type="module">
import {getCLS, getFID, getLCP} from "https://unpkg.com/web-vitals?module";

function sendToGoogleAnalytics({name, delta, id}) {
  gtag("event", name, {
    event_category: "Web Vitals",
    event_label: id,
    value: Math.round(name === "CLS" ? delta * 1000 : delta),
    non_interaction: true,
  });
}

getCLS(sendToGoogleAnalytics);
getFID(sendToGoogleAnalytics);
getLCP(sendToGoogleAnalytics);
</script>';
}

add_action( 'wp_footer', 'web_vitals_init' );