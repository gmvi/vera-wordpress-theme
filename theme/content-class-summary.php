<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Vera Project
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<p class="entry-summary">
		<?php the_excerpt(); ?>
	</p><!-- .entry-summary -->

	<footer class="entry-footer">
		<a href="<?php the_permalink(); ?>">
	    <img src="<?php echo get_template_directory_uri();?>/images/b_more.gif">
	  </a>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
