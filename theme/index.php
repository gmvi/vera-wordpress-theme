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

<div class="attachment-post-thumbnail">
	<img width="745" height="291" src="<?php echo get_template_directory_uri();?>/images/media_home.jpg">
</div>

<div id="content" class="site-content with-left-nav clear">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<div class="left-nav">

	<h3>UPCOMING SHOWS</h3>

	<?php
	$events = vera_get_events();

	echo "<ul class=\"events\">";
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
	echo "</ul>";
	?>

	</div>

	<?php get_sidebar(); ?>

</div><!-- #content -->

<?php get_footer(); ?>
