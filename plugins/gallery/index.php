<?php
/*
Plugin Name: The Vera Project Gallery
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define('GALLERY_TYPE', 'galleries');
define('CURR_GALLERY', 'current_gallery');
define('UP_NEXT_GALLERY', 'up_next_gallery');

/*** Register gallery post type ***/
add_action( 'init', 'vera_gallery_init' );

function vera_gallery_init() {
	register_post_type( 'galleries',

		array(
			'labels' => array(
				'name' => __( GALLERY_TYPE ),
				'singular_name' => __( 'Gallery' ),
				'menu_name' => __( 'Gallery' ),
				'add_new_item' => __( 'Add New Gallery' ),
				'edit_item' => __( 'Edit Gallery' ),
				'new_item' => __( 'New Gallery' ),
				'view_item' => __( 'View Gallery' ),
				'search_items' => __( 'Search Galleries' ),
				'not_found' => __( 'No galleries found' ),
				'not_found_in_trash' => __( 'No galleries found in Trash' ),
			),
			'capability_type' => 'post',
			'menu_icon' => 'dashicons-art',
			'public' => true,
			'supports' => array( 'thumbnail', 'title', 'editor' ),
			'publicly_queryable' => true,
			'has_archive' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'exclude_from_search' => false
		)
	);
}

// add Current Gallery and Up Next Gallery fields to row display
add_filter( 'manage_' . GALLERY_TYPE . '_posts_columns', 'vera_galleries_columns' );
function vera_galleries_columns( $columns ) {
	$columns[CURR_GALLERY] = __( 'Current Gallery' );
	$columns[UP_NEXT_GALLERY] = __( 'Up Next Gallery' );
	$columns['gallery_opening_datetime'] = "Gallery Opening Datetime";
	$columns['gallery_end_date'] = "Gallery End Date";
	unset($columns['date']);
	return $columns;
}

//make current gallery + up next gallery date columns sortable
add_filter( 'manage_edit-' . GALLERY_TYPE . '_sortable_columns', 'vera_galleries_sortable_columns' );
function vera_galleries_sortable_columns( $columns )
{
	$columns['gallery_opening_datetime'] = 'gallery_opening_datetime';
	$columns['gallery_end_date'] = 'gallery_end_date';
	return $columns;
}

//configure fields to display properly in columns
add_action( 'manage_' . GALLERY_TYPE . '_posts_custom_column' , 'vera_galleries_column', 10, 2 );
function vera_galleries_column( $column, $post_id ) {
	$curr_time = strtotime(current_time('Ymd'));
	switch ($column) {
		case CURR_GALLERY:
			$is_current_gallery = get_field(CURR_GALLERY, $post_id);
			if ($is_current_gallery) {
				echo "<div class='hidden curr-gallery-post-" . $post_id . "'>check</div>" . '&#10004;';
			} else {
				echo "<div class='hidden curr-gallery-post-" . $post_id . "'>nocheck</div>" . '&#10005;';
			}
			break;
		case UP_NEXT_GALLERY:
			$up_next_gallery = get_field(UP_NEXT_GALLERY, $post_id);
			if ($up_next_gallery) {
				echo "<div class='hidden next-gallery-post-" . $post_id . "'>check</div>" . '&#10004;';
			} else {
				echo "<div class='hidden next-gallery-post-" . $post_id . "'>nocheck</div>" . '&#10005;';
			}
			break;
		case 'gallery_opening_datetime':
			$opening_time = get_field('gallery_opening_datetime', $post_id);
			if (strtotime($opening_time) < $curr_time) {
				echo "<strike>" . $opening_time . "</strike>";
			} else {
				echo "<b>" . $opening_time . "</b>";
			}
			break;
		case 'gallery_end_date':
			$ending_time = get_field('gallery_end_date', $post_id);
			if (strtotime($ending_time) < $curr_time) {
				echo "<strike>" . $ending_time . "</strike>";
			} else {
				echo "<b>" . $ending_time . "</b>";
			}
			break;
	}
}

//change the column width so up next and current isn't so huge
add_action('admin_head', 'custom_gallery_column_width');
function custom_gallery_column_width() {
	echo '<style type="text/css">';
	echo '.column-current_gallery { width:15% !important; overflow:hidden }';
	echo '.column-up_next_gallery { width:15% !important; overflow:hidden }';
	echo '</style>';
}

