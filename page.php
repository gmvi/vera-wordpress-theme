<?php
/**
 * 
 * Template for generic content pages
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?> p-0">

		<main class="site-main" id="main" role="main">
<!--
    TODO: use wp_get_nav_menu_object() to check if menu for $pagename exists, if it does use centered-submenu template
    https://stackoverflow.com/questions/4837006/how-to-get-the-current-page-name-in-wordpress
-->
			<?php the_post(); // This is a page template ?>

				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <?php
                        global $post;
                        $parent_submenu = get_field('subnav', $post->post_parent);
                        $menu_name = $parent_submenu;
                        $wrapper_class_name = 'entry-header';
                        include( locate_template( 'partial-templates/centered-submenu.php') );
                    ?>
					<div id="content" class="entry-content">
                        <div class="row pt-2">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-11 mt-2">
                                <?php get_template_part('partial-templates/category-labels'); ?>
                                <h2 class="single-blog-title text-dark mb-0 mt-1"><?php the_title()?></h2>
                            </div>
                        </div>
                        <div class="row pt-4 pb-4">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-9 pb-3 blog-contents">
                                <p class="metadata">Posted on <?php the_date()?> by <a href="#"><?// FIXME: get_the_author_meta('user_url')?><?php echo get_the_author_meta('display_name') ?></a></p>
                                <?php the_content()?>
                                <hr class="pb-2"/>
                                <p class="share-call mb-1">Share this story</p>
                                <div class="vera-bordered-social-icons p-0">
                                    <i class="fa fa-facebook-f text-primary"></i>
                                    <i class="fa fa-twitter text-primary"></i>
                                    <i class="fa fa-instagram text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>

				</article><!-- #post-## -->
		
		</main><!-- #main -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
