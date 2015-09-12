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

        $classes = (new WP_Query( array( 'post_type' => 'class' )))->posts;
        $class_categories = (new WP_Query( array( 'post_type' => 'class_category')))->posts;
        $buckets = array();

        foreach ( $class_categories as $category ) {
          $buckets[$category->post_name] = array();
        }
        $buckets[""] = array();
        foreach ( $classes as $class ) {
          $category = get_post_meta( $class->ID, '_category', true );
          array_push($buckets[$category], $class);
        }
        foreach ( $class_categories as $category ) {
          echo '<section class="class-category">';
          echo '<header id="' . $category->post_name . '" class="page-title">' .
               'Classes <font color="#00ccff">/</font> ' .
               $category->post_title . ' Classes</header>';
          foreach ( $buckets[$category->post_name] as $class ) {
            global $post;
            $post = $class;
            setup_postdata( $post );
            get_template_part( 'content', 'class-summary' );
          }
          echo '</section>';
        }

        if ( !empty($buckets[""]) ) {
          echo '<section class="class-category">';
          echo '<header id="more" class="page-title">' .
               'Classes <font color="#00ccff">/</font> More Classes</header>';
          foreach ( $buckets[""] as $class ) {
            global $post;
            $post = $class;
            setup_postdata( $post );
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

<script type="text/javascript">
  smoothScroll.init({
    easing: 'easeInOutCubic'
  });
</script>

<?php get_footer(); ?>