// default gallery sort is by ascending end date
add_action( 'pre_get_posts', 'gallery_end_date_sort' );
function gallery_end_date_sort($query) {
	//todo: discuss - why doesn't everybody check if post_type is not set + equal to type and return if false? when does this method run

	// in admin view, default sort by end date
	if ( is_admin() && isset($query->query_vars['post_type'])
	     && $query->query_vars['post_type'] == GALLERY_TYPE) {
		$orderby = $query->get( 'orderby' );
		$order = $query->get( 'order' );
		if ( $orderby == '' && $order == '') { //default ordering for admin view is by end date
			$meta_query = array(
				'relation' => 'OR',
				array(
					'key' => 'gallery_end_date',
					'compare' => 'NOT EXISTS', // if we don't check for this, galleries without end dates will not show up
				),
				array(
					'key' => 'gallery_end_date',
				),
			);

			$query->set( 'meta_query', $meta_query );
			$query->set( 'orderby', 'meta_value' );
		}

		return $query;
	}

	if( isset($query->query_vars['post_type'])
	    && $query->query_vars['post_type'] == GALLERY_TYPE
	    && $query->get('orderby') == ''
	    && $query->get('meta_key') == '') {

		$query->set('orderby', 'meta_value');
		$query->set('meta_key', 'gallery_end_date');
		$query->set('order', 'DESC');
	}

	return $query;
}

function quick_edit_gallery($column_name, $post_type ) {
	if ($post_type != GALLERY_TYPE)
		return;

	switch ($column_name) {
		case CURR_GALLERY:
			?>
			<fieldset class="inline-edit-col-left">
				<div class="inline-edit-col">
				<label class="alignleft inline-edit-private">
					<input class="curr_gallery_check" type="checkbox"  name="<?php echo esc_attr( $column_name ); ?>">
					<span class="checkbox-title">Current Gallery Show</span>
				</label>
				</div>
			</fieldset>
			<?php
			break;
		case UP_NEXT_GALLERY:
			?>
			<fieldset class="inline-edit-col-left">
				<div class="inline-edit-col">
					<label class="alignleft inline-edit-private">
						<input class="up_next_gallery_check" type="checkbox"  name="<?php echo esc_attr( $column_name ); ?>">
						<span class="checkbox-title">Up Next Gallery Show</span>
					</label>
				</div>
			</fieldset>
			<?php
			break;
		default;
	}

}

add_action( 'quick_edit_custom_box', 'quick_edit_gallery', 10, 2 );


function quick_edit_save_gallery($post_id, $post ) {
	// if called by autosave, then bail here
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;

	// if this "post" post type?
	if ( $post->post_type != GALLERY_TYPE )
		return;

	// does this user have permissions?
	if ( ! current_user_can( 'edit_post', $post_id ) )
		return;

	//this checks to only perform this save if we are in quickedit mode
	if ($_POST['action'] === 'inline-save') {
		$curr_gallery_field = false;
		$next_gallery_field = false;

		if ( isset( $_POST[CURR_GALLERY] ) ) {
			$curr_gallery_field = true;
		}

		update_field(CURR_GALLERY, $curr_gallery_field, $post_id);

		if ( isset( $_POST[UP_NEXT_GALLERY] ) ) {
			$next_gallery_field = true;
		}

		update_field(UP_NEXT_GALLERY, $next_gallery_field, $post_id);

    }
}
add_action( 'save_post', 'quick_edit_save_gallery', 10, 2);

function quick_edit_gallery_javascript() {
	$current_screen = get_current_screen();

	if ( GALLERY_TYPE != $current_screen->post_type ) {
		return;
	}

	// Ensure jQuery library is loaded
	wp_enqueue_script( 'jquery' );
	?>
	<script type="text/javascript">
        //attach event to quick edit click that checks for hidden field in column and update checkbox
        jQuery( 'tbody#the-list' ).on( 'click', '.editinline', function() {
            //revert Quick Edit menu so that it refreshes properly
            inlineEditPost.revert();

            var postId = jQuery( this ).parents( 'tr' ).attr( 'id' );
            var currVal = jQuery( 'div.curr-gallery-' + postId ).text();
            var nextVal = jQuery( 'div.next-gallery-' + postId ).text();

            jQuery( '.curr_gallery_check' ).attr( 'checked', currVal === 'nocheck' ? false : true );
            jQuery( '.up_next_gallery_check' ).attr( 'checked', nextVal === 'nocheck' ? false : true);
        });
	</script>
	<?php
}
add_action( 'admin_footer', 'quick_edit_gallery_javascript' );

//----- end adding two new fields to quick edit -----

include 'util.php';