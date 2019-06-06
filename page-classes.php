<?php
/**
 * 
 * Template for the classes page
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
$classes_category = 'Classes';
$class_cat_param = get_query_var("class_cat");

//called to check if category is active
function cat_active($cat) {
    error_log('inside of cat active');
    error_log(print_r($cat, true));

	global $class_cat_param;
	error_log(print_r($class_cat_param, true));
	if ($cat == $class_cat_param) {
		return " active";
	} else return "";
}

if (!empty($class_cat_param)) {
    switch ($class_cat_param) {
        case 'screenprint':
            $classes_category = 'Screenprint';
            break;
        case 'audio':
	        $classes_category = 'Audio Stage';
	        break;
    }
}

$args = array('category'=>$classes_category);
error_log('arg being used is');
error_log(print_r($args, true));
$clazzes = mc_get_all_events($args);
error_log('other classes');
//error_log(print_r($clazzes, true));

?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<main class="site-main" id="main" role="main">

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				<?php get_template_part('partial-templates/titlecard-fullwidth'); ?>

				<div  class="entry-content">
					<section class="info text-center">
						<div class="row header no-gutters">
							<div class="col-md-12">
								<h3><?php the_field('header'); ?></h3>
							</div>
						</div><!-- .header -->
						<div class="row body no-gutters">
							<div class="col-md-12">
								<?/* the_content() wasn't working here?? */?>
								<?= get_post(get_the_ID())->post_content; ?>
							</div>
						</div><!-- .body -->
					</section><!-- .info -->

					<section class="classes">
						<div class="row body">
							<div class="list-header m-auto">
								<a class="filter-category<?= cat_active(""); ?>" href="./">All</a>
                                <a class="filter-category<?= cat_active("screenprint"); ?>" href="?class_cat=screenprint">Screenprint</a>
                                <a class="filter-category<?= cat_active("audio"); ?>" href="?class_cat=audio">Audio & Stage</a>
							</div>
						</div>
                        <div class="container">
							<div class="row body class no-gutters">
                            <?php foreach ($clazzes as $class):
                                ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="square-wrapper">
                                        <div class="square-content p-4 class-title d-flex flex-column justify-content-center align-content-center">
                                            <a data-toggle="modal" data-target="#modal-<?= $class->event_id ?>"><?= $class->event_title?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
							</div>
                        </div>
					</section>

				</div><!-- .entry-content -->

			</article><!-- #post-## -->
		
		</main><!-- #main -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>

<div class=modals>
	<?php foreach ($clazzes as $class): ?>
		<div class="modal fade" id="modal-<?= $class->event_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<span class="modal-title"><?= $class->event_title ?></span>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body"><?= wpautop( $class->event_desc ) ?></div>
                    <?php if (!$is_private):
                        //TODO: if event has link, show register button
                        ?>
						<div class="modal-footer">
                            <?php if($next['link']) {
                                $extraclass = '';
                            } else {
                                $extraclass = ' disabled';
                            }?>
                            <a href="<?= $next['link'] ?>" class="btn bordered-button btn-outline-primary btn-override pull-right my-auto <?= $extraclass ?>">Register</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>