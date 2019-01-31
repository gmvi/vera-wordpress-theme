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

// make shows queries sort by date by default
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

// get shows to display on the front page. returns a list of post IDs for one featured show and four upcoming shows
function vera_shows_get_front_page() {
  $shows = array();
  // first query: get next featured show
  $query = new WP_Query(array(
    'post_type' => 'shows',
    'post_status' => 'published',
    'posts_per_page' => 1,
    'meta_query' => array(
      array(
        'key' => 'date',
        'compare' => '>=',
        'value' => current_time('Ymd'),
      ),
      array(
        'key' => 'is_featured',
        'value' => '1',
      ),
    ),
  ));
  if ($query->have_posts()) {
    array_push($shows, $query->posts[0]);
  }
  // second query: get next 4 shows that aren't the featured show
  $query = new WP_Query(array(
    'post_type' => 'shows',
    'post_status' => 'published',
    'post__not_in' => array($shows[0]->ID),
    'posts_per_page' => count($shows)?4:5,
    'meta_query' => array(
      array(
        'key' => 'date',
        'compare' => '>=',
        'value' => current_time('Ymd'),
      ),
    ),
  ));
  if ($query->have_posts()) {
    $shows = array_merge($shows, $query->posts);
  }
  return array_slice($shows, 0, 5);
}

function vera_shows_get_all_info($show) {
  $id = is_object($show)?$show->ID:$show;
  $is_featured = get_field('is_featured', $id);
  $presenter_info = get_field('presenter', $id);
  $venue = get_field('venue', $id);
  $image = get_the_post_thumbnail_url($id);
  if (!$image) $image = get_field('featured_image_url', $id);
  return array(
    'label' => $is_featured=='1'?"Featured Show":"Next Show",
    'image' => $image,
    'title' => is_object($show)?$show->post_title:get_the_title($id),
    'support' => get_field('support', $id),
    'sold_out' => get_field('sold_out', $id)=='1',
    'presenter' => ($presenter_info?$presenter_info:"The Vera Project Presents"),
    'venue' => $venue?$venue:"The Vera Project",
    'date' => get_field('date', $id),
    'time' => get_field('time', $id),
    'price' => get_field('price', $id),
    'link' => get_field('link', $id),
  );
}

function vera_shows_get_list_info($show) {
  $id = is_object($show)?$show->ID:$show;
  return array(
    'presenter' => ($presenter_info?$presenter_info:"The Vera Project Presents"),
    'title' => is_object($show)?$show->post_title:get_the_title($id),
    'support' => get_field('support', $id),
    'sold_out' => get_field('sold_out', $id)=='1',
    'venue' => get_field('venue', $id),
    'date' => get_field('date', $id),
    'link' => get_field('link', $id),
  );
}

add_filter( 'manage_shows_posts_columns', 'vera_shows_columns' );
function vera_shows_columns( $columns ) {
  $columns['show_date'] = "Show Date";
  $columns['featured'] = "Featured?";
  // move the Edit Date column to the far right
  unset($columns['date']);
  $columns['date'] = "Edit Date";
  return $columns;
}

add_action( 'manage_shows_posts_custom_column' , 'vera_shows_column', 10, 2 );
function vera_shows_column( $column, $post_id ) {
  switch ($column) {
    case 'show_date':
      echo get_field('date', $post_id).'<br>';
      break;
    case 'featured':
      echo get_field('is_featured', $post_id)=='1'?'✔':'✗';
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
