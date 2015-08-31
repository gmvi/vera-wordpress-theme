<?php
/*
Plugin Name: The Vera Project
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function the_vera_project_init() {
  // register_post_type must be called after the 'after_setup_theme' hook
  // gallery exhibits
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
  // classes
  register_taxonomy( 'class_category', 'class',
    array(
      'labels' => array(
        'name' => 'Class Categories',
        'singular_name' => 'Class Category',
        'all_items' => 'All Class Categories',
        'edit_item' => 'Edit Class Category',
        'view_item' => 'View Class Category',
        'update_item' => 'Update Class Category',
        'add_new_item' => 'Add New Class Category',
        'new_item_name' => 'New Class Category Name',
        'search_items' => 'Search Class Categories',
        'not_found' => 'No class categories found',
      ),
      'public' => false,
      'show_ui' => true,
      'show_tagcloud' => false,
      'hierarchical' => true,
      'sort' => true,
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
add_action( 'init', 'the_vera_project_init' );

function add_classes_metabox() {
  add_meta_box( 'payment_script', 'Payment Script URL',
    'classes_metabox_callback', 'class', 'normal');
}
add_action( 'add_meta_boxes', 'add_classes_metabox' );

function classes_metabox_callback($post) {
  // Add a nonce field so we can check for it later.
  wp_nonce_field( 'classes_save_meta_box_data', 'classes_meta_box_nonce' );
  // Use get_post_meta() to retrieve an existing value
  // from the database and use the value for the form.
  $value = get_post_meta( $post->ID, '_payment_script', true );

  echo '<input type="text" id="classes_payment_script_field" name="classes_payment_script_field" value="' . esc_attr( $value ) . '" size="80" />' .
       '<p>If provided, the payment script will be embedded at the end of the page.</p>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function classes_save_meta_box_data( $post_id ) {
  /*
   * We need to verify this came from our screen and with proper authorization,
   * because the save_post action can be triggered at other times.
   */

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

  /* OK, it's safe for us to save the data now. */
  // Make sure that it is set.
  if ( !isset($_POST['classes_payment_script_field']) ) {
    return;
  }
  // Sanitize user input.
  $my_data = sanitize_text_field( $_POST['classes_payment_script_field'] );
  // Update the meta field in the database.
  update_post_meta( $post_id, '_payment_script', $my_data );
}
add_action( 'save_post', 'classes_save_meta_box_data' );

function the_vera_project_content_filter($content) {
  /* This filter adds the payment script */
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
add_filter('the_content', 'the_vera_project_content_filter');

/**
 * Init for MEM plugin
 */
function the_vera_project_mem_settings() {
  mem_plugin_settings( array( 'gallery_show' ), 'full' );
}
add_action( 'mem_init', 'the_vera_project_mem_settings' );


?>
