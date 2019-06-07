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
                        global $post;
                        // get menu name based off slug
                        $menu_name=$post->post_name;
                        $wrapper_class_name = 'entry-header';
                        include( locate_template( 'partial-templates/centered-submenu.php') );
                    ?>
					<div id="content" class="entry-content text-center">
                        <?php get_template_part('partial-templates/pageblurb'); ?>

						<section class="featured">
						<?php foreach ($program_types as $i => $program) { ?>
                            <div class="row justify-content-around pb-4 no-gutters">
                                <div class="col-md-5">
                                    <img class="featured-image p-2" src="<?php echo wp_get_attachment_url($program['program_type_image']) ?>"/>
                                </div>
                                <div class="col-md-5">
                                    <div class="row pl-2 no-gutters">
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

						<?php get_template_part('partial-templates/support-block'); ?>

						<section class="quote pt-0">
							<div class="background"></div>
                            <div class="row h-100 vera-quote no-gutters">
                                <div class="col-md-6 mx-auto p-5 textured">
                                    <img class="rounded-circle p-3" src="<?php echo get_field( 'featured_quote_image' )['url'];?>" />
                                </div>
                                <div class="col-md-6">
                                    <div class="row h-100 align-items-center text-center no-gutters mb-5">
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
