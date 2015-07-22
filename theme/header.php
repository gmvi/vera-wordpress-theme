<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package The Vera Project
 */

function thumbnail_class() {
  if ( has_post_thumbnail() ) {
    echo "has-thumbnail";
  } else {
    echo "no-thumbnail";
  }
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
  <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'the-vera-project' ); ?></a>

  <header id="masthead" class="site-header <?php thumbnail_class(); ?>" role="banner">
    <div class="site-branding">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <img src="<?php echo get_template_directory_uri();?>/images/logo.gif">
      </a>
      <!-- <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2> -->
    </div><!-- .site-branding -->
    <?php $post = get_post();
          $ancestors = array_slice($post->ancestors, -1);
          $top = $ancestors? get_post( $ancestors[0] )->post_name : $post->post_name;
          $class = $top == "shows" ? "shows-page" : ""; ?>
    <nav id="site-navigation" class="main-navigation <?php echo $class; ?>" role="navigation">
      <?php wp_nav_menu( array( 'theme_location'  => 'primary',
                                'menu_id'         => 'primary-menu',
                                'container-class' => $class ) ); ?>
    </nav><!-- #site-navigation -->

    <?php if ( has_post_thumbnail() ) : ?>
      <div class="thumbnail-container">
        <?php echo get_the_post_thumbnail(); ?>
      </div>
    <?php endif; // End header image check. ?>

  </header><!-- #masthead -->
