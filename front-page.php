<?php
/**
 * The homepage template file.
 *
 */

get_header();

// Get container type from Wordpress Customizer
$container = get_theme_mod( 'understrap_container_type' );
$shows = vera_shows_get_front_page();
?>

<div class="wrapper" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<main class="site-main" id="main">

			<?php the_post(); // no loop here because it's the front page ?>

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				<?php get_template_part('partial-templates/titlecard-fullwidth'); ?>

				<div class="entry-content text-center">

					<section class="info px-2 px-md-1 px-lg-0">
						<div class="row header no-gutters">
							<div class="col-md-12">
								<h3><?php the_field('header'); ?></h3>
							</div>
						</div><!-- .section-header -->
						<div class="row body no-gutters">
							<div class="col-md-12">
								<?php the_content(); ?>
								<a href class="more">Learn More About Us</a>
							</div>
						</div><!--  -->
					</section><!-- section.info -->

					<section class="shows">
						<div class="row header no-gutters">
							<div class="col-md-12">
								<span class="label">Concerts</span>
								<h2><b>On Stage</b></h2>
							</div>
						</div><!-- .header-concerts -->
						<?php
							$first_show = array_shift($shows);
							$info = vera_shows_get_all_info($first_show);
						?>
						<div class="row no-gutters body-shows">
							<div class="col-md-7">
								<div class="featured-show">
									<div class="background-image"><img src="<?= $info['image'] ?>"></div>
									<span class="label"><?= $info['label'] ?></span>
									<header>
										<div class="presented-by"><?= $info['presenter'] ?></div>
										<div class="show-headline"><?= $info['title'] ?></div>
										<div class="show-support">with <?= $info['support'] ?></div>
									</header>
									<div class="show-details">
										<?= $info['time'] ?><br>
										<i class="fa fa-map-marker"></i> <?= $info['venue'] ?><br>
										<?= $info['price'] ?>
									</div>
									<a class="more" href=<?= $info['link'] ?> >Tickets</a>
								</div>
							</div>
							<div class="col-md-5">
								<div class="shows-list">
									<div class="list-title">More Upcoming Shows</div>

									<ul class="list-body">
										<?  foreach ($shows as $show):
											$info = vera_shows_get_list_info($show);
										?>
											<li class="list-item clearfix">
												<div class="wrapper-left">
													<div class="event-date"><?= $info['date'] ?></div>
													<div class="event-title">
														<a href="<?= $info['link'] ?>"><?= $info['title'] ?></a>
													</div>
												</div>
												<div class="wrapper-right">
													<span class="event-icon icon-ticket"></span>
												</div>
											</li>
										<? endforeach; ?>
									</ul>
									<div class="list-more">View All</div>
								</div>
							</div><!-- .shows-block -->
						</div><!-- .body-concerts -->
					</section><!-- .concerts -->

					<section class="classes">
						<div class="row header no-gutters">
							<div class="col-md-12">
								<span class="label">Classes</span>
								<h2><b>In The Studio</b></h2>
							</div>
						</div>
						<div class="row body no-gutters">
							<div class="col-md-1"></div>
							<div class="col-md-5">
								<div class="card">
									<div class="card-image"></div>
									<a href class="card-title">
										Silkscreen
										<div class="icon-arrow"></div>
									</a>
								</div>
							</div>
							<div class="col-md-5">
								<div class="card">
									<div class="card-image"></div>
									<a href class="card-title">
										Audio & Stage
										<div class="icon-arrow"></div>
									</a>
								</div>
							</div>
							<div class="col-md-1"></div>
						</div>
					</section>
                    <section class="volunteer-today pb-5 pt-5">
<!--                        <h1>Header Content</h1>-->
                        <svg class="top-cutout" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" preserveAspectRatio="none">
                            <polygon  points="0,0 50,0 50,50"></polygon>
                        </svg>
                        <svg class="bottom-cutout" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" preserveAspectRatio="none">
                            <polygon  points="50,50 0,50 0,0"></polygon>
                        </svg>
                        <div class="content-overlay"></div>
                        <div class="row no-gutters pt-2">
                            <div class="col-md-1"></div>
                            <div class="col-sm-11 offset-sm-1 col-md-5 offset-md-0 text-left mobile-space clickable pt-md-4">
                                <span class="label">Get Involved</span>
                                <h2 class="banner-headline">Volunteer Today!</h2>
<!--                                <div class="banner-headline text-sm-center text-md-left">Volunteer Today!</div>-->
                                <a href="/get-involved" class="more">Learn More</a>
                            </div>
                            <div class="col-md-5 d-none d-md-block">
<!--                                TODO: make configurable -->
                                <img class="pl-3 support-vera-graphic" style="max-height:400px;" src="/wp-content/uploads/2019/01/audio_white_01.png" />
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </section>

					<section class="blog">
						<div class="row header no-gutters">
							<div class="col-md-12">
								<span class="label">News & Information</span>
								<h2><b>On The Blog</b></h2>
							</div>
						</div>
<?php	query_posts( 'category_name=blog&posts_per_page=3' );
		if ( !have_posts() ) : ?>
							<div class="col-md-12">
								<!-- TODO -->
							</div>
<?php	else :?>
        <div class="row justify-content-md-center pb-1 no-gutters">
            <div class="col-sm-11">
                <div class="card-deck pb-2">
                    <?php
                        $numOfCols = 3;
                        include( locate_template( 'partial-templates/blog-list-cards.php') );
                    ?>
                </div>
            </div>
        </div>

<?php   endif;
		wp_reset_query(); ?>
						<div class="row no-gutters">
							<div class="col-md-12">
								<a href="/blog" class="btn bordered-button btn-outline-primary">View All</a>
							</div>
						</div>
					</section><!-- .section-blog -->
			</article><!-- #post-## -->
	
		</main><!-- #main -->

	</div><!-- #content -->

</div><!-- .wrapper -->

<?php get_footer(); ?>
