<?php
/**
 * Get Involved template.
 *
 */

get_header();

// Get container type from Wordpress Customizer
$container = get_theme_mod( 'understrap_container_type' );


$gallery_img="";
if (has_post_thumbnail($post ->ID)):
    $gallery_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail')[0];
endif;


function pad_zeroes( $num ) {
    if ( $num > 9 ) {
        return $num;
    }

    return str_pad( $num, 2, '0', STR_PAD_LEFT );
}

?>
<div class="wrapper" id="index-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

        <main class="site-main" id="main">
            <?php the_post(); // This is a page template ?>
            <?php get_template_part('partial-templates/titlecard-fullwidth'); ?>
            <section class="entry-header">
                <div class="menu">
                    <!-- TODO: once we know more about this sub menu from george swap this out for something more reusable -->
                    <!-- TODO QUESTION: this looks weird af on mobile but i don't know what it should look like, should the blue bar expand vertically on mobile?-->
                    <div class="menu-item current-menu-item"><a>overview</a></div>
                    <div class="menu-item"><a href="/" class="menu-item">classes</a></div>
                    <div class="menu-item"><a href="/" class="menu-item">recording studio</a></div>
                </div>
            </section>
            <?php get_template_part('partial-templates/pageblurb'); ?>
            <section>
                <div class="row  no-gutters current-gallery">
                    <div class="col-sm-6">
                        <div class="row align-items-center h-100">
                            <div class="col-9 mx-auto">
                                <p class="label">Current Show</p>
                                <h2 class="large-header"><?php the_field( 'current_gallery_header' ); ?></h2>
                                <p><?php the_field('current_gallery_description'); ?></p>
                                <p><b>Exhibit up until <?php the_field('current_gallery_end_date'); ?><br>
                                        Opening: <?php the_field('current_gallery_opening_datetime'); ?></b></p>
                                <a href="<?php the_field('current_gallery_link'); ?>" class="more">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <img class="current-gallery-image" src="<?php echo get_field( 'current_gallery_image' )['url'];?>" />
                    </div>
                </div>
            </section>
            <section class="quote gallery-quote"><!-- quote -->
            <div class="container-fluid h-100">
                <div class="row h-100">
                    <div class="col-md-6 mx-auto p-5">
                        <img class="rounded-circle" src="<?php echo get_field( 'author_image' )['url'];?>" />
                    </div>
                    <div class="col-md-6">
                        <div class="row h-100 align-items-center text-center">
                            <div class="col-md-12">
                                <p class="quote"><?php the_field('quote'); ?></p>
                                <span class="author"><?php the_field('author'); ?> | <?php the_field('author_title'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>

        </main><!-- #main -->

    </div><!-- #content -->

</div><!-- .wrapper -->


<?php get_footer(); ?>
