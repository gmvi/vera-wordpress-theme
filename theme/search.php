<?php
/**
 * The template for displaying search results pages.
 *
 * @package The Vera Project
 */

get_header(); ?>

<div id="content" class="site-content">

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() and !empty($_GET['s']) ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'the-vera-project' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
      /* Start the Loop */
			while ( have_posts() ) : the_post();
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
			endwhile;

		  the_posts_navigation();
		  ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

  <?php get_sidebar(); ?>

</div><!-- #content -->

<?php get_footer(); ?>
