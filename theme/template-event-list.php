<?php
/**
 * Template Name: Event List
 *
 * Template file for lists of events (such as gallery shows).
 *
 * @package The Vera Project
 */

get_header(); ?>

<div id="content" class="site-content clear">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
    <header class="page-title"><?php the_title(); ?></header>

		<?php

    $post_type = get_post_meta( get_the_ID(), 'post_type', true );
    $date_range = get_post_meta( get_the_ID(), 'date_range', true );
    $today = date( 'Y-m-d H:i' ); // now, formatted like start and end dates

    if ($date_range == "current") {
      $meta_query = array(
        array(
          'key' => '_mem_start_date',
          'value' => $today,
          'compare' => '<=',
        ),
        array(
          'key' => '_mem_end_date',
          'value' => $today,
          'compare' => '>=',
        ),
      );
      $meta_key_orderby = '_mem_end_date';
    } elseif ($date_range == "future") {
      $meta_query = array(
        array(
          'key' => '_mem_start_date',
          'value' => $today,
          'compare' => '>',
        ),
      );
      $meta_key_orderby = '_mem_start_date';
    } elseif ($date_range == "past") {
      $meta_query = array(
        array(
          'key' => '_mem_end_date',
          'value' => $today,
          'compare' => '<',
        ),
      );
      $meta_key_orderby = '_mem_end_date';
    }

    $the_query = new WP_Query( array(
      'post_type' => $post_type,
      'meta_query' => $meta_query,
      'order_by' => 'meta_value',
      'order' => 'ASC',
      'meta_key' => $meta_key_orderby,
    ));

		while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

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
