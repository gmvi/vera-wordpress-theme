<?php
/*
Plugin Name: The Vera Project Classes
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*** Register gallery post type ***/
add_action( 'init', 'vera_gallery_init' );

function vera_gallery_init() {
	register_post_type( 'galleries',

		array(
			'labels' => array(
				'name' => __( 'Galleries' ),
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
			'supports' => array( 'thumbnail', 'title', 'editor', 'excerpt' ),
			'publicly_queryable' => true,
			'has_archive' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'exclude_from_search' => false
		)
	);

}

?>
