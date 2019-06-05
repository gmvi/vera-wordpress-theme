<?php
/**
 * Created by PhpStorm.
 * User: sudoguest
 * Date: 2019-06-03
 * Time: 19:36
 */


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
    error_log('type is ' . json_encode($type), 0);
    switch ($type) {
        case 'single':
            $real_begin_date = ( isset( $event->occur_begin ) ) ? $event->occur_begin : $event->event_begin . ' ' . $event->event_time;
            $description = $data['description'];
            $address = $data['hcard'];
            $date = $data['daterange'];
            $timeslot = $data['timerange'];
            $recurs = mc_event_recur_string($event, $real_begin_date);
            // don't show reccurence if there is no reccurence
            $recurs_div = $recurs != "Does not recur" ? "<div>$recurs</div>" : '';
//            error_log("recurs? " . json_encode($event->event_repeats));
            $body = <<<EOT
<div class="row mx-4">
    <div class="col-md-9">$description</div>
    <div class="col-md-3 text-right">
        <div>$date</div>
        <div>$timeslot</div>
        <hr class="ml-4"/>
        <div>$address</div>
        $recurs_div
    </div>
</div>
EOT;
            break;
        case 'list':
            $num_words = 65;
            $excerpt   = wp_trim_words( $data['description'], $num_words );
            $body = '<div class="row">
    <div class="card w-100 mx-3 mb-2">
      <div class="card-body">
        <h3 class="card-title">' . $data['title'] . '</h3>
        <p class="card-text">' . $excerpt . '</p>
        <a href="'. $data['details_link'] .'" class="btn btn-primary">Button</a>
      </div>
    </div>
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
//    error_log('wtf' . $date_switcher, 0);
    return '<div class="form-control">' . $date_switcher . '</div>';
}

//$inner_heading = apply_filters( 'mc_heading_inner_title', $wrap . $image . trim( $event_title ) . $balance, $event_title, $event );
add_filter('mc_heading_inner_title', 'log_filter', 10, 3);
function log_filter($something0, $something1, $something2) {
//    error_log('this may work???' . $something0 . ' ' . $something1, 0);
//    error_log(json_encode($something2), 0);
    return $something0;
}
//$hlevel     = apply_filters( 'mc_heading_level_list', 'h3', $type, $time, $template );
//				$list_title = "<$hlevel class='event-title summary' id='mc_$event->occur_id-title'>$image" . $event_title . "</$hlevel>\n";

//function set_list_heading