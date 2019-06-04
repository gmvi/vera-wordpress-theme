<?php
/**
 *
 * Template for wp-calendar events page
 * TODO: or just FYI... the custom post type that this page is named after (originally page-mc-events.php but now page-events.php) is actually based on the slug
 *   of the main default calendar page (what management settings' `main calendar page` field is set to, ie `theveraproject.org/events` or `theveraproject.org/mc-events`
 *   .
 *   i just confirmed that this is the case.... so that's really weird and just means the main default page for the calendar
 *   can't change, or when it is, this filename must be changed as well..
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="full-width-page-wrapper">

    <div class="<?php echo esc_attr( $container ); ?> p-0">

        <main class="site-main" id="main" role="main">
            <!--
                TODO: use wp_get_nav_menu_object() to check if menu for $pagename exists, if it does use centered-submenu template
                https://stackoverflow.com/questions/4837006/how-to-get-the-current-page-name-in-wordpress
            -->
            <?php the_post(); // This is a page template ?>

            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <?php
                if (has_post_thumbnail( get_the_ID() )) { ?>
                    <div class="row no-gutters">
                        <div class="col-sm-6 p-0 mh-100" style="">
                            <img class="h-100 single-blog-featured-image" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full')?>">
                        </div>
                        <div class="col-sm-6 p-0 mh-100 single-blog-featured-text">
                            <div class="textured-blerg h-100 content-hero ">
                                <div class="content-overlay"></div>
                                <div class="d-flex align-content-center flex-wrap justify-content-center h-100">
                                    <div>
                                        <h2 class="single-blog-title text-white mb-0"><?php the_title()?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                else {
                    get_template_part('partial-templates/block-header');
                }
                global $post;
                $wrapper_class_name = 'entry-header';
                // if there is a menu that is identical to the post name, then use that
                // to display the subnav. otherwise, check for parent post
                if (wp_get_nav_menu_object($post->post_name)!== false) {
                    $menu_name = $post->post_name;
                } else {
                    $menu_name = get_post_field( 'post_name', $post->post_parent );
                }
                include( locate_template( 'partial-templates/centered-submenu.php') );
                ?>
                <div id="content" class="entry-content">
                    <div class="row pt-4 pb-4 ml-1 no-gutters">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-9 pb-3 blog-contents">
                            <?php the_content()?>
                            <hr class="pb-2"/>
                            <p class="share-call mb-1">Share this story</p>
                            <?php get_template_part('partial-templates/share-post-icons') ?>
                        </div>
                    </div>
                </div>

            </article><!-- #post-## -->

        </main><!-- #main -->

    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
