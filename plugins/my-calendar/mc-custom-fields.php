<?php

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
	$form .= "<p><label for='event_subheader'>" . __( 'Event Subheader' ) . "</label><textarea from='my-calendar' name='event_subheader' id='event_subheader' rows='5'/>$subheader</textarea></p>";

	return $form;
}

add_filter( 'mc_event_details', 'event_link_to_detailurl', 10, 4 );
function event_link_to_detailurl( $form, $has_data, $event, $context ) {
    if ( $has_data ) {
        $post_id = $event->event_post;
        /* Custom fields are stored as custom post meta */
        $linked = esc_attr( get_post_meta( $post_id, '_mc_event_link_to_detailurl', true ) );
    } else {
        $linked = '';
    }
    $checked = $linked == true ? "checked" : "";
    $form .= "<p><label for='event_subheader'>" . __( 'Link directly from calendar to detail url (ie Eventbrite)?' ) . "</label><input style='margin-left:5px;' from='my-calendar' name='event_link_to_detailurl' id='event_link_to_detailurl' type='checkbox' value='true' $checked/></input></p>";

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

add_action( 'mc_update_event_post', 'event_link_to_detailurl_save', 10, 4 );
function event_link_to_detailurl_save( $post_id, $post, $data, $event_id ) {
    $link_directly_str = trim($post['event_link_to_detailurl']);
    $link_directly = $link_directly_str === 'true' ? true : false;
    update_post_meta( $post_id, '_mc_event_link_to_detailurl', $link_directly );
}