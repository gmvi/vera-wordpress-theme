<?php


// add capability to link directly from calendar view into the specified event link (ie a Eventbrite link, etc)
//   instead of to the details page that will live on the site
add_filter( 'mc_event_details', 'event_links_to_eventlink', 10, 4 );
function event_links_to_eventlink( $form, $has_data, $event, $context ) {
	if ( $has_data ) {
		$post_id = $event->event_post;
		/* Custom fields are stored as custom post meta */
		$linked = esc_attr( get_post_meta( $post_id, '_mc_event_links_to_eventlink', true ) );
	} else {
		$linked = '';
	}
	$checked = $linked == true ? "checked" : "";
	$form .= "<h3>All Events</h3>";
	$form .= "<p><label for='event_subheader'>" . __( 'Link directly from calendar to event url (ie Eventbrite)?' ) . "</label><input style='margin-left:5px;' from='my-calendar' name='event_links_to_eventlink' id='event_links_to_eventlink' type='checkbox' value='true' $checked/></input></p>";

	return $form;
}

/**
 * Add the input field for my custom field into the main section of My Calendar event details.
 *
 * @param string $form HTML of any other added custom fields.
 * @param boolean $has_data If true, this is an event being edited or corrected.
 * @param object $event The event object saved.
 * @param string $context 'public' or 'admin', depending on whether this is being rendered in the Pro submissions form or WP Admin.
 *
 * @return string
 **/

add_filter( 'mc_event_details', 'event_subheader', 10, 4 );
function event_subheader( $form, $has_data, $event, $context ) {
	if ( $has_data ) {
		$post_id = $event->event_post;
		/* Custom fields are stored as custom post meta */
		$subheader = esc_attr( get_post_meta( $post_id, '_mc_event_subheader', true ) );
	} else {
		$subheader = '';
	}
	$form .= "<h3><i>Classes Only</i></h3>";
	$form .= "<p><label for='event_subheader'>" . __( 'Event Subheader' ) . "</label><textarea from='my-calendar' name='event_subheader' id='event_subheader' rows='5'/>$subheader</textarea></p>";

	return $form;
}

add_filter( 'mc_event_details', 'shows_fields', 10, 4 );
function shows_fields( $form, $has_data, $event, $context ) {
	if ( $has_data ) {
		$post_id = $event->event_post;
		$is_featured_show = esc_attr( get_post_meta( $post_id, '_mc_event_is_featured_show', true ) );
		$show_presenter = esc_attr( get_post_meta( $post_id, '_mc_event_show_presenter', true ) );
		$show_support = esc_attr( get_post_meta( $post_id, '_mc_event_show_support', true ) );
		$show_price = esc_attr( get_post_meta( $post_id, '_mc_event_show_price', true ) );
	} else {
		$is_featured_show = '';
		$show_presenter = '';
		$show_support = '';
		$show_price = '';
	}
	$checked = $is_featured_show == true ? "checked" : "";
	$form .= "<h3><i>Shows Only</i></h3>";
	$form .= "<div>";
	$form .= "<div><div style='display: inline-block; width: 50%;'><label for='show_presenter'>" . __( 'Presenter (Optional)' ) . "</label><input style='width: 60%;' from='my-calendar' name='show_presenter' id='show_presenter' type='text' placeholder='The Vera Project Presents' value='$show_presenter'/></div>";
	$form .= "<div style='display: inline-block; width: 50%;'><label for='show_support'>" . __( 'Supporting Acts (Optional)' ) . "</label><input style='width: 50%;' from='my-calendar' name='show_support' id='show_support' type='text' placeholder='with ... ' value='$show_support'/></div></div>";
	$form .= "<div style='margin-top: 10px;'><div style='display: inline-block; width: 50%;'><label for='show_price'>" . __( 'Show Price' ) . "</label><input style='width: 50%;' from='my-calendar' name='show_price' id='show_price' type='text' placeholder='$10' value='$show_price'/></div>";
	$form .= "<div style='display: inline-block; width: 50%;'><label for='event_is_featured_show'>" . __( 'Feature on front page' ) . "</label><input style='margin-left:5px;' from='my-calendar' name='event_is_featured_show' id='event_is_featured_show' type='checkbox' value='true' $checked/></input></div></div>";
	$form .= "</div>";
	return $form;
}


/**
 * Save custom fields into post meta.
 *
 * @param int $post_id ID of the post where event meta is saved.
 * @param array $post $_POST array
 * @param array $data Checked array of My Calendar data after processing.
 * @param integer event_id ID of event in my_calendar custom table.
 *
 **/
add_action( 'mc_update_event_post', 'my_event_subheader_save', 10, 4 );
function my_event_subheader_save( $post_id, $post, $data, $event_id ) {
	$subheader = trim($post['event_subheader']);
	update_post_meta( $post_id, '_mc_event_subheader', $subheader );
}

add_action( 'mc_update_event_post', 'event_links_to_eventlink_save', 10, 4 );
function event_links_to_eventlink_save( $post_id, $post, $data, $event_id ) {
    $link_directly_str = trim($post['event_links_to_eventlink']);
    $link_directly = $link_directly_str === 'true' ? true : false;
    update_post_meta( $post_id, '_mc_event_links_to_eventlink', $link_directly );
}

add_action( 'mc_update_event_post', 'show_feature_save', 10, 4 );
function show_feature_save( $post_id, $post, $data, $event_id ) {
	$feature_show_str = trim($post['event_is_featured_show']);
	$feature_show = $feature_show_str === 'true' ? true : false;
	update_post_meta( $post_id, '_mc_event_is_featured_show', $feature_show );

	$show_presenter = trim($post['show_presenter']);
	update_post_meta( $post_id, '_mc_event_show_presenter', $show_presenter );
	$show_support = trim($post['show_support']);
	update_post_meta( $post_id, '_mc_event_show_support', $show_support );
	$show_price = trim($post['show_price']);
	update_post_meta( $post_id, '_mc_event_show_price', $show_price );
}