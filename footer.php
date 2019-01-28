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
    <div class="col-sm-12 donate-footer">
        <h1>Support Vera! <strong>Donate Today!</strong></h1>
    </div>
	<div class="<?php echo esc_attr( $container ); ?>">
		<div class="row site-footer">
			<div class="col-md-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="footer-link">About</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="footer-link">Get Involved</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="footer-link">Rentals</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="footer-link">Shows</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="footer-link">Silkscreen</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="footer-link">Audio & Stage</div>
                    </div>
                </div>
                <div class="vera-bordered-social-icons pl-3 pt-3">
                    <i class="fa fa-facebook-f"></i>
                    <i class="fa fa-twitter"></i>
                    <i class="fa fa-instagram"></i>
                    <i class="fa fa-youtube-play"></i>
                </div>
			</div>
            <div class="col-md-1 d-none d-md-block">
            </div>
			<div class="col-sm-12 col-md-5">
				<div class="footer-title">
					The Vera Project
				</div>
				<div class="footer-content">
					At the corner of Warren and Republican<br/>
					305 Harrison Street, Seattle, WA 98109<br/>
					+1 206 956 8372
				</div>
				<div class="footer-directions">
					<span class="icon icon-pin"></span>
					Directions
				</div>
			</div>

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

