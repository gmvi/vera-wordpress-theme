<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

    <section id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="container-fluid">
                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();?>
                <!-- header image -->
                <div class="row">
                    <?php
                    if (has_post_thumbnail( get_the_ID() )) { ?>
                        <div class="col-sm-6 p-0 mh-100" style="">
                            <img class="h-100 single-blog-featured-image" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full')?>">
                        </div>
                        <div class="col-sm-6 p-0 mh-100 single-blog-featured-text">
                            <div class="textured-blerg">
                                <div class="row justify-content-center pt-5 ">
                                    <div class="col-sm-8 mr-2 ml-2">
                                        <?php get_template_part('partial-templates/category-labels'); ?>
                                        <h2 class="single-blog-title"><?php the_title()?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                        ?>
                        <div class="col-sm-12">
                            <h1><?php the_title()?></h1>
                        </div>
                        <?php
                    } ?>
                </div>
                <div class="row pt-5 pb-4">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-7 pb-1 blog-contents">
                        <p class="metadata">Posted on <?php the_date()?> by <a href="#"><?// FIXME: get_the_author_meta('user_url')?><?php echo get_the_author_meta('display_name') ?></a></p>
                        <?php the_content()?>
                        <hr class="pb-2"/>
                        <p class="share-call mb-1">Share this story</p>
                        <div class="vera-bordered-social-icons p-0">
                            <i class="fa fa-facebook-f text-primary"></i>
                            <i class="fa fa-twitter text-primary"></i>
                            <i class="fa fa-instagram text-primary"></i>
                        </div>
                    </div>
                    <div class="col-sm-4"><?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('shmight-sidebar') ) ?></div>
                </div>
                <?php
                /* End the Loop */
                endwhile; ?>
            </div>
        </main><!-- #main -->
    </section><!-- #primary -->

<?php
get_footer();
