<?php
/**
 * The homepage template file.
 *
 */

get_header();

// Get container type from Wordpress Customizer
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<main class="site-main" id="main">

			<?php the_post(); // no loop here because it's the front page ?>

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				<?php get_template_part('partial-templates/titlecard-fullwidth'); ?>

				<div class="entry-content text-center">

					<section class="info">
						<div class="row header">
							<div class="col-md-12">
								<h3><?php the_field('header'); ?></h3>
							</div>
						</div><!-- .section-header -->
						<div class="row body">
							<div class="col-md-12">
								<?php the_content(); ?>
								<a href class="more">Learn More About Us</a>
							</div>
						</div><!--  -->
					</section><!-- section.info -->

					<section class="concerts">
						<div class="row header">
							<div class="col-md-12">
								<span class="label">Concerts</span>
								<h2><b>On Stage</b></h2>
							</div>
						</div><!-- .header-concerts -->
						<div class="row no-gutters body-concerts">
							<div class="col-md-7">
								<div class="featured-concert">
									<span class="label">Featured Concert</span>
									<div class="presented-by">Soundgig Presents</div>
									<div class="featured-title">Peach Kelli Pop</div>
									<div class="featured-details">
										The Vera Project&nbsp;&nbsp;|&nbsp;&nbsp;7PM Doors
										<br>
										$10 ADV&nbsp;&nbsp;|&nbsp;&nbsp;$12 DOS
									</div>
									<a href class="more">Learn More</a>
								</div>
							</div>
							<div class="col-md-5">
								<div class="concerts-list">
									<div class="list-title">Upcoming Shows</div>

									<ul class="list-body">
										<li class="list-item clearfix">
											<div class="wrapper-left">
												<div class="event-date">Sat, Dec 16, 2017</div>
												<div class="event-title">Freak Heat Waves</div>
											</div>
											<div class="wrapper-right">
												<span class="event-icon icon-ticket"></span>
											</div>
										</li>
										<li class="list-item clearfix">
											<div class="wrapper-left">
												<div class="event-date">Sat, Dec 16, 2017</div>
												<div class="event-title">Bright Moments & the Camas High School Choir</div>
											</div>
											<div class="wrapper-right">
												<span class="event-icon icon-ticket"></span>
											</div>
										</li>
										<li class="list-item clearfix">
											<div class="wrapper-left">
												<div class="event-date">Sat, Dec 16, 2017</div>
												<div class="event-title">La Luz, Savila, Anchient Forest</div>
											</div>
											<div class="wrapper-right">
												<span class="event-icon icon-ticket"></span>
											</div>
										</li>
										<li class="list-item clearfix">
											<div class="wrapper-left">
												<div class="event-date">Sat, Dec 16, 2017</div>
												<div class="event-title">La Luz, Savila, Anchient Forest</div>
											</div>
											<div class="wrapper-right">
												<span class="event-icon icon-ticket"></span>
											</div>
										</li>
									</ul>
									<div class="list-more">View All</div>
								</div>
							</div><!-- .shows-block -->
						</div><!-- .body-concerts -->
					</section><!-- .concerts -->

					<section class="classes">
						<div class="row header">
							<div class="col-md-12">
								<span class="label">Classes</span>
								<h2><b>In The Studio</b></h2>
							</div>
						</div>
						<div class="row body">
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

					<section class="banner">
						<div class="banner-background"></div>
						<div class="row no-gutters">
							<div class="col-md-6">
								<span class="label">Get Involved</span>
								<div class="banner-headline">Volunteer Today!</div>
								<a href class="more">Learn More</a>
							</div>
							<div class="col-md-6">
								<img class="banner-icon">
							</div>
						</div>
					</section><!-- .section-banner -->

					<section class="blog">
						<div class="row header">
							<div class="col-md-12">
								<span class="label">News & Information</span>
								<h2><b>On The Blog</b></h2>
							</div>
						</div>
						<div class="row body-blog">
<?php	query_posts( 'category_name=blog&posts_per_page=3' );
		if ( !have_posts() ) : ?>
							<div class="col-md-12">
								<!-- TODO -->
							</div>
<?php	else :?>
        <div class="row justify-content-md-center pt-5 pb-1">
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
						</div>
						<div class="row">
							<div class="col-md-12">
								<a class="blog-link">View All</a>
							</div>
						</div>
					</section><!-- .section-blog -->
			</article><!-- #post-## -->
	
		</main><!-- #main -->

	</div><!-- #content -->

</div><!-- .wrapper -->

<?php get_footer(); ?>
