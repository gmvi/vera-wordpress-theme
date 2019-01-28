<?php
/*
Plugin Name: The Vera Project Shows
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*** Register class post type and class_category taxonomy ***/
add_action( 'init', 'vera_shows_init' );
function vera_shows_init() {
  register_post_type( 'shows',
    array(
      'labels' => array(
        'name' => __( 'Shows' ),
        'singular_name' => __( 'Show' ),
        'menu_name' => __( 'Shows' ),
        'add_new_item' => __( 'Add New Show' ),
        'edit_item' => __( 'Edit Show' ),
        'new_item' => __( 'New Show' ),
        'view_item' => __( 'View Show' ),
        'search_items' => __( 'Search Showes' ),
        'not_found' => __( 'No shows found' ),
        'not_found_in_trash' => __( 'No shows found in Trash' ),
      ),
      'capability_type' => 'post',
      'menu_icon' => 'dashicons-tickets-alt',
      'menu_position' => 8,
      'public' => true,
      'exclude_from_search' => true,
      'publicly_queryable' => false,
      'show_in_nav_menus' => false,
      'rewrite' => false,
      'supports' => array( 'title', 'editor', 'thumbnail', 'exerpt' ),
    )
  );
}

function vera_shows_page_configuration() {
  echo '<div class="wrap">';
  echo '<h2>Shows Page Configuration</h2>';
  echo '<h3>Under Construction</h3>';
  echo '</div>';
}

function vera_shows_admin_init() {
  add_submenu_page( 'edit.php?post_type=show', 'Shows Page Configuration', 'Shows Page',
    'read', 'shows_page', 'vera_shows_page_configuration' );
}
//add_action( 'admin_menu', 'vera_classes_admin_init');

?>
