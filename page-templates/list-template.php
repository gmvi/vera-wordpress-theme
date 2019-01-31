<?php
/**
 * Template Name: List Template
 *
 * Template for rendering lists of things
 */

//todo: talk w/ jessi to make sure I'm setting up submenu correctly

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$list_items = SCF::get( 'Items' );
?>

    <div class="wrapper" id="full-width-page-wrapper">
        <div class="<?php echo esc_attr( $container ); ?> p-0 list-template-page">
            <main class="site-main" id="main" role="main">
				<?php
                get_template_part( 'partial-templates/block-header' );

                global $post;
				$wrapper_class_name = 'entry-header';
				$menu_name = get_post_field( 'post_name', $post->post_parent );
                include( locate_template( 'partial-templates/centered-submenu.php') );

				while ( have_posts() ) : the_post(); ?>
                    <div class="container">
                        <div class="centered-text my-5"><?php the_content() ?></div>
                    </div>

					<?php foreach ( $list_items as $i => $item ) { ?>
                        <div class="list-wrapper">
                            <div class="container">
                                <div class="row no-gutters template-item">
                                    <div class="col-sm-12 col-md-6">
                                        <img src="<?php echo wp_get_attachment_url( $item['item_image'] ); ?>"/>
                                    </div>
                                    <div class="col-sm-12 col-md-6 d-flex flex-column justify-content-center">
                                        <h2 class="large-header">
                                            <?php echo $item['item_header']; ?>
                                        </h2>
                                        <p><i><?php echo $item['item_subheader']; ?></i></p>
                                        <div class="paragraph-content">
                                            <?php echo $item['item_content'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

					<?php } ?>
				<?php endwhile; ?>

            </main>
        </div>
    </div>


<?php get_footer(); ?>