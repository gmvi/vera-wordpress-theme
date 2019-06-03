<?php
/*
Plugin Name: The Vera Project Classes
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define('GALLERY_TYPE', 'galleries');


//TODO: make it so that you can edit up next and current gallery in quick edit (checkout commit c0b0ef5)

/*** Register gallery post type ***/
add_action( 'init', 'vera_gallery_init' );

function vera_gallery_init() {
	register_post_type( 'galleries',

		array(
			'labels' => array(
				'name' => __( GALLERY_TYPE ),
				'singular_name' => __( 'Gallery' ),
				'menu_name' => __( 'Gallery' ),
				'add_new_item' => __( 'Add New Gallery' ),
				'edit_item' => __( 'Edit Gallery' ),
				'new_item' => __( 'New Gallery' ),
				'view_item' => __( 'View Gallery' ),
				'search_items' => __( 'Search Galleries' ),
				'not_found' => __( 'No galleries found' ),
				'not_found_in_trash' => __( 'No galleries found in Trash' ),
			),
			'capability_type' => 'post',
			'menu_icon' => 'dashicons-art',
			'public' => true,
			'supports' => array( 'thumbnail', 'title', 'editor' ),
			'publicly_queryable' => true,
			'has_archive' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'exclude_from_search' => false
		)
	);
}

// before all gallery queries, sort by ascending end date if orderby is omitted
add_action( 'pre_get_posts', 'gallery_end_date_sort' );
function gallery_end_date_sort($query) {

	if ($query->get('post_type') == GALLERY_TYPE
	    && $query->get('orderby') == ''
	    && $query->get('meta_key') == '') {

			if ($query->get('order') == '') {
				$query->set('order', 'asc');
			}

			$query->set('orderby', 'meta_value_num');
			$query->set('meta_key', 'gallery_end_date');

			error_log('apparently sorting the gallery query');
	}
}

// add Current Gallery and Up Next Gallery fields to row display
add_filter( 'manage_galleries_posts_columns', 'vera_galleries_columns' );
function vera_galleries_columns( $columns ) {
	$columns['current_gallery'] = "Current Gallery";
	$columns['up_next_gallery'] = "Up Next Gallery";
	return $columns;
}

//configure fields to display properly in columns
add_action( 'manage_galleries_posts_custom_column' , 'vera_galleries_column', 10, 2 );
function vera_galleries_column( $column, $post_id ) {
	switch ($column) {
		case 'current_gallery':
			$is_current_gallery = get_field('current_gallery', $post_id);
			if ($is_current_gallery) {
				echo '✔';
			} else {
				echo '✗';
			}
			break;
		case 'up_next_gallery':
			$up_next_gallery = get_field('up_next_gallery', $post_id);
			if ($up_next_gallery) {
				echo '✔';
			} else {
				echo '✗';
			}
			break;
	}
}

//change the column width so up next and current isn't so huge
add_action('admin_head', 'custom_gallery_column_width');
function custom_gallery_column_width() {
	echo '<style type="text/css">';
	echo '.column-current_gallery { width:15% !important; overflow:hidden }';
	echo '.column-up_next_gallery { width:15% !important; overflow:hidden }';
	echo '</style>';
}


include 'util.php';