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
    if ( 'single' == $type || 'list' == $type) {
//        error_log(json_encode($event),0);
//        error_log('dataaaa \n\n' . json_encode($data), 0);
        // only do the pretty header block with image if it is a single type, if its a list then it will generate the block
        // for _every_ item, so you get... n header blocks
        $description = $data['description'];
        $address = $data['hcard'];
        $date = $data['daterange'];
        $timeslot = $data['timerange'];
        $featuredPic = $data['medium_large_url'];
        $title = $data['title'];
        $featuredPicRow = '';
        $headerTitle = '';
        $dividingRules = '';
        // if the event is a list instead of a single, then image & title won't be showing in the block header set by `single-mc-events.php`,
        //    so go ahead and add it above the content
        if ( 'list' == $type) {
            $dividingRules = '<hr/>';
            $featuredPicRow = $featuredPic ? "<div class='row mx-4'><img src='$featuredPic' class='img-fluid mx-auto' style='object-fit: contain;max-height:300px;' alt='$title'></div>" : '';
            $headerTitle = "<h3>$title</h3>";
        }
        $body = <<<EOT
$dividingRules
$featuredPicRow
<div class="row mx-4">
    <div class="col-md-9">$headerTitle $description</div>
    <div class="col-md-3 text-right">
        <div>$date</div>
        <div>$timeslot</div>
        <hr class="ml-4"/>
        <div>$address</div>
    </div>
</div>
$dividingRules
EOT;
//        return $body;
    } else if ( 'mini' == $type ) {
        // if it's the jquery popup from the mini calendar, just show minimal event details and links
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