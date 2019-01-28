<?php
/**
 * 
 * Template for the classes page
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$class_cats = get_terms([
	'taxonomy' => 'class_cat',
	'hide_empty' => true,
]);

$class_cat_param = get_query_var("class_cat");

$args = [
	'post_type' => 'classes',
	'post_status' => 'publish',
	'numberposts' => 20
];
if (!empty($class_cat_param)) $args['tax_query'] = [[
	'taxonomy' => 'class_cat',
	'field' => 'slug',
	'terms' => $class_cat_param,
]];
$classes = get_posts($args);

function cat_active($cat) {
	global $class_cat_param;
	if ($cat == $class_cat_param) {
		return " active";
	} else return "";
}

?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>">

		<main class="site-main" id="main" role="main">

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				<?php get_template_part('partial-templates/titlecard-fullwidth'); ?>

				<div  class="entry-content">
					<a name="content"></a>

					<section class="info text-center">
						<div class="row header">
							<div class="col-md-12">
								<h3><?php the_field('header'); ?></h3>
							</div>
						</div><!-- .header -->
						<div class="row body">
							<div class="col-md-12">
								<?/* the_content() wasn't working here?? */?>
								<?= get_post(get_the_ID())->post_content; ?>
							</div>
						</div><!-- .body -->
					</section><!-- .info -->

					<section class="classes">
						<div class="row body">
							<div class="col-md-1"></div>
							<div class="col-md-10 list-header">
								<a class="filter-category<?= cat_active(""); ?>" href="./">All</a>
								<?php foreach ($class_cats as $class_cat): ?>
									<a class="filter-category<?= cat_active($class_cat->slug); ?>" href="?class_cat=<?= $class_cat->slug ?>#content"><?= $class_cat->name ?></a>
								<?php endforeach; ?>
							</div>
						</div>
						<? foreach ($classes as $class):
							$icon = vera_get_class_cat($class->ID);
							$is_private = SCF::get("private_class", $class->ID);
							$next = vera_get_class_next($class->ID); 
						?>
							<div class="row body class">
								<div class="col-md-1"></div>
								<div class="col-md-10 list-item">
									<span class="icon icon-<?= $icon ?>"></span>
									<div class="flex">
										<a class="class-title" href="" data-toggle="modal" data-target="#modal-<?= $class->ID ?>"><?= $class->post_title ?></a>
										<div class="wrapper">
											<?php if ($is_private): ?>
												<a class="class-register" href="" data-toggle="modal" data-target="#modal-<?= $class->ID ?>">Learn More</a>
											<?php else: ?>
												<span class="class-info"><?= $next['date'] ?></span>
												<span class="class-info"><?= $next['time'] ?></span>
												<? if($next['link']): ?>
													<a class="class-register" target="_blank" href="<?= $next['link'] ?>">Register</a>
												<? else : ?>
													<a class="class-register disabled">Register</a>
												<? endif; ?>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						<? endforeach; ?>
					</section>

				</div><!-- .entry-content -->

			</article><!-- #post-## -->
		
		</main><!-- #main -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>

<div class=modals>
	<? foreach ($classes as $class):
		$next = vera_get_class_next($class->ID); ?>
		<div class="modal fade" id="modal-<?= $class->ID ?>" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<span class="modal-title"><?= $class->post_title ?></span>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body"><?= wpautop( $class->post_content ) ?></div>
					<?php if (!SCF::get("private_class", $class->ID)): ?>
						<div class="modal-footer">
							<a type="button" class="btn btn-primary" target="_blank" href="<?= $next['link'] ?>">Register</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<? endforeach; ?>
</div>