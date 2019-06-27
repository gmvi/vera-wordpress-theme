<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// get shows to be displed on the front page
// returns a list of post objects with one featured show followed by four upcoming shows
//function vera_shows_get_front_page() {
//  $shows = array();
//  // first query: get next featured show
//  $query = new WP_Query(array(
//    'post_type' => 'shows',
//    'post_status' => 'published',
//    'posts_per_page' => 1,
//    'meta_query' => array(
//      array(
//        'key' => 'date',
//        'compare' => '>=',
//        'value' => current_time('Ymd'),
//      ),
//      array(
//        'key' => 'is_featured',
//        'value' => '1',
//      ),
//    ),
//  ));
//  if ($query->have_posts()) {
//    array_push($shows, $query->posts[0]);
//  }
//  // second query: get next 4 shows that aren't the featured show
//  $query = new WP_Query(array(
//    'post_type' => 'shows',
//    'post_status' => 'published',
//    'post__not_in' => array($shows[0]->ID),
//    'posts_per_page' => count($shows)?4:5,
//    'meta_query' => array(
//      array(
//        'key' => 'date',
//        'compare' => '>=',
//        'value' => current_time('Ymd'),
//      ),
//    ),
//  ));
//  if ($query->have_posts()) {
//    $shows = array_merge($shows, $query->posts);
//  }
//  return array_slice($shows, 0, 5);
//}
//
//// get and format all metadata for a show
//function vera_shows_get_all_info($show) {
//  $id = is_object($show)?$show->ID:$show;
//  $is_featured = get_field('is_featured', $id);
//  $presenter_info = get_field('presenter', $id);
//  $venue = get_field('venue', $id);
//  $image = get_the_post_thumbnail_url($id);
//  if (!$image) $image = get_field('featured_image_url', $id);
//  return array(
//    'title'     => is_object($show)?$show->post_title:get_the_title($id),
//    'label'     => $is_featured=='1'?"Featured Show":"Next Show",
//    'image'     => $image,
//    'presenter' => ($presenter_info?$presenter_info:"The Vera Project Presents"),
//    'support'   => get_field('support', $id),
//    'sold_out'  => get_field('sold_out', $id)=='1',
//    'venue'     => $venue?$venue:"The Vera Project",
//    'date'      => get_field('date', $id),
//    'time'      => get_field('time', $id),
//    'price'     => get_field('price', $id),
//    'link'      => get_field('link', $id),
//  );
//}
//
//// get and format minimal metadata for a show in a list
//function vera_shows_get_list_info($show) {
//  $id = is_object($show)?$show->ID:$show;
//  return array(
//    'title'     => is_object($show)?$show->post_title:get_the_title($id),
//    'presenter' => ($presenter_info?$presenter_info:"The Vera Project Presents"),
//    'support'   => get_field('support', $id),
//    'sold_out'  => get_field('sold_out', $id)=='1',
//    'venue'     => get_field('venue', $id),
//    'date'      => get_field('date', $id),
//    'link'      => get_field('link', $id),
//  );
//}
