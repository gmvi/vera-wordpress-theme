<?php
/**
 * Template Name: Program Landing Page
 *
 * Landing page template for directing users within a top-level section of the site
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<main class="site-main" id="main" role="main">

			<?php the_post(); // This is a page template ?>

				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

					<?php get_template_part('partial-templates/titlecard-fullwidth'); ?>

					<div class="entry-content text-center">

						<section class="info">
							<div class="row header-main">
								<div class="col-md-12">
									<h3><?php the_field('header'); ?></h3>
								</div>
							</div><!-- .section-header -->
							<div class="row body-main">
								<div class="col-md-12">
									<?php the_content(); ?>
								</div>
							</div><!-- .section-body -->
						</section><!-- .section-main -->
			
						<section class="featured">
						<?php
						$max = max(0, min(3, get_field("num_feature_blocks")));
						for ($i = 1; $i <= $max; $i++) {
							$field_prefix="block_".$i."_";
						?>
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-5 featured-image">
									<img src="<?php the_field($field_prefix."image") ?>">
								</div>
								<div class="col-md-5 featured-info">
									<h2><?php the_field($field_prefix."title") ?></h2>
									<p><?php the_field($field_prefix."content") ?></p>
									<a class="more" href="<?php the_field($field_prefix.'link') ?>">
										<?php the_field($field_prefix."linktext") ?>
									</a>
								</div>
							</div>
						<?php } ?>
						</section>

						<section class="banner">
							<div class="banner-background"></div>
							<div class="row no-gutters">
								<div class="col-md-6">
									<span class="label">Get Involved</span>
									<div class="banner-headline">Volunteer Today!</div>
									<a href class="more">Join The Committee</a>
								</div>
								<div class="col-md-6">
								</div>
							</div>
						</section><!-- .section-banner -->

						<section class="quote">
							<div class="background"></div>
							<div class="row no-gutters">
								<div class="col-md-12">
									<div class="quote-picture">
									</div>
									<div class="quote-body">
										<p class="quote-text"><?php the_field("quote_text") ?></p>
										<span class="quote-author">
											<?php // replace spaces with non-breaking
												// TODO: break this out into it's own function to handle links properly
												$content = get_field("quote_author");
												echo str_replace(' ', '&nbsp;', $content);
											?>
										</span>
									</div>
								</div>
							</div>
						</section>

						<section class="donate">
							Support Vera! <b>Donate Today!</b>
						</section>

						<?php
						//wp_link_pages( array(
						//	'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
						//	'after'  => '</div>',
						//) );
						?>

					</div><!-- .entry-content -->

				</article><!-- #post-## -->
		
		</main><!-- #main -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
