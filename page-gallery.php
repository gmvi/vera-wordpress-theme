<?php
/**
 * Get Involved template.
 *
 */

get_header();

// Get container type from Wordpress Customizer
$container = get_theme_mod( 'understrap_container_type' );

?>
<div class="wrapper" id="index-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

        <main class="site-main" id="main">
            <?php the_post(); // This is a page template ?>
            <?php get_template_part('partial-templates/titlecard-fullwidth'); ?>

            <?php get_template_part('partial-templates/pageblurb'); ?>
            <div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
                <section class="row no-gutters current-gallery">

                    <div class="col-sm-6">
                        <div class="row align-items-center h-100 no-gutters">
                            <div class="col-9 mx-auto mt-3 mb-3">
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
                        <img class="current-gallery-image" src="<?php echo get_field( 'current_gallery_image' )['url'];?>" />
                    </div>

                </section>
                <section class="row h-100 vera-quote accent-background no-gutters">
                    <div class="col-md-6 mx-auto p-5 textured">
                        <img class="rounded-circle p-3" src="<?php echo get_field( 'featured_quote_image' )['url'];?>" />
                    </div>
                    <div class="col-md-6">
                        <div class="row no-gutters h-100 align-items-center text-center">
                            <div class="col-md-12">
                                <p class="quote-text"><?php the_field('quote_text'); ?></p>
                                <span class="author"><?php the_field('quote_author'); ?></span>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="row no-gutters">
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
                            <a href="<?php the_field('cfa_block_submit_url'); ?>" class="btn bordered-button btn-outline-primary">Submit A Proposal</a>
                        </div>

                </section>

	            <?php get_template_part('partial-templates/support-block'); ?>

            </div>
        </main><!-- #main -->

    </div><!-- #content -->

</div><!-- .wrapper -->


<?php get_footer(); ?>
