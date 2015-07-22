<?php
/**
 * The Vera Project Theme Customizer
 *
 * @package The Vera Project
 */

/***
  * All code below prevents access or hides the WordPress Customizer
  * https://codex.wordpress.org/Theme_Customization_API
***/
function vera_customize() {
  // Disallow acces to an empty editor
  wp_die( sprintf( __( 'No WordPress Theme Customizer support - If needed check your functions.php' ) ) . sprintf( '<br /><a href="javascript:history.go(-1);">Go back</a>' ) );
}
add_action( 'load-customize.php', 'vera_customize' );

// Remove 'Customize' from Admin menu
function remove_submenus() {
  global $submenu;
  // Appearance Menu
  unset($submenu['themes.php'][6]); // Customize
}
add_action('admin_menu', 'remove_submenus');

// Remove 'Customize' from the Toolbar -front-end
function remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('customize');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

// Add Custom CSS to Back-end head
function vera_admin_css() {
  echo '<style type="text/css">#customize-current-theme-link { display:none; } </style>';
}
add_action('admin_head', 'vera_admin_css');