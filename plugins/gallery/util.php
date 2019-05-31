<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


// returns current show, up next show, and all previous shows
// for the gallery page

// TODO: ask Jessica if gallery shows will overlap - will affect if we need to do multiple queries...
function vera_gallery_get_overview() {


	// get 1 current show that ends soonest
	// get 1 upcoming show
	// get
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