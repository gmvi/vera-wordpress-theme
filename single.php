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
                <div class="row" style="max-height:25rem;">
                    <?php
                    if (has_post_thumbnail( get_the_ID() )) { ?>
                        <div class="col-sm-6">
                            <img  class="h-100" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full')?>" style="object-fit:cover;width: 100%;overflow:hidden;">
                        </div>
                        <div class="col-sm-6">
                            <h1><?php the_title()?></h1>
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
                <div class="row">
                    <div class="col-sm-12 text-center"><?php the_content()?></div>
                </div>
                <?php
                /* End the Loop */
                endwhile; ?>
            </div>
            <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();



                if ( is_singular( 'attachment' ) ) {
                    // Parent post navigation.
                    the_post_navigation(
                        array(
                            /* translators: %s: parent post link */
                            'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'twentynineteen' ), '%title' ),
                        )
                    );
                } elseif ( is_singular( 'post' ) ) {
                    // Previous/next post navigation.
                    the_post_navigation(
                        array(
                            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Post', 'twentynineteen' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Next post:', 'twentynineteen' ) . '</span> <br/>' .
                                '<span class="post-title">%title</span>',
                            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Post', 'twentynineteen' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Previous post:', 'twentynineteen' ) . '</span> <br/>' .
                                '<span class="post-title">%title</span>',
                        )
                    );
                }

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php
get_footer();
