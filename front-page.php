<?php
/**
 * The homepage template file.
 *
 */

get_header();

// Get container type from Wordpress Customizer
$container = get_theme_mod( 'understrap_container_type' );

$show_args = array (
        'before'    => 0,
        'today'    => 'yes',
        'category'  => 'Shows'
);

$event_shows = mc_get_all_events($show_args);
$featured_show;

//find featured show if it exists
foreach ($event_shows as $show_key => $show) {
	$feature_show = get_post_meta( $show->event_post, '_mc_event_is_featured_show', true );
    $presenter =  get_post_meta( $show->event_post, '_mc_event_show_presenter', true );
	$support =  get_post_meta( $show->event_post, '_mc_event_show_support', true );
	$price =  get_post_meta( $show->event_post, '_mc_event_show_price', true );

	$show->presenter = $presenter;
	$show->support = $support;
	$show->price = $price;

	$show_date_start = DateTime::createFromFormat('Y-m-d', $show->event_begin);
	$show_time_start = DateTime::createFromFormat('H:i:s', $show->event_time);

	$show->show_date_start = $show_date_start;
	$show->show_time_start = $show_time_start;
	$show->detailed_link = mc_get_details_link( $show );

	if ($feature_show) {
	    $featured_show = $show;
	    $featured_show->label = 'Featured Show';
	    unset($event_shows[$show_key]);
    }
}

//if there is no featured show then choose soonest upcoming
if (!$featured_show) {
    $featured_show = $event_shows[0];
	$featured_show->label = 'Next Show';
	unset($event_shows[0]);
}
?>

<div class="wrapper" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<main class="site-main" id="main">

			<?php the_post(); // no loop here because it's the front page ?>

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

                <?php

                $featured_img_url = $featured_show->event_image;
                include( locate_template( 'partial-templates/titlecard-fullwidth.php') );

                ?>

				<div class="entry-content text-center">

                    <?php get_template_part('partial-templates/pageblurb'); ?>

					<section class="shows">
						<div id="shows-header-text" class="row header m-0">
							<div class="col-md-12">
                                <span class="label">Concerts</span>
								<h2><b><?php the_field('concert_title_text'); ?></b></h2>
							</div>
						</div><!-- .header-concerts -->
						<div class="row no-gutters body-shows">
							<div class="col-md-7">
								<div class="featured-show">
									<div class="background-image"><img src="<?= $featured_show->event_image ?>"></div>
									<span class="label"><?= $featured_show->label ?></span>
									<header>
										<div class="presented-by"><?= $featured_show->presenter ?></div>
										<div class="show-headline"><?= $featured_show->event_title ?></div>
                                        <div class="show-support"><?= $featured_show->support ?></div>
									</header>
									<div class="show-details">
										<?= $featured_show->show_date_start->format('D, M j'); ?><br>
										<i class="fa fa-map-marker"></i> <?= $featured_show->event_label ?><br>
										<?= $featured_show->price ?><br>
										<?= $featured_show->show_time_start->format('gA');?>
									</div>
                                    <a class="more" target="_blank" href=<?= $featured_show->detailed_link ?> >Learn More</a>
									<a class="more" target="_blank" href=<?= $featured_show->event_link ?> >Tickets</a>
								</div>
							</div>
							<div class="col-md-5">
								<div class="shows-list">
									<div class="list-title">More Upcoming Shows</div>

									<ul class="list-body">
										<?php
                                        foreach ($event_shows as $event_show) {
                                            ?>
                                            <li class="list-item clearfix">
                                                <div class="wrapper-left">
                                                    <div class="event-date"><?= $event_show->show_date_start->format('D, M j'); ?></div>
                                                    <div class="event-title">
                                                        <a href="<?= $event_show->detailed_link ?>"><?= $event_show->event_title ?></a>
                                                    </div>
                                                </div>
                                                <div class="wrapper-right">
                                                    <a href="<?= $event_show->event_link ?>" target="_blank"><span class="event-icon icon-ticket"><i class="fa fa-ticket fa-2x"></i></span></a>
                                                </div>
                                            </li>

                                    <?php } ?>
									</ul>
                                    <div class="list-more"><a href="<?= the_field('shows_link') ?>" target="_blank">View All</a></div>
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
									<div class="card-image" style="background: url('<?php echo get_field('classes_left_image')['sizes']['medium_large']; ?>')"></div>
                                    <div class="card-text-cover d-flex justify-content-between align-items-center px-3 px-lg-5">
                                        <h4><?php the_field('classes_left_feature'); ?></h4>
                                        <a href="<?php the_field('classes_left_link'); ?>">Learn More</a>
                                    </div>
								</div>
							</div>

							<div class="col-md-5">
								<div class="card">
									<div class="card-image" style="background: url('<?php echo get_field('classes_right_image')['sizes']['medium_large']; ?>')">
                                    </div>
                                    <div class="card-text-cover d-flex justify-content-between align-items-center px-3 px-lg-5">
                                        <h4><?php the_field('classes_right_feature'); ?></h4>
                                        <a href="<?php the_field('classes_right_link'); ?>">Learn More</a>
                                    </div>
								</div>
							</div>

							<div class="col-md-1"></div>
						</div>
					</section>

                    <section class="block">
                        <?php $block_section = get_field('on_the_block'); ?>
                        <div class="row header no-gutters">
                            <div class="col-md-12">
                                <?php

                                if ($block_section['label']) {
                                    echo "<span class=\"label\">" . $block_section['label'] . "</span>";
                                }

                                ?>
                                <h2><b><?php echo $block_section['header']; ?></b></h2>
                            </div>
                        </div>

                        <div class="row justify-content-md-center pb-1 no-gutters">
                            <div class="col-sm-11">
                                <div class="card-deck pb-2">
			                        <?php
			                        $block_image_url = $block_section['left_feature']['feature_image'];
			                        $block_title     = $block_section['left_feature']['feature_title'];
			                        $block_link      = $block_section['left_feature']['feature_link'];

			                        include( locate_template( 'partial-templates/on-the-block-block.php' ) );

			                        $block_image_url = $block_section['center_feature']['feature_image'];
			                        $block_title     = $block_section['center_feature']['feature_title'];
			                        $block_link      = $block_section['center_feature']['feature_link'];

			                        include( locate_template( 'partial-templates/on-the-block-block.php' ) );

			                        $block_image_url = $block_section['right_feature']['feature_image'];
			                        $block_title     = $block_section['right_feature']['feature_title'];
			                        $block_link      = $block_section['right_feature']['feature_link'];

			                        include( locate_template( 'partial-templates/on-the-block-block.php' ) );
			                        ?>
                                </div>
                            </div>
                        </div>

                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <a href="<?php echo $block_section['link_url']; ?>" class="btn bordered-button btn-outline-primary"><?php echo $block_section['link_label']; ?></a>
                            </div>
                        </div>
                    </section><!-- .section-blog -->

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
