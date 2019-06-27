<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">
    <?php  include( locate_template( 'partial-templates/embedded-calendar.php')); ?>
    <div class="col-sm-12 donate-footer">
        <?php $donate_link = '<a href="'.esc_url( home_url( '/' ) ).'donate/">Donate Today!</a>';?>
        <h1>Support Vera! <strong><?php echo $donate_link ?></strong></h1>
    </div>
	<div class="<?php echo esc_attr( $container ); ?> p-0">
		<div class="row site-footer no-gutters">
            <div class="footer-overlay"></div>
            <div class="col-sm-12 col-md-6 d-flex flex-column justify-content-center">

                <?php
                $menu_locations = get_nav_menu_locations();
                $menu_id = $menu_locations['footer-menu'];

                $footer_nav = wp_get_nav_menu_items($menu_id);

                if ($footer_nav) {
                    $footer_nav_rows = array_chunk($footer_nav,2);

                    foreach ($footer_nav_rows as $footer_row):
                        echo "<div class=\"row\">";
                        foreach ($footer_row as $footer_item):
                            echo "<div class=\"col-6\">";
                            echo "<div class=\"footer-link\">" . "<a href=" . $footer_item->url . ">" . $footer_item->title . "</a></div>";
                            echo "</div>";
                        endforeach;
                        echo "</div>";
                    endforeach;
                }
                ?>
                <div class="vera-bordered-social-icons pl-3 pt-3">
                    <a href="https://www.facebook.com/theveraproject" target="_blank"><i class="fa fa-facebook-f"></i></a>
                    <a href="https://twitter.com/veraproject" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.instagram.com/veraproject" target="_blank"><i class="fa fa-instagram"></i></a>
                    <a href="https://www.youtube.com/channel/UC9lDuHiBg44veM-eEN_tXPg" target="_blank"><i class="fa fa-youtube-play"></i></a>
                </div>
			</div>
            <div class="col-md-1 d-none d-md-block">
            </div>
			<div class="col-sm-12 col-md-5 d-flex flex-column justify-content-center">
				<div class="footer-title">
					The Vera Project
				</div>
				<div class="footer-content">
					At the corner of Warren and Republican<br/>
					305 Harrison Street, Seattle, WA 98109<br/>
					+1 206 956 8372
				</div>
				<div class="footer-directions footer-link">
					<span class="icon icon-pin"></span>
                    <a href="https://goo.gl/maps/sKuTB6SrMr12" target="_blank">Directions</a>
				</div>
			</div>
		</div><!-- row end -->
	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

