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
      'supports' => array( 'title', 'editor', 'thumbnail', 'exerpt', 'page-attributes' ),
    )
  );
}

add_action( 'pre_get_posts', 'vera_shows_order_by_date' );
function vera_shows_order_by_date($query) {
  if ($query->get('post_type') == 'shows') {
    if ($query->get('order') == '' && $query->get('meta_key') == '') {
      $query->set('order', 'asc');
      $query->set('orderby', 'meta_value_num');
      $query->set('meta_key', 'date');
    }
  }
}

add_filter( 'manage_shows_posts_columns', 'vera_shows_columns' );
function vera_shows_columns($columns) {
  $columns['show_date'] = "Show Date";
  unset($columns['date']);
  $columns['date'] = "Edit Date";
  return $columns;
}

add_action( 'manage_shows_posts_custom_column' , 'vera_shows_column', 10, 2 );
function vera_shows_column( $column, $post_id ) {
  switch ($column) {
    case 'show_date':
      echo get_field('date', $post_id);
      break;
  }
}

function vera_shows_page_import() {
  echo '<div class="wrap">';
  echo '<h2>Shows Page Configuration</h2>';
  echo '<h3>Under Construction</h3>';
  echo '</div>';
}
function vera_shows_admin_init() {
  add_submenu_page( 'edit.php?post_type=shows', 'Import Shows', 'Import Shows',
    'edit_posts', 'import_shows', 'vera_shows_page_import' );
}
add_action( 'admin_menu', 'vera_shows_admin_init');

?>
