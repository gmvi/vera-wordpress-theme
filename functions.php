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

add_action( 'admin_init', 'hide_editor' );

// hides editor for pages that don't need it (like Get Involved)
// to hide editor for more pages, add them as ors to line 57
function hide_editor() {
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
	if ( ! isset( $post_id ) ) {
		return;
	}
	$pagetitle = get_the_title( $post_id );
	if ( $pagetitle == 'Get Involved' ) {
		remove_post_type_support( 'page', 'editor' );
	}
}


// Unwanted templates
function vera_remove_page_templates( $templates ) {
    unset( $templates['page-templates/fullwidthpage.php'] );
    unset( $templates['page-templates/left-sidebarpage.php'] );
    unset( $templates['page-templates/both-sidebarspage.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );
    return $templates;
}
add_filter( 'theme_page_templates', 'vera_remove_page_templates' );
