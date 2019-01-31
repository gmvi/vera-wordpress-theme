<?php
$label = get_field('label');
$custom_title = get_field('title');
?>

<header class="entry-header text-center">
	<div class="row row-block no-gutters">
		<div class="col-md-12">
			<div class="wrapper"><!-- titlecard -->
				<div class="overlay center-vertical header-texture ">
					<?php if ($label) { ?>
						<span class="label">
							<?php echo $label ?>
						</span>
					<?php } ?>
					<h1 class="entry-title">
						<?php
							if ($custom_title) echo $custom_title;
							else the_title();
						?>
					</h1>
				</div>
				<?php echo get_the_post_thumbnail( $post->ID, 'large'); ?>
			</div>
		</div>
	</div>
</header>