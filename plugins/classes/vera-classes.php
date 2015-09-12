<?php
/*
Plugin Name: The Vera Project Classes
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*** Register class post type and class_category taxonomy ***/
function vera_classes_init() {
  // register_post_type must be called after the 'after_setup_theme' hook
  // register_taxonomy( 'class_category', 'class',
  //   array(
  //     'labels' => array(
  //       'name' => 'Class Categories',
  //       'singular_name' => 'Class Category',
  //       'menu_name' => 'Categories',
  //       'all_items' => 'All Class Categories',
  //       'edit_item' => 'Edit Class Category',
  //       'view_item' => 'View Class Category',
  //       'update_item' => 'Update Class Category',
  //       'add_new_item' => 'Add New Class Category',
  //       'new_item_name' => 'New Class Category Name',
  //       'search_items' => 'Search Class Categories',
  //       'not_found' => 'No class categories found',
  //     ),
  //     'public' => false,
  //     'show_ui' => true,
  //     'show_tagcloud' => false,
  //     'show_admin_column' => true,
  //     'hierarchical' => true,
  //     'sort' => true,
  //     'rewrite' => array(
  //       'slug' => false,
  //     ),
  //   )
  // );
  register_post_type( 'class_category',
    array(
      'label' => 'Class Category',
      'public' => false,
      'supports' => array( 'title' ),
      'rewrite' => array(
        'slug' => false
      )
    )
  );
  register_post_type( 'class',
    array(
      'labels' => array(
        'name' => __( 'Classes' ),
        'singular_name' => __( 'Class' ),
        'menu_name' => __( 'Classes [IN DEVELOPMENT]'),
        'add_new_item' => __( 'Add New Class'),
        'edit_item' => __( 'Edit Class'),
        'new_item' => __('New Class'),
        'view_item' => __('View Class'),
        'search_items' => __('Search Classes'),
        'not_found' => __('No classes found'),
        'not_found_in_trash' => __('No classes found in Trash'),
      ),
      'public' => true,
      'show_in_nav_menus' => true,
      'menu_position' => 9,
      'menu_icon' => 'dashicons-book-alt',
      'capability_type' => 'page',
      'supports' => array('title', 'editor', 'excerpt'),
      'rewrite' => array(
        'slug' => '_classes/detail',
        'with_front' => false,
      ),
    )
  );
}
add_action( 'init', 'vera_classes_init' );

/*** Add payment script metabox to class page ***/
function add_classes_metabox() {
  add_meta_box( 'payment_script', 'Payment Script URL', 'classes_payments_metabox_cb', 'class', 'normal' );
  add_meta_box( 'class_category', 'Class Category',     'classes_category_metabox_cb', 'class', 'side' );
}
add_action( 'add_meta_boxes', 'add_classes_metabox' );
function classes_payments_metabox_cb($post) {
  // Add a nonce field so we can check for it later.
  wp_nonce_field( 'classes_save_meta_box_data', 'classes_meta_box_nonce' );
  // Use get_post_meta() to retrieve an existing value
  // from the database and use the value for the form.
  $value = get_post_meta( $post->ID, '_payment_script', true );

  echo '<input type="text" id="classes_payment_script" name="classes_payment_script" value="' . esc_attr( $value ) . '" size="80" />' .
       '<p>If provided, the payment script will be embedded at the end of the page.</p>';
}
function classes_category_metabox_cb( $post ) {
  // Pretty sure I only need one nonce.
  // Use get_post_meta() to retrieve an existing value
  // from the database and use the value for the form.
  $value = get_post_meta( $post->ID, '_category', true );
  $categories = (new WP_Query( array('post_type' => 'class_category') ))->posts;
  echo '<ul class="form-no-clear">';
  foreach ($categories as $category) {
    $checked = $value == $category->post_name ? " checked" : "";
    echo '<li><label><input type="radio" name="class_category" value="' . $category->post_name . '"' .
         $checked . '>' . $category->post_title . '</label></li>';
  }
  $checked = $value == "" ? " checked" : "";
  echo '<li><label><input type="radio" name="class_category" value=""'. $checked . '>Other</label></li></ul>';
}
function classes_save_meta_box_data( $post_id ) {
  // We need to verify this came from our screen and with proper authorization,
  // because the save_post action can be triggered at other times.

  // Check if our nonce is set.
  if ( !isset($_POST['classes_meta_box_nonce']) ) {
    return;
  }
  // Verify that the nonce is valid.
  if ( !wp_verify_nonce($_POST['classes_meta_box_nonce'], 'classes_save_meta_box_data') ) {
    return;
  }
  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
    return;
  }
  // Check the user's permissions.
  if ( !current_user_can('edit_page', $post_id) ) {
    return;
  }
  // Make sure that the fields are set
  if ( !isset($_POST['classes_payment_script']) || !isset($_POST['class_category'])) {
    return;
  }
  // Sanitize user input.
  $payment_script = sanitize_text_field( $_POST['classes_payment_script'] );
  $class_category = sanitize_text_field( $_POST['class_category'] );
  // Update the meta field in the database.
  update_post_meta( $post_id, '_payment_script', $payment_script );
  update_post_meta( $post_id, '_category', $class_category );
}
add_action( 'save_post', 'classes_save_meta_box_data' );

function vera_classes_content_filter($content) {
  /* This filter adds the payment script to the content */
  global $post;
  if ( get_post_type() == "class" ) {
    // append payment stuff
    $payment_script = get_post_meta( $post->ID, '_payment_script', true);

    if ( !empty($payment_script) ) {
      $content = sprintf(
          '%s<br/><br/>' . 
          '<i>(Please wait while the payment information loads below)</i>' .
          '<br/><br/><br/>' .
          '<script type="text/javascript" src="%s"></script>',
          $content,
          $payment_script
      );
    }
  }
  return $content;
}
add_filter('the_content', 'vera_classes_content_filter');

// /* make sorting by menu_order also group by class_category */
// function set_classes_admin_default_order($wp_query) {
//   if (is_admin()) {
//     $post_type = $wp_query->query['post_type'];
//     if ( $post_type == 'class' && $wp_query->get('orderby') == '' ) {
//       $wp_query->set('orderby', 'menu_order');
//       $wp_query->set('order', 'ASC');
//     }
//   }
// }
// add_filter('pre_get_posts', 'set_classes_admin_default_order');
//
// /*** remove 'Sort By Order' view introduced by the 'Simple Page Ordering' plugin ***/
// function vera_classes_remove_order_view($views) {
//   unset($views['byorder']);
//   return $views;
// }
// add_filter( 'views_edit-class', 'vera_classes_remove_order_view', 11 ); 

/*** Add admin scripts ***/
function vera_classes_enqueue_admin_scripts($hook) {
  global $post;
  if ( isset($post) && $post->post_type == 'class' ) {
    if ( $hook == 'edit.php' ) {
      wp_enqueue_script( 'vera_classes_edit', plugin_dir_url( __FILE__ ) . 'js/admin-view-classes.js', true );
    } else if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
      wp_enqueue_script( 'vera_classes_post', plugin_dir_url( __FILE__ ) . 'js/admin-edit-class.js', true );
    }
  }

}
add_action( 'admin_enqueue_scripts', 'vera_classes_enqueue_admin_scripts' );

?>
