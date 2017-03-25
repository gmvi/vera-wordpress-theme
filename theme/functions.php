<?php
/**
 * The Vera Project functions and definitions
 *
 * @package The Vera Project
 */

/**
 * TODO: figure out what this does. It came with the underscores theme and I'm not sure what it actually does.
 *
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
  $content_width = 640; /* pixels */
}

if ( ! function_exists( 'the_vera_project_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function the_vera_project_setup() {

  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on The Vera Project, use a find and replace
   * to change 'the-vera-project' to the name of your theme in all the template files
   */
  /***
  load_theme_textdomain( 'the-vera-project', get_template_directory() . '/languages' );
  ***/

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  add_theme_support( 'post-thumbnails' );

  /*
   * The navigation menus
   */
  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'the-vera-project' ),
    'getinvolved' => __( 'Get Involved', 'the-vera-project' ),
    'audioprogram' => __( 'Audio Program', 'the-vera-project' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
  ) );

  /*
   * Enable support for Post Formats.
   * See http://codex.wordpress.org/Post_Formats
   */
  /***
  add_theme_support( 'post-formats', array(
    'aside', 'image', 'video', 'quote', 'link',
  ) );
  ***/

  // Set up the WordPress core custom background feature.
  /***
  add_theme_support( 'custom-background', apply_filters( 'the_vera_project_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );
  ***/
}
endif; // the_vera_project_setup
add_action( 'after_setup_theme', 'the_vera_project_setup' );



/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
/***
function the_vera_project_widgets_init() {
  // right sidebar
  register_sidebar( array(
    'name'          => __( 'Right Sidebar', 'the-vera-project' ),
    'id'            => 'sidebar-1',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );
}
add_action( 'widgets_init', 'the_vera_project_widgets_init' );
***/

function vera_custom_nav_attributes ( $atts, $item, $args ) {
  if ($item->type == "custom" && $item->current) {
    $atts['data-scroll'] = 'true';
  } else {
    $path = parse_url($item->url, PHP_URL_PATH);
    $path = trim($path, "/");
    if ($path == 'shows') {
      $atts['href'] = 'http://events.theveraproject.org/';
    }
  }
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'vera_custom_nav_attributes', 10, 3 );

/**
 * Enqueue scripts and styles.
 */
function the_vera_project_scripts() {
  wp_enqueue_style( 'the-vera-project-style', get_stylesheet_uri() );

  wp_enqueue_script( 'the-vera-project-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

  wp_enqueue_script( 'the-vera-project-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

  wp_enqueue_script( 'the-vera-project-mondernizr', get_template_directory_uri() . '/js/modernizr.custom.52359.js', array(), '20150728', true);

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  wp_enqueue_script( 'the-vera-project-smooth-scroll', get_template_directory_uri() . '/js/smooth-scroll.min.js', array(), '20150831', false );
}
add_action( 'wp_enqueue_scripts', 'the_vera_project_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Custom functions for templates.
 */

function vera_get_events() {
  $options = array( 'user-agent' => 'Mozilla (really WP)' );
  $etag = get_option('vera_events_etag');
  $next_update = get_option('vera_events_timestamp') + 30 /*seconds*/;
  if ($next_update < time()) {
    if ($etag) {
      $options['headers'] = array( 'If-None-Match' => "$etag" );
    }
    $response = wp_remote_get("http://events.theveraproject.org/events.json?view=list&sort=popularity", $options);
    $status = $response['response']['code'];
    if ($status == 200) {
      $events = vera_parse_events($response['body']);
      update_option('vera_events', $events);
      update_option('vera_events_etag', $response['headers']['etag']);
      update_option('vera_events_timestamp', time()); // close enough
    } else if ($status != 304) {
      // TODO: this is a failure state that I'd like to get notifications about
    }
  }
  if (!isset($events)) {
    $events = get_option('vera_events');
  }
  return $events;
}

function vera_parse_events($body) {
  $data = json_decode($body);
  $copy = array();
  foreach ($data->event_groups as $group) {
    $date = strtotime($group->date);
    foreach ($group->events as $event) {
      $buy_url = isset($event->buy_url) ? $event->buy_url : NULL;
      // TODO: verify that this can be removed
      if (!preg_match("|^([a-z]*://)?(www\.)?theveraproject\.org/classes|", $buy_url)) {
        array_push($copy, array(
          'date' => $date,
          'title' => $event->title,
          'buy_url' => $buy_url
        ));
      }
    }
  }
  return $copy;
}
