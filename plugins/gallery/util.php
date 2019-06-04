<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


// returns current show, up next show, and all previous shows
// for the gallery page
function vera_gallery_get_overview() {
	$gallery_overview = array();
	//TODO: review - is there something we can do to avoid having to make 3 separate queries?

	// get gallery items marked with "current gallery"
	$curr_gallery = new WP_Query(array(
		'post_type' => GALLERY_TYPE,
		'post_status' => 'published',
		'posts_per_page' => 1,
		'meta_query' => array(
			array(
				'key' => 'current_gallery',
				'value' => true
			),
		),
	));


	if ($curr_gallery->have_posts()) {
		$gallery_overview['current'] = $curr_gallery->posts[0];
	}

	// get gallery items marked with "current gallery"
	$up_next_gallery = new WP_Query(array(
		'post_type' => GALLERY_TYPE,
		'post_status' => 'published',
		'posts_per_page' => 1,
		'meta_query' => array(
			array(
				'key' => 'up_next_gallery',
				'value' => true
			),
		),
	));

	if ($up_next_gallery->have_posts()) {
		$gallery_overview['up_next'] = $up_next_gallery->posts[0];
	}


	// get all previous gallery shows, sorted by end date from most recent to oldest
	$old_galleries = new WP_Query(array(
		'post_type' => GALLERY_TYPE,
		'post_status' => 'published',
		'posts_per_page' => -1, //TODO: maybe they want to limit this?
		'meta_query' => array(
			array(
				'key' => 'gallery_end_date',
				'compare' => '<',
				'value' => current_time('Ymd'),
			),
		),
	));

	if ($old_galleries->have_posts()) {
		$gallery_overview['past'] = $old_galleries->posts;
	}

	return $gallery_overview;
}