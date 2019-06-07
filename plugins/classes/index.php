<?php
/*
Plugin Name: The Vera Project Classes
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*** Register class post type and class_category taxonomy ***/
//add_action( 'init', 'vera_classes_init' );
//function vera_classes_init() {
//  register_post_type( 'classes',
//    array(
//      'labels' => array(
//        'name' => __( 'Classes' ),
//        'singular_name' => __( 'Class' ),
//        'menu_name' => __( 'Classes' ),
//        'add_new_item' => __( 'Add New Class' ),
//        'edit_item' => __( 'Edit Class' ),
//        'new_item' => __( 'New Class' ),
//        'view_item' => __( 'View Class' ),
//        'search_items' => __( 'Search Classes' ),
//        'not_found' => __( 'No classes found' ),
//        'not_found_in_trash' => __( 'No classes found in Trash' ),
//      ),
//      'capability_type' => 'post',
//      'menu_icon' => 'dashicons-book-alt',
//      'menu_position' => 9,
//      'public' => false,
//      'publicly_queryable' => true,
//      'show_ui' => true,
//      'show_in_nav_menus' => false,
//      'exclude_from_search' => true,
//      'rewrite' => false,
//    )
//  );
//
//  register_taxonomy( 'class_cat', 'classes',
//    array(
//      'label' => 'Class Categories',
//      'hierarchical' => true,
//      'rewrite' => array(
//        'slug' => 'classes/category'
//      ),
//      'show_in_nav_menus' => false,
//    )
//  );
//}
//
//function vera_classes_page_configuration() {
//  echo '<div class="wrap">';
//  echo '<h2>Classes Page Configuration</h2>';
//  echo '<h3>Under Construction</h3>';
//  echo '</div>';
//}
//
//function vera_classes_admin_init() {
//  add_submenu_page( 'edit.php?post_type=class', 'Classes Page Configuration', 'Classes Page',
//    'read', 'classes_page', 'vera_classes_page_configuration' );
//}
////add_action( 'admin_menu', 'vera_classes_admin_init');
//
//function vera_get_class_cat($id) {
//  $categories = wp_get_post_terms( $id, "class_cat");
//  if (sizeof($categories) == 0) return "other";
//  return $categories[0]->slug;
//}
//
//function vera_get_class_next($id) {
//  $today = date("Y-m-d");
//  foreach (SCF::get('upcoming_dates', $id) as $session) {
//    if ($session["date"] > $today) {
//      return [
//        'date' => $session["date"],
//        'time' => $session["time"],
//        'link' => $session["registration_link"],
//      ];
//    }
//  }
//  return [];
//}

?>
