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
                <div class="row no-gutters">
                    <?php
                    if (has_post_thumbnail( get_the_ID() )) { ?>
                        <div class="col-sm-6 p-0 mh-100" style="">
                            <img class="h-100 single-blog-featured-image" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full')?>">
                        </div>
                        <div class="col-sm-6 p-0 mh-100 single-blog-featured-text">
                            <div class="textured-blerg">
                                <div class="row no-gutters justify-content-center pt-5 ">
                                    <div class="col-sm-8 mr-2 ml-2">
                                        <?php get_template_part('partial-templates/category-labels'); ?>
                                        <h2 class="single-blog-title text-white"><?php the_title()?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                        ?>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-11 mt-2">
                            <?php get_template_part('partial-templates/category-labels'); ?>
                            <h2 class="single-blog-title text-dark mb-0 mt-1"><?php the_title()?></h2>
                        </div>
                        <?php
                    } ?>
                </div>
                <div class="row no-gutters pt-5 pb-4">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-7 pb-3 blog-contents pr-3">
                        <p class="metadata">Posted on <?php the_date()?> by <a href="#"><?// FIXME: get_the_author_meta('user_url')?><?php echo get_the_author_meta('display_name') ?></a></p>
                        <?php the_content()?>
                        <hr class="pb-2"/>
                        <p class="share-call mb-1">Share this story</p>
                        <?php get_template_part('partial-templates/share-post-icons') ?>
                    </div>
                    <div class="col-sm-4">
                        <div style="background-color:#ebeeef;" class="pt-3 pb-3 pr-2 pl-2 mr-3">
                            <div class="row no-gutters m-3 recent-posts mr-1">
                                <div class="col-sm-12">
                                    <h2 class="pt-3">Recent Posts</h2>
                                    <hr/>
                                    <ul style="list-style-type:none;" class="pl-0">
                                        <?php
                                        $args = array( 'numberposts' => '5' );
                                        $recent_posts = wp_get_recent_posts($args);
                                        $lastElement = end($recent_posts);
                                        foreach( $recent_posts as $recent ){ ?>
                                            <?php if (get_the_ID() !== $recent["ID"] && $recent["post_title"] !== ""): ?>
                                                <li class="pb-0">
                                                    <p class="mb-0 date"><?php echo get_the_date( 'F j, Y', $recent["ID"]) ?></p>
                                                    <a class="text-primary" href="<?php echo get_permalink($recent["ID"])?>"><?php echo $recent["post_title"]?></a>
                                                </li>
                                                <?php if (!($lastElement == $recent)) echo '<hr class="mt-2 mb-2"/>' ?>
                                            <?php endif ?>

                                        <?php }
                                        wp_reset_query();
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                /* End the Loop */
                endwhile; ?>
            </div>
        </main><!-- #main -->
    </section><!-- #primary -->

<?php
get_footer();
