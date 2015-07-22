<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Vera Project
 */

get_header(); ?>

<!-- <div class="attachment-post-thumbnail">
	<img width="745" height="291" src="<?php echo get_template_directory_uri();?>/images/media_home.jpg">
</div> -->

<div id="content" class="site-content clear">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php

    query_posts( 'category_name=blog' );
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
