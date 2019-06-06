<?php
/**
 * Template Name: List Template
 *
 * Template for rendering lists of things
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$list_items = get_field('items');
echo "<pre>" . print_r($list_items, true) . "</pre>"; 
?>

    <div class="wrapper" id="full-width-page-wrapper">
        <div class="<?php echo esc_attr( $container ); ?> p-0 list-template-page">
            <main class="site-main" id="main" role="main">
	            <?php
	            get_template_part( 'partial-templates/block-header' );

	            global $post;
	            $wrapper_class_name = 'entry-header';
	            $menu_name          = get_post_field( 'post_name', $post->post_parent );
	            include( locate_template( 'partial-templates/centered-submenu.php' ) );

	            while ( have_posts() ) : the_post(); ?>
                    <div id="intro-text" class="container">
                        <div class="centered-text my-5"><?php the_content() ?></div>
                    </div>

                    <div class="container mb-5">
                        <div class="row">
					            <?php foreach ( $list_items as $item ) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4 list-wrapper px-0">
                                        <div class="square-wrapper">
                                            <div class="square-content d-flex flex-column justify-content-center align-items-center text-center px-3">
                                                <img src="<?php echo $item['item_image']; ?>"/>
                                                <h2 class="large-header mt-0"><?php echo $item['item_header']; ?></h2>
                                                <p><?php echo $item['item_subheader']; ?></p>
                                                <div class="paragraph-content mt-0">
                                                    <?php echo $item['item_content'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

					            <?php } ?>
                        </div>
                    </div>
	            <?php endwhile; ?>

            </main>
        </div>
    </div>


<?php get_footer(); ?>