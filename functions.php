<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

// Include bundled plugins
$includes = array_filter(glob(__DIR__.'/plugins/*/index.php'), 'is_file');
foreach ($includes as $filename) {
    include $filename;
}

// Modify posts page query to return only 9 at a time
add_action( 'pre_get_posts', 'limit_posts_query' );

function limit_posts_query( $query ) {
	// checks if we are on the "posts page" or a gallery archive page, limits number of posts
	if( ((is_home() || is_category()) && $query->is_main_query())
	    || is_post_type_archive(GALLERY_TYPE))  {
		$query->set('posts_per_page', '9');
	}

}

//add search box to where we want in menu
function add_search_box_to_menu( $items, $args ) {
	ob_start();
	get_search_form();
	$searchform = ob_get_contents();
	ob_end_clean();

	$items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page nav-item">' . $searchform . '</li>';
	return $items;


//	if ( $args->theme_location === 'primary' ) {
//		$items .= get_search_form();
//		return $items;
//	}
//
//	return $items;
}
add_filter( 'wp_nav_menu_items', 'add_search_box_to_menu', 10, 2 );


//make the paginated buttons beautiful
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
	return 'class="btn bordered-button btn-outline-primary"';
}

// Remove things we don't want

// Widgets? No por favor!
add_filter( 'sidebars_widgets', 'disable_all_widgets' ); 
function disable_all_widgets( $sidebars_widgets ) 
{ 
   return array( false ); 
}
add_action( 'admin_menu', 'remove_menus', 999 );

// 999 above forces high priority, otherwise remove_submenu_page won't work
function remove_menus() {
    remove_submenu_page( 'themes.php', 'widgets.php' );
}

function register_custom_menus() {
    register_nav_menu('gallery-menu',__( 'Gallery Menu' ));
	register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'register_custom_menus' );


// Unwanted templates
function vera_remove_page_templates( $templates ) {
    unset( $templates['page-templates/fullwidthpage.php'] );
    unset( $templates['page-templates/left-sidebarpage.php'] );
    unset( $templates['page-templates/both-sidebarspage.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );
    return $templates;
}
add_filter( 'theme_page_templates', 'vera_remove_page_templates' );

// TODO: review - where to put useful things like this
function pad_zeroes( $num ) {
	if ( $num > 9 ) {
		return $num;
	}

	return str_pad( $num, 2, '0', STR_PAD_LEFT );
}

require_once('plugins/my-calendar/mc-custom-template.php');
