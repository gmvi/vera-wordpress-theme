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
        function print_category_section($category_name, $category_title) {
          $classes_q = new WP_Query( array(
            'post_type' => 'class',
            'meta_key' => '_order',
            'orderby' => 'meta_value_num ID',
            'order' => 'ASC',
            'meta_query' => array(
              array(
                'key' => '_category',
                'value' => $category_name,
                'compare' => empty($category_name) ? 'NOT EXISTS' : '=',
              )
            ),
          ));
          $category_name = ($category_name == '') ? 'more' : $category_name;
          echo '<section id="' . $category_name . '" class="class-category">';
          echo '<header class="page-title">' .
               'Classes <font color="#00ccff">/</font> ' .
               $category_title . ' Classes</header>';
          foreach ( $classes_q->posts as $class ) {
            global $post;
            $post = $class;
            setup_postdata( $post );
            get_template_part( 'content', 'class-summary' );
          }
          echo '</section>';
        }

        $categories = (new WP_Query( array( 'post_type' => 'class_category')))->posts;

        foreach ( $categories as $category ) {
          print_category_section($category->post_name, $category->post_title);
        }
        print_category_section('', 'More');

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