<?php
/**
 * The homepage template file.
 *
 */

get_header();

// Get container type from Wordpress Customizer
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="index-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

        <main class="site-main" id="main">
            <section class="volunteer-hero">
                <div class="volunteer-hero-text">
                    <div class="centered">
                        <p class="label">Get Involved</p>
                        <h2>Volunteer today!</h2>
                    </div>
                </div>
            </section>
            <section class="adventure">
                <h1 class="header">Choose Your Own <b>Adventure</b></h1>
                <?php if( get_field('volunteer_copy') ): ?>
                    <h2><?php the_field('volunteer_copy'); ?></h2>
                <?php endif; ?>
            </section>
        </main><!-- #main -->

    </div><!-- #content -->

</div><!-- .wrapper -->

<?php get_footer(); ?>
