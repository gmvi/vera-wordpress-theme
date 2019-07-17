<?php
/**
 *
 * Template for single gallery page
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper single-gallery-page" id="full-width-page-wrapper">

    <div class="<?php echo esc_attr( $container ); ?> p-0">

        <main class="site-main" id="main" role="main">
			<?php the_post(); ?>

            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

            <?php
                $title = get_the_title();
                $subtitle = get_field('description');

                $gallery_start = get_field('gallery_opening_datetime');

                if ($gallery_start) {
	                $formatted_opening_date = DateTime::createFromFormat('F j, Y h:i a', $gallery_start);
	                $tagline = 'Opening: ' . $formatted_opening_date->format('F j, h:iA');
                }

                include( locate_template( 'partial-templates/half-or-block-header.php'));

                //get artist information
                $artist = get_field('artist');

				?>
                <div id="content" class="entry-content container">
                    <div class="row p-4 py-sm-4 px-sm-0 ml-1 no-gutters">
                        <div class="col-sm-5 col-lg-3 order-sm-12">
                            <div class="card mx-auto artist mb-4">
			                    <?php

			                    if (trim($artist['photo']) !== '') {
				                    echo "<img class=\"card-img-top\" src=\"" . $artist['photo'] . "\" alt=\"" . $artist['title'] . "\">";
			                    }

			                    ?>

                                <div class="card-footer">
                                    <h1 class="card-title mb-2"><?php echo $artist['title']; ?></h1>
                                    <p class="card-text mt-2"><?php echo $artist['bio']; ?></p>
                                    <div class="artist-social vera-bordered-social-icons">
					                    <?php if (!empty($artist['social_details'])) {
						                    foreach($artist['social_details'] as $social) {
							                    echo "<a href=\"" . $social['link'] . "\" target=\"_blank\">";
							                    switch ($social['type']) {
								                    case 'Facebook':
									                    echo "<i class=\"fa fa-facebook-f text-primary\"></i>";
									                    break;
								                    case 'Instagram':
									                    echo "<i class=\"fa fa-instagram text-primary\"></i>";
									                    break;
								                    case 'Twitter':
									                    echo "<i class=\"fa fa-twitter text-primary\"></i>";
									                    break;
								                    case 'Website':
									                    echo "<i class=\"fa fa-globe text-primary\"></i>";
									                    break;
								                    case 'Spotify':
									                    echo "<i class=\"fa fa-spotify text-primary\"></i>";
									                    break;
								                    case 'Soundcloud':
									                    echo "<i class=\"fa fa-soundcloud text-primary\"></i>";
									                    break;
								                    case 'Bandcamp':
									                    echo "<i class=\"fa fa-bandcamp text-primary\"></i>";
									                    break;
								                    case 'Youtube':
									                    echo "<i class=\"fa fa-youtube-play text-primary\"></i>";
									                    break;
								                    case 'Snapchat':
									                    echo "<i class=\"fa fa-snapchat text-primary\"></i>";
									                    break;
							                    }

							                    echo "</a>";
						                    }
					                    } ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 col-lg-9 blog-contents gallery-contents">
							<?php the_content()?>
                            <a class="btn bordered-button btn-outline-primary" href="<?php the_field('gallery_button_link'); ?>"><?php the_field('gallery_button_label')?></a>

                            <?php

                            $extra_info= get_field('additional_info');
                            $extra_info_title = $extra_info['title'];
                            $extra_info_content = $extra_info['content'];

                            if (trim($extra_info_title) !== '' || trim($extra_info_content) !== '') {
                            ?>
                                <h4 class="color-dark-gray mb-3 mt-5"><?= $extra_info_title ?></h4>
                                <?= $extra_info_content ?>
                            <?php
                            }

                            ?>

                        </div>
                    </div>
                </div>

            </article><!-- #post-## -->

        </main><!-- #main -->

    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
