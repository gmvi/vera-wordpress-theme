<?php
/*
Plugin Name: The Vera Project Gallery Shows
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function vera_gallery_init() {
  // register_post_type must be called after the 'after_setup_theme' hook
  register_post_type( 'gallery_exhibit',
    array(
      'labels' => array(
        'name' => __( 'Gallery Exhibits' ),
        'singular_name' => __( 'Gallery Exhibit' ),
        'add_new_item' => __( 'Add New Gallery Exhibit'),
        'edit_item' => __( 'Edit Gallery Exhibit'),
        'new_item' => __('New Gallery Exhibit'),
        'view_item' => __('View Gallery Exhibit'),
        'search_items' => __('Search Gallery Exhibit'),
        'not_found' => __('No gallery exhibits found'),
        'not_found_in_trash' => __('No gallery exhibits found in Trash'),
      ),
      'public' => true,
      'show_in_nav_menus' => false,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-art',
      'supports' => array('title', 'editor', 'thumbnail'),
      'rewrite' => array(
        'slug' => 'artgallery/shows',
        'with_front' => false,
      ),
    )
  );
}
add_action( 'init', 'vera_gallery_init' );

/**
 * Init for MEM plugin
 */
function vera_gallery_mem_settings() {
  mem_plugin_settings( array( 'gallery_exhibit' ), 'full' );
}
add_action( 'mem_init', 'vera_gallery_mem_settings' );

?>
