<?php
/**
 * Created by PhpStorm.
 * User: sudoguest
 * Date: 2019-06-03
 * Time: 19:36
 */

function create_single_event_view($data, $event) {
    $real_begin_date = ( isset( $event->occur_begin ) ) ? $event->occur_begin : $event->event_begin . ' ' . $event->event_time;
    $description = $data['description'];
    $address = $data['hcard'];
    $date = $data['daterange'];
    $timeslot = $data['timerange'];
    $recurs = mc_event_recur_string($event, $real_begin_date);
    // don't show recur if there is no recurrence
    $recurs_div = $recurs != "Does not recur" ? "<div>$recurs</div>" : '';
    $link_html = $data['link'] ? '<a href=" ' . $data['link'] . ' " class="btn bordered-button btn-outline-primary">Buy Tickets</a>' : '';
    return <<<EOT
<div class="row mx-4">
    <div class="col-md-9 order-2 order-md-1">$description</div>
    <div class="col-md-3 order-1 order-md-2 text-md-right">
        <div class="row mb-4">
            <div class="col-6 col-md-12">
                <div>$date</div>
                <div>$timeslot</div>
                $recurs_div
                <div class="text-left text-md-right">
                    $link_html
                </div>
            </div>
            <hr class="ml-4 d-none d-md-block w-100"/>
            <div class="col-6 col-md-12">
                <div>$address</div>
            </div>
        </div>
    </div>
</div>
EOT;
}

add_filter( 'mc_heading_inner_title', 'add_event_location_hidden', 10, 3);
function add_event_location_hidden($body, $event_title, $event) {
    $body .= '<span class="HIDDEN-CATEGORY" style="display:none;">' . $event->event_label . '</span>';
    return $body;
}

/**
 * This plug-in demonstrates adding a custom template in PHP.
 *
 * [my_calendar template='custom_template_name']
 *
 * @param string $body Existing rendered output or false.
 * @param array  $data Array of processed My Calendar template tags.
 * @param object $event Source event object.
 * @param string $type Type of view currently shown. (List, calendar, mini.)
 * @param string $process_date Current date being processed.
 * @param string $time Currently viewed timeframe. (Day, week, month.)
 * @param string $template Template name passed.
 *
 * @return string
 */
add_filter( 'mc_custom_template', 'my_custom_calendar', 10, 7);
function my_custom_calendar( $body = false, $data, $event, $type, $process_date, $time, $template ) {
//    error_log("event is " . json_encode($event), 0 );
//    $hidden_event_category = '<span class="HIDDEN-CATEGORY" style="display:none;">' . $event['event_label'] . '</span>';
    // todo: add in hidden field w/ all the `event_label`s, use jquery to aggregate them all and create a locations select field
    //   like the categories select
    switch ($type) {
        case 'single':
            $body = create_single_event_view($data, $event);
            break;
        case 'list':
            $num_words = 65;
            $excerpt   = wp_trim_words( $data['description'], $num_words );
            $body = '<div class="row">
    <div class="list-event-card card w-100 mx-3 mb-2">
      <div class="card-body">
        <a href="'. $data['details_link'] .'" class="stretched-link"><h3 class="card-title my-1">' . $data['title'] . '</h3></a>
        <h4 class="card-subtitle mb-3">' . $data['timerange'] . '</h4>
        <p class="card-text">' . $excerpt . '</p>
      </div>
    </div>
    <span class="HIDDEN-CATEGORY" style="display:none;">' . $event->event_label . '</span>
</div>';
            break;
        case 'mini':
            $body = '<div class="mini-event-detail py-1 py-sm-3">
                        <div class="row mx-2 mx-md-4"> 
                            <div class="col-7 col-md-9"><h4>' . $data['title'] . '</h4></div>
                            <div class="col-5 col-md-3"><a href="'. $data['details_link'] .'"><b>'. $data['timerange'] . '</b></a></div>
                        </div>
                    </div>';

    }
    return $body;
}

add_filter( 'mc_jumpbox', 'meow', 10, 1);
function meow($date_switcher) {
    return $date_switcher;
}


add_filter('mc_heading_inner_title', 'log_filter', 10, 3);
function log_filter($something0, $something1, $something2) {
    return $something0;
}

add_filter( 'mc_list_js', 'custom_list_js' );
function custom_list_js( $url ) {
    return get_stylesheet_directory_uri() . '/js/my-calendar/events-view.js';
}

add_filter( 'mc_ajax_js', 'custom_ajax_js' );
function custom_ajax_js( $url ) {
    return get_stylesheet_directory_uri() . '/js/my-calendar/ajax-cal.js';
}

//registers the class_cat query var
add_filter('query_vars', 'add_class_cat');
function add_class_cat($public_query_vars) {
	$public_query_vars[] = 'class_cat';
	return $public_query_vars;
}

//add_filter( 'mc_mini_js', 'custom_mini_js' );
//function custom_mini_js( $url ) {
//    return get_stylesheet_directory_uri() . '/js/my-calendar/mini-cal.js';
//}


include 'mc-custom-fields.php';
