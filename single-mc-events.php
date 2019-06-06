<?php
/**
 *
 * Template for my-calendar events page
 * TODO: or FIXME? this one only works if you enable pretty permalinks!! which you should do!!
 * TODO: figure out designs for single event, implement here & using 'mc_custom_template' filter which is in `$(pwd)/plugins/my-calendar/mc-custom-template.php`
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
                $title = get_the_title();
                include( locate_template( 'partial-templates/half-or-block-header.php'));
                ?>
                <div id="content" class="entry-content">
                    <div class="row pt-4 pb-4 ml-1 no-gutters">
                        <div class="col-sm-9 pb-3 blog-contents mx-auto"><?php the_content()?></div>
                    </div>
                </div>

            </article><!-- #post-## -->

        </main><!-- #main -->

    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
