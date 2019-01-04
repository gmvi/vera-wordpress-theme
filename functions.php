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
    wp_enqueue_style( 'wpb-fa', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css');
}

add_filter( 'sidebars_widgets', 'disable_all_widgets' ); 
function disable_all_widgets( $sidebars_widgets ) 
{ 
   return array( false ); 
}

// Remove things we don't need

// Widgets! No, por favor!
// 999 here means we're forcing high priority, otherwise the remove_submenu_page call won't work
add_action( 'admin_menu', 'remove_menus', 999 );
function remove_menus() {
    remove_submenu_page( 'themes.php', 'widgets.php' );
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
