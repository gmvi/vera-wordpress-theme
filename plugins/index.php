<?php
/*
Plugin Name: The Vera Project
*/

// include jQuery, because some plugins require it but don't include it :(
function include_jQuery() {
    if (!is_admin()) {
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'include_jQuery');

// the plugins
include( plugin_dir_path( __FILE__ ) . 'classes/index.php');
include( plugin_dir_path( __FILE__ ) . 'no-taxonomies/index.php');
include( plugin_dir_path( __FILE__ ) . 'gallery/index.php');
