<?php
/**
 *
 * Template for wp-calendar events page
 *
 * ***THE HOMEPAGE FOR EVENTS FULL CALENDAR, MUST BE LOCATED AT /EVENTS***
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
                        <div class="col-sm-12 px-3 px-xl-5 pb-3 blog-contents">
                            <?php the_content()?>
                            <hr class="pb-2"/>
                            <p class="share-call mb-1">Share these events</p>
                            <?php get_template_part('partial-templates/share-post-icons') ?>
                        </div>
                    </div>
                </div>

            </article><!-- #post-## -->

        </main><!-- #main -->

    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
