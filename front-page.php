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

				<div class="row">

					<div class="col-md-12">
						<!-- <?php the_title( '<h2 class="entry-title">', '</a></h2>' ); ?> -->
						<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

					</div>

				</div><!-- .entry-header -->
				<div class="section-main">
					<div class="row header-main">
						<div class="col-md-12">
							<h3><?php the_field('header'); ?></h3>
						</div>
					</div><!-- .section-header -->
					<div class="row body-main">
						<div class="col-md-12">
							<?php the_content(); ?>
							<a href class="more">Learn More About Us</a>
						</div>
					</div><!-- .section-body -->
				</div><!-- .section-main -->

				<div class="section-concerts">
					<div class="row header-concerts">
						<div class="col-md-12">
							<span class="label">Concerts</span>
							<h2><b>On Stage</b></h2>
						</div>
					</div>
					<div class="row body-concerts">
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
					</div><!-- .col-md-12 -->
				</div><!-- .row -->

				<div class="section-classes">
					<div class="row header-classes">
						<div class="col-md-12">
							<span class="label">Classes</span>
							<h2><b>In The Studio</b></h2>
						</div>
					</div>
					<div class="row body-classes">
						<div class="col-md-1">
						</div>
						<div class="col-md-5">
							<div class="card card-silkscreen">
								<div class="card-image"></div>
								<a href class="card-title">
									Silkscreen
									<div class="icon-arrow"></div>
								</a>
							</div>
						</div>
						<div class="col-md-5">
							<div class="card card-silkscreen">
								<div class="card-image"></div>
								<a href class="card-title">
									Audio & Stage
									<div class="icon-arrow"></div>
								</a>
							</div>
						</div>
						<div class="col-md-1">
						</div>
					</div>
				</div>

				<div class="section-banner">
					<div class="banner-background"></div>
					<div class="row">
						<div class="col-md-12 banner-body">
							<span class="label">Get Involved</span>
							<div class="banner-headline">Volunteer Today</div>
							<a href class="more">Learn More</a>
						</div>
					</div>
				</div><!-- .section-banner -->

				<div class="section-blog">
					<div class="row header-blog">
						<div class="col-md-12">
							<span class="label">News</span>
							<h2><b>On The Blog</b></h2>
						</div>
					</div>
					<div class="row body-blog">
<?php	query_posts( 'category_name=blog&posts_per_page=3' );
		if ( !have_posts() ) : ?>
						<div class="col-md-12">
							<!-- TODO -->
						</div>
<?php	else :
			while ( have_posts() ) : the_post(); ?>
						<div class="blog-item col-md-4">
							<div class="blog-image-wrapper"><?php the_post_thumbnail(); ?></div>
							<div class="blog-date"><?php echo get_the_date(); ?></div>
							<div class="blog-title"><?php the_title(); ?></div>
							<div class="blog-content"><?php the_content(); ?></div>
							<a href="<?php the_permalink();?>" class="more">Read More</a>
						</div>
<?php		endwhile; // end of the loop.
		endif;
		wp_reset_query(); ?>
					</div>
					<div class="row">
						<div class="col-md-12">
							<a class="blog-link">View All</a>
						</div>
					</div>
				</div><!-- .section-blog -->

				<div class="section-donate">
					Support Vera! <b>Donate Today!</b>
				</div>
			</article><!-- #post-## -->
	
		</main><!-- #main -->

	</div><!-- #content -->

</div><!-- .wrapper -->

<?php get_footer(); ?>
