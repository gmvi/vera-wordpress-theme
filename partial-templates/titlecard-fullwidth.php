<?php
$label = get_field('label');
$custom_title = get_field('title');
$subnav = get_field('subnav');
?>

<header class="entry-header text-center">
	<div class="row row-block">
		<div class="col-md-12">
			<div class="wrapper"><!-- titlecard -->
				<div class="overlay center-vertical header-texture">
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
				<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
			</div>
			<?php
				if ($subnav) {
					wp_nav_menu(array(
						'menu' => $subnav
			    	));
			    }
			?>
		</div>
	</div>
</header>