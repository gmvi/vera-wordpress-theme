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
            <div class="container-fluid">
                <section class="row no-gutters current-gallery">

                    <div class="col-sm-6">
                        <div class="row align-items-center h-100">
                            <div class="col-9 mx-auto">
                                <p class="label">Current Show</p>
                                <h2 class="medium-header mb-1"><?php the_field( 'current_gallery_header' ); ?></h2>
                                <p><?php the_field('current_gallery_description'); ?></p>
                                <p><b>Exhibit up until <?php the_field('current_gallery_end_date'); ?><br>
                                        Opening: <?php the_field('current_gallery_opening_datetime'); ?></b></p>
                                <a href="<?php the_field('current_gallery_link'); ?>" class=" btn bordered-button btn-outline-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- fixme: this looks absolutely horrible on mobile and i don't know how to mend -->
                        <img class="current-gallery-image" src="<?php echo get_field( 'current_gallery_image' )['url'];?>" /> -
                    </div>

                </section>
                <section class="row h-100 quote gallery-quote">

                    <div class="col-md-6 mx-auto p-5">
                        <img class="rounded-circle" src="<?php echo get_field( 'author_image' )['url'];?>" />
                    </div>
                    <div class="col-md-6">
                        <div class="row h-100 align-items-center text-center">
                            <div class="col-md-12">
                                <p class="quote-text"><?php the_field('quote'); ?></p>
                                <span class="author"><?php the_field('author'); ?> | <?php the_field('author_title'); ?></span>
                            </div>
                        </div>
                    </div>

                </section>
                <section class="row">
                    <div class="row h-100 p-5">
                        <div class="col-md-6 p-4">
                            <p class="label">Get Involved</p>
                            <h2 class="medium-header mb-1"><?php the_field('committee_block_header'); ?></h2>
                            <p><?php the_field('committee_block_description'); ?></p>
                            <a href="<?php the_field('committee_block_contact_url'); ?>" class="btn bordered-button btn-outline-primary">Contact the committee</a>
                        </div>
                        <div class="col-md-6 p-4">
                            <p class="label">Call For Artists</p>
                            <h2 class="medium-header mb-1"><?php the_field('cfa_block_header'); ?></h2>
                            <p><?php the_field('cfa_block_description'); ?></p>
                            <a href="" class="btn bordered-button btn-outline-primary">Submit A Proposal</a>
                        </div>
                    </div>
                </section>
                <section class="gallery-banner">
                    <div class="banner-background"></div>
                    <div class="row no-gutters pl-4 ml-4 pr-4 mr-4 banner-content">
                        <div class="col-md-6 p-4">
                            <p class="label-white">Support Vera</p><br/>
                            <h2 class="large-header" style="color:white;">Support the Gallery</h2>
                            <a href="" class="btn bordered-button-white">Donate Today</a>
                        </div>
                        <div class="col-md-6 p-1">
                            <img class="support-gallery-graphic" src="<?php echo get_field( 'support_gallery_graphic' )['url'];?>" /> -
                        </div>
                    </div>
                </section>
<!--                <section class="row" style="overflow: hidden;">-->
<!--                    <div class="support-banner"></div>-->
<!--                    <div class="col-md-6 p-4">-->
<!--                        <p class="label">Get Involved</p>-->
<!--                    </div>-->
<!--                </section>-->
            </div>
        </main><!-- #main -->

    </div><!-- #content -->

</div><!-- .wrapper -->


<?php get_footer(); ?>
