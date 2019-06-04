<?php
/**
 * Get Involved template.
 *
 */

get_header();

// Get container type from Wordpress Customizer
$container = get_theme_mod( 'understrap_container_type' );

$gallery = vera_gallery_get_overview();

error_log('just finished calling get overview function');
error_log(print_r($current_and_next, true));

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
                                <h2 class="medium-header mb-1"><?php echo $gallery['current']->post_title; ?></h2>
                                <p><?php the_field('description', $gallery['current']->ID); ?></p>
                                <p><b>Exhibit up until <?php the_field('gallery_end_date', $gallery['current']->ID); ?><br>
                                        Opening: <?php the_field('gallery_opening_datetime', $gallery['current']->ID); ?></b></p>
                                <a href="<?php echo get_permalink($gallery['current']->ID); ?>" class=" btn bordered-button btn-outline-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="current-gallery-container">
                            <img class="current-gallery-image img-fluid" src="<?php echo get_the_post_thumbnail_url( $gallery['current']->ID ); ?>" />
                        </div>
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
                <section id="gallery-coa" class="row no-gutters">
                        <div class="col-md-5 p-5">
                            <p class="label">Get Involved</p>
                            <h2 class="medium-header mb-1"><?php the_field('committee_block_header'); ?></h2>
                            <p><?php the_field('committee_block_description'); ?></p>
                            <a href="<?php the_field('committee_block_contact_url'); ?>" class="btn bordered-button btn-outline-primary">Contact the committee</a>

                        </div>
                        <div class="col-md-1 d-none d-md-block vertical-line"></div>
                        <div class="col-md-1 d-none d-md-block"></div>
                        <div class="col-md-5 p-5">
                            <p class="label">Call For Artists</p>
                            <h2 class="medium-header mb-1"><?php the_field('cfa_block_header'); ?></h2>
                            <p><?php the_field('cfa_block_description'); ?></p>
                            <a href="<?php the_field('cfa_block_submit_url'); ?>" class="btn bordered-button btn-outline-primary">Submit A Proposal</a>
                        </div>

                </section>

	            <?php
	            $support_footer_color = '#d41c53';
	            include( locate_template( 'partial-templates/support-block.php') );
	            ?>

            </div>
        </main><!-- #main -->

    </div><!-- #content -->

</div><!-- .wrapper -->


<?php get_footer(); ?>
