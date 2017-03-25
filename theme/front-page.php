<?php
/**
 * Template file for the home page.
 *
 * @package The Vera Project
 */

get_header(); ?>

<!-- <div class="attachment-post-thumbnail">
	<img width="745" height="291" src="<?php echo get_template_directory_uri();?>/images/media_home.jpg">
</div> -->

<div id="content" class="site-content with-left-nav clear">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<header class="blog-title">Vera Project Blog</header>

		<?php

    query_posts( 'category_name=blog&posts_per_page=3' );
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

	<div class="left-nav">

	<h3>UPCOMING SHOWS</h3>

	<ul class="events">
		<?php
		$events = vera_get_events();
		foreach ($events as $event) {
			?>
			<li class="event">
				<div class="event-date">
					<span class="month"><?php echo date("M", $event['date']); ?></span>
					<span class="day"><?php echo date("d", $event['date']); ?></span>
				</div>
				<div class="event-info">
					<?php echo $event['title']; ?>
					<?php if ($event['buy_url']) {
						echo "<a class=\"tickets-link\" href=\"${event['buy_url']}\" target=\"_blank\"></a>";
					} ?>
				</div>
			</li>
			<?php
		}
		?>

		</ul>
	</div>

	<?php get_sidebar(); ?>

</div><!-- #content -->

<?php get_footer(); ?>
