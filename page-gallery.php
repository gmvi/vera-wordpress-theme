<?php
/**
 * Get Involved template.
 *
 */

get_header();

// Get container type from Wordpress Customizer
$container = get_theme_mod( 'understrap_container_type' );

$gallery = vera_gallery_get_overview();

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

                <section id="up-next-gallery" class="row no-gutters">
                    <div class="col-sm-12 col-md-6 d-flex flex-column justify-content-center align-items-start">
                        <p class="label">Up Next</p>
                        <h2 class="medium-header mb-1">
                            <a href="<?php echo get_permalink($gallery['up_next']->ID); ?>">
                            <?php echo $gallery['up_next']->post_title; ?>
                            </a>
                        </h2>
                    </div>

                    <div id="up-next-times" class="col-sm-12 col-md-6 p-sm-3 p-lg-5 text-white d-flex flex-column justify-content-center text-justify">
                        <p class="m-0 pt-2 w-50">
                            <?php
                            $up_next_start = get_field('gallery_opening_datetime', $gallery['up_next']->ID);
                            $formatted_opening_date = DateTime::createFromFormat('F j, Y h:i a', $up_next_start);

                            echo $formatted_opening_date->format('F j') . ' - ' . get_field('gallery_end_date', $gallery['up_next']->ID); ?>
                        </p>
                        <p class="m-0 w-50">
                            Opening: <?php echo $formatted_opening_date->format('F j, h:i a') ?>
                        </p>
                    </div>
                </section>

                <section id="past-gallery" class="row no-gutters">
                    <div class="col-lg-6 col-md-10 d-flex justify-content-center align-items-center flex-column m-auto p-4">
                        <p class="label">Past Shows</p>
                        <h2 class="medium-header"><?php the_field('former_gallery_title'); ?></h2>
                        <p class="pt-2"><?php the_field('former_gallery_text'); ?></p>
                    </div>

                    <?php

                    foreach ($gallery['past'] as $past_gallery) {

                        $gallery_img_url = get_the_post_thumbnail_url( $past_gallery->ID );
                        $gallery_title = $past_gallery->post_title;
                        $gallery_desc = get_field('description', $past_gallery->ID );

                        ?>

                        <div class="container past-gallery-item d-none">
                            <div class="row">
                                <div class="col-md-6 past-gallery-img">
                                    <div class="square-past-gallery">
                                        <div style="background-image: url(<?php echo $gallery_img_url; ?>)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5 py-5 past-gallery-info d-flex flex-column justify-content-between">

                                    <div>
                                        <h3><?php echo $gallery_title; ?></h3>
                                        <p class="mt-3"><?php echo $gallery_desc; ?></p>
                                    </div>

                                    <div>
                                        <div class="float-left past-gallery-nav">
                                            <button class="btn bordered-button btn-outline-primary" id="prev-gallery-item">❮</button>
                                            <button class="btn bordered-button btn-outline-primary" id="next-gallery-item">❯</button>
                                        </div>
                                        <div class="float-right past-gallery-index">
                                            <span class="gallery-index"></span>
                                            <span>
                                                &#8213; <?php echo pad_zeroes(sizeof($gallery['past'])); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php
                    }

                    ?>

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
