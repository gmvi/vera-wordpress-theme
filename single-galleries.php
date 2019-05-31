<?php
/**
 *
 * Template for single gallery page
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="full-width-page-wrapper">

    <div class="<?php echo esc_attr( $container ); ?> p-0">

        <main class="site-main" id="main" role="main">

			<?php the_post(); // TODO: take this out, see what happens ?>

            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

            <?php

                $title = get_the_title();
                //TODO: should we calculate "label" for show you're currently looking at?
                //pro: accurate. con: query every time a gallery page loads
                $tag = 'current show';
                $subtitle = get_field('description');

                include( locate_template( 'partial-templates/half-or-block-header.php'));

                //get artist information
                $artist = get_field('artist');
				?>
                <div id="content" class="entry-content container">
                    <div class="row pt-4 pb-4 ml-1 no-gutters">
                        <div class="col-sm-9 pb-3">
							<?php the_content()?>
                        </div>
                        <div class="col-sm-3">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="<?php echo $artist['photo']; ?>" alt="Card image cap">
                                <div class="card-footer">
                                    <h1 class="card-title"><?php echo $artist['title']; ?></h1>
                                    <p class="card-text mt-2"><?php echo $artist['bio']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </article><!-- #post-## -->

        </main><!-- #main -->

    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
