<?php
/**
 * Template Name: Program Landing Page
 *
 * Landing page template for directing users within a top-level section of the site
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$program_types = SCF::get( 'Program Types' );

?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?> p-0">

		<main class="site-main" id="main" role="main">

			<?php the_post(); // This is a page template ?>

				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

					<?php get_template_part('partial-templates/titlecard-fullwidth'); ?>
                    <?php
                        $menu_name = get_field('subnav');;
                        $wrapper_class_name = 'entry-header';
                        include( locate_template( 'partial-templates/centered-submenu.php') );
                    ?>
					<div id="content" class="entry-content text-center">

						<section class="info">
							<div class="row header">
								<div class="col-md-12">
									<h3><?php the_field('header'); ?></h3>
								</div>
							</div><!-- .section-header -->
							<div class="row body">
								<div class="col-md-12">
									<?php the_content(); ?>
								</div>
							</div><!-- .section-body -->
						</section><!-- .section-main -->
			
						<section class="featured">
						<?php foreach ($program_types as $i => $program) { ?>
                            <div class="row justify-content-around pb-4">
                                <div class="col-md-5">
                                    <img class="featured-image p-2" src="<?php echo wp_get_attachment_url($program['program_type_image']) ?>"/>
                                </div>
                                <div class="col-md-5">
                                    <div class="row pl-2">
                                        <div class="col-sm-10 align-self-center featured-info pt-4">
                                            <h2><?php echo $program['program_type_header']?></h2>
                                            <p><?php echo $program['program_type_description']?></p>
                                            <a class="btn bordered-button btn-outline-primary" href="<?php echo $program['program_type_signup']?>">sign up</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
						<?php } ?>
						</section>

						<section class="banner">
							<div class="banner-background"></div>
                            <div class="row no-gutters pl-4 ml-4 pr-4 mr-4 landing-donate">
                                <div class="col-md-6 p-4">
                                    <p class="label-white"><?php the_field('support_vera_label') ?></p><br/>
                                    <h1 class="large-header" style="color:white;"><?php the_field('support_vera_text') ?></h1>
                                    <a href="<?php the_field('support_vera_link_url') ?>" class="btn bordered-button-white"><?php the_field('support_vera_link_text') ?></a>
                                </div>
                                <div class="col-md-6 p-1 d-none d-md-block">
                                    <img class="support-vera-graphic pl-3" src="<?php echo get_field( 'support_vera_graphic' )['url'];?>" />
                                </div>
                            </div>
						</section><!-- .section-banner -->

						<section class="quote">
							<div class="background"></div>
                            <div class="row h-100 vera-quote">
                                <div class="col-md-6 mx-auto p-5 textured">
                                    <img class="rounded-circle p-3" src="<?php echo get_field( 'featured_quote_image' )['url'];?>" />
                                </div>
                                <div class="col-md-6">
                                    <div class="row h-100 align-items-center text-center">
                                        <div class="col-md-12">
                                            <p class="quote-text pr-1"><?php the_field('quote_text'); ?></p>
                                            <span class="author"><?php the_field('quote_author'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
