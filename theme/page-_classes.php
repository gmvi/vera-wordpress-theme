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

      <?php the_post(); ?>

        <?php the_title( '<header class="page-title">', '</header>' ); ?>

        <div class="entry-content">
          <?php the_content(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
          <?php edit_post_link( __( 'Edit', 'the-vera-project' ), '<span class="edit-link">', '</span>' ); ?>
        </footer><!-- .entry-footer -->

      <?php

        $class_categories = get_terms('class_category');

        foreach ($class_categories as $class_category) {
          echo '<section class="class-category">';
          echo '<header id="' . $class_category->slug . '" class="page-title">' .
               'Classes <font color="#00ccff">/</font> ' .
               $class_category->name . ' Classes</header>';
          $classes = new WP_Query( array(
            'post_type' => 'class',
            'tax_query' => array( array(
              'taxonomy' => 'class_category',
              'terms'    => $class_category->term_id,
             )),
          ));
          while ( $classes->have_posts() ) {
            $classes->the_post();
            get_template_part( 'content', 'class-summary' );
          }
          echo '</section>';
        }

        $other = new WP_Query( array(
          'post_type' => 'class',
          'tax_query' => array( array(
            'taxonomy' => 'class_category',
            'operator' => 'NOT EXISTS',
          )),
        ));
        if ( $other->have_posts() ) {
          echo '<section class="class-category">';
          echo '<header id="more" class="page-title">' .
               'Classes <font color="#00ccff">/</font> More Classes</header>';
          while ( $other->have_posts() ) {
            $other->the_post();
            get_template_part( 'content', 'class-summary' );
          }
          echo '</section>';
        }
        wp_reset_postdata();


      ?>

    </main><!-- #main -->
  </div><!-- #primary -->

  <?php get_sidebar(); ?>

</div><!-- #content -->

<?php get_footer(); ?>