<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


// returns current show, up next show, and all previous shows
// for the gallery page
function vera_gallery_get_overview() {

	// get gallery marked as "current gallery"
	// get gallery marked as "up next"
	// get all previous gallery shows
	$query = new WP_Query(array(
		'post_type' => GALLERY_TYPE,
		'post_status' => 'published',
		//TODO: need to add order by

//		'posts_per_page' => 1,
		'meta_query' => array(
			'relation' => 'OR',
			//gallery currently showing
			array(
				'relation' => 'AND',
				array(
					'key' => 'gallery_opening_datetime', //this field straight from acf
					'compare' => '<=',
					'value' => current_time('Ymd'),
				),
				array(
					'key' => 'gallery_end_date', //this field straight from acf
					'compare' => '>=',
					'value' => current_time('Ymd'),
				),
			),
			array(
				'key' => 'gallery_end_date', //this field straight from acf
				'compare' => '>=',
				'value' => current_time('Ymd'),
			),
		),
	));

	if ($query->have_posts()) {
		array_push($shows, $query->posts[0]);
	}
}