<?php
/**
 * Search results partial template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <?php if (!has_post_thumbnail( get_the_ID() )) {
        ?>
        <div class="search-info">
            <header class="entry-header">
                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                    '</a></h2>' ); ?>

                <?php if ( 'post' == get_post_type() ) : ?>

                    <div class="entry-meta">

                        <?php understrap_posted_on(); ?>

                    </div><!-- .entry-meta -->

                <?php endif; ?>

            </header><!-- .entry-header -->

            <div class="entry-summary">

                <?php the_excerpt(); ?>

            </div><!-- .entry-summary -->

            <footer class="entry-footer">

                <?php understrap_entry_footer(); ?>

            </footer><!-- .entry-footer -->
        </div>
    <?php
    } else {
        ?>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="search-image-wrapper">
                    <img class="search-image img-fluid" src="<?php echo get_the_post_thumbnail_url( get_the_ID() ); ?>" />
                </div>
            </div>
            <div class="col-sm-12 col-md-6 search-info">
                <header class="entry-header">
		            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			            '</a></h2>' ); ?>

		            <?php if ( 'post' == get_post_type() ) : ?>

                        <div class="entry-meta">

				            <?php understrap_posted_on(); ?>

                        </div><!-- .entry-meta -->

		            <?php endif; ?>

                </header><!-- .entry-header -->

                <div class="entry-summary">

		            <?php the_excerpt(); ?>

                </div><!-- .entry-summary -->

                <footer class="entry-footer">

		            <?php understrap_entry_footer(); ?>

                </footer><!-- .entry-footer -->
            </div>
        </div>
    <?php
    }?>
</article><!-- #post-## -->
