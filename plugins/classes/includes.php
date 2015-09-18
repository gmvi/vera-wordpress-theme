<?php

// Helper to create a meta_query query for a specific category
function vera_category_query($category) {
  return array(
    'key' => '_category',
    'value' => $category,
    'compare' => empty($category) ? "NOT EXISTS" : "=",
  );
}

function vera_get_classes($category) {
  return get_posts( array(
    'post_type' => 'class',
    'numberposts' => -1,
    'meta_key' => '_order',
    'orderby' => 'meta_value_num ID',
    'order' => 'ASC',
    'meta_query' => array(
      vera_category_query($category),
    ),
  ));
}

function vera_set_default_class_order($post_id, $class_category) {
  $max = get_posts(array(
    'post_type' => 'class',
    'numposts' => 1,
    'meta_key' => '_order',
    'meta_compare' => 'EXISTS',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'meta_query' => array(
      vera_category_query($class_category),
    ),
  ));
  $order = empty($max) ? 0 : get_post_meta($max[0]->ID, '_order', true) + 1;
  update_post_meta( $post_id, '_order', $order );
  return $order;
}

// Extension of WP_List_Table to display a list of classes for a category
class Classes_Order_List_Table extends WP_List_Table {

  public $category;
  public $category_display_name;

  function __construct( $category ) {
    parent::__construct( array(
      'singular'=> 'class',
      'plural' => 'classes',
      'ajax'   => true,
    ) );
    $this->category = $category;
    $this->category_display_name = empty($category) ? "other classes" : $category . " classes";
  }

  function get_columns() {
    return $columns = array(
      'col_class_order' => __('Order'),
      'col_class_title' => __('Title'),
    );
  }

  function prepare_items() {
    $columns = $this->get_columns();
    $hidden = array();
    $sortable = array();
    $this->_column_headers = array($columns, $hidden, $sortable, 'col_class_title');
    $this->items = vera_get_classes($this->category);
    foreach( $this->items as &$item ) {
      $item->order = (int) get_post_meta( $item->ID, "_order", true );
    }
  }

  function column_col_class_title($item) {
    return "<strong class=\"row-title\">$item->post_title</a></strong>"
         . "<p class=\"excerpt\">$item->post_excerpt</p>";
  }

  function column_col_class_order( $item ) {
    return "<div><a class=\"class-order-btn class-order-btn-up dashicons dashicons-arrow-up-alt2\" "
         . "href=\"admin-post.php?action=reorder_classes&class_id=$item->ID&movement=up\"></a></div>"
         . "<div><strong>$item->order</strong></div>"
         . "<div><a class=\"class-order-btn class-order-btn-down dashicons dashicons-arrow-down-alt2\" "
         . "href=\"admin-post.php?action=reorder_classes&class_id=$item->ID&movement=down\"></a></div>";
  }

  function display_tablenav( $which ) {
    // Use the tablenav top section as a secondary header
    switch( $which ) {
      case 'top':
        echo '<h3 style="margin-bottom:5px;">';
        echo ucwords($this->category_display_name) . ' <span class="count">(' . sizeof($this->items) . ')</span>';
        echo '</h3>';
        break;
      case 'bottom':
        break;
      default:
        parent::display_tablenav( $which );
    }
  }
}