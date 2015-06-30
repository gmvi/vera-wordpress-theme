<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package The Vera Project
 */
?>

  <footer id="colophon" class="site-footer" role="contentinfo">

    <nav id="site-navigation" class="main-navigation main-navigation-footer" role="navigation">
      <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
    </nav><!-- #site-navigation -->

    <div class="social-links clear">
      <ul>
        <li class="social-1">
          <a href="https://www.facebook.com/theveraproject" target="_blank">
            <span class="screen-reader-text">facebook</span>
          </a>
        </li>
        <li class="social-2">
          <a href="http://www.myspace.com/veraproject" target="_blank">
            <span class="screen-reader-text">myspace</span>
          </a>
        </li>
        <li class="social-3">
          <a href="https://www.twitter.com/veraproject" target="_blank">
            <span class="screen-reader-text">twitter</span>
          </a>
        </li>
        <li class="social-4">
          <a href="https://www.flickr.com/photos/theveraproject/" target="_blank">
            <span class="screen-reader-text">flickr</span>
          </a>
        </li>
        <li class="social-5">
          <a href="http://www.youtube.com/user/veraprojectseattle" target="_blank">
            <span class="screen-reader-text">youtube</span>
          </a>
        </li>
      </ul>
    </div><!-- #social-links -->

    <div class="site-info">
      The Vera Project
      <span class="sep">•</span>
      MAILING ADDRESS: 305 Harrison Street
      <span class="sep">•</span>
      Seattle, WA 98109
      <span class="sep">•</span>
      206.956.8372
      <span class="sep">•</span>
      PHYSICAL LOCATION:
      <a href="http://maps.google.com/maps?q=The+Vera+Project,+warren+ave+n,+Seattle+WA&amp;hl=en&amp;sll=47.6233,-122.35413&amp;sspn=0.020479,0.043645&amp;vpsrc=0&amp;gl=us&amp;hnear=The+Vera+Project,+Warren+Ave+N,+Seattle,+King,+Washington+98109&amp;t=m&amp;z=15" target="_blank">
        View Map
      </a>
    </div><!-- .site-info -->
  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
