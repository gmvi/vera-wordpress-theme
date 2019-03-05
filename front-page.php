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

                    <?php get_template_part('partial-templates/pageblurb'); ?>

					<section class="shows">
						<div id="shows-header-text" class="row header m-0 py-3">
							<div class="col-md-12">
                                <span class="label">Concerts</span>
								<h2><b><?php the_field('concert_title_text'); ?></b></h2>
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
										<? if ($info['support']): ?>
											<div class="show-support">with <?= $info['support'] ?></div>
										<? endif; ?>
									</header>
									<div class="show-details">
										<?= $info['date']; ?><br>
										<i class="fa fa-map-marker"></i> <?= $info['venue'] ?><br>
										<?= $info['price'] ?><br>
										<?= $info['time'] ?>
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
                                    <div class="list-more"><a href="http://events.theveraproject.org/" target="_blank">View All</a></div>
								</div>
							</div><!-- .shows-block -->
						</div><!-- .body-concerts -->
					</section><!-- .concerts -->

					<section class="classes">
						<div class="row header no-gutters">
							<div class="col-md-12">
								<span class="label">Classes</span>
								<h2><b><?php the_field('classes_title_text'); ?></b></h2>
							</div>
						</div>
						<div class="row body no-gutters">
							<div class="col-md-1"></div>

							<div class="col-md-5 mb-4 mb-md-0">
								<div class="card">
									<div class="card-image" style="background: url('<?php the_field('classes_left_image'); ?>')"></div>
                                    <div class="card-text-cover d-flex justify-content-between align-items-center px-3 px-lg-5">
                                        <h2><?php the_field('classes_left_feature'); ?></h2>
                                        <a href="<?php the_field('classes_left_link'); ?>">Learn More</a>
                                    </div>
								</div>
							</div>

							<div class="col-md-5">
								<div class="card">
									<div class="card-image" style="background: url('<?php the_field('classes_right_image'); ?>')">
                                    </div>
                                    <div class="card-text-cover d-flex justify-content-between align-items-center px-3 px-md-5">
                                        <h2><?php the_field('classes_right_feature'); ?></h2>
                                        <a href="<?php the_field('classes_right_link'); ?>">Learn More</a>
                                    </div>
								</div>
							</div>

							<div class="col-md-1"></div>
						</div>
					</section>

					<?php
                        $support_footer_color = 'white';
					    include( locate_template( 'partial-templates/support-block.php') );
					?>

					<section class="blog">
						<div class="row header no-gutters">
							<div class="col-md-12">
								<span class="label">News & Information</span>
								<h2><b><?php the_field('blog_title_text'); ?></b></h2>
							</div>
						</div>
<?php	query_posts( 'category_name=blog&posts_per_page=3' );
		if ( !have_posts() ) : ?>
							<div class="col-md-12">
								<!-- TODO: no blog posts are available, need designs for this -->
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
