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
//    error_log('template type is ' .  $template, 0);
    // Toggle this template if specifically in shortcode *or* if rendering the 'single' event view.
    if ( 'custom_template_name' == $template || 'single' == $template ) {
//        error_log(json_encode($data),0);
//        error_log(json_encode($event),0);
        // Using the $data and $event information, source your variables.
        $details = array(
            $data['image'],
            $data['access'],
            $data['title'],
            $data['shortdesc_raw'],
            $data['hcard'],
            $data['location_access'],
            $data['description'],
            $data['link'],
        );
        // Create your layout, and insert relevant values into it.
        $body = vsprintf( '
<div class="row">
	<div class="span3">
		%1$s
	</div>
	<div class="span6">
	'.$header.'
	<strong>%4$s</strong>
		<div class="smallertext logistics">
			<div class="row">
				<div class="span3">
					<h4>Location</h4>
					%5$s
					'.$phone2.'
					%6$s
				</div>
			</div>
			<p><a href="%8$s">More Information<span class="screen-reader-text"> about %3$s</span></a></p>
		</div><!--end smallertext-->
	</div>
</div>', $details );
        return $body;
    }
    return $body;
}

add_filter( 'mc_jumpbox', 'meow', 10, 1);
function meow($date_switcher) {
    error_log('wtf' . $date_switcher, 0);
    return '<div class="form-control">' . $date_switcher . '</div>';
}

