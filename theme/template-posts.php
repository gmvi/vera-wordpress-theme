<?php
/**
 * Template Name: Posts
 *
 * Template file for posts pages.
 *
 * @package The Vera Project
 */

get_header(); ?>

<div id="content" class="site-content clear">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php

    query_posts( get_post_meta( get_the_ID(), 'query', true ) );
		while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop.
		wp_reset_query(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>

</div><!-- #content -->

<?php get_footer(); ?>
