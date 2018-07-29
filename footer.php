<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row site-footer">

			<div class="col-md-6">
			</div>
			<div class="col-md-6">
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

