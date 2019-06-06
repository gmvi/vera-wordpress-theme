<?php
/**
 * This is the cards for front page's on the block section
 *
 * Example:
 *
 * $block_image_url = 'cats';
 * $block_title = 'is';
 * $block_link = 'one';
 *
 * include( locate_template( 'partial-templates/on-the-block-block.php'));
 *
 *
 */
?>

<div class="card border-0 card-picture hoverable">

	<img class="card-img-top square"
         style="object-fit:cover;"
         src="<?= $block_image_url?>">
	<div class="card-body d-flex flex-column">
		<h5 class="card-title"><?= $block_title ?></h5>
		<a href="<?= $block_link ?>" class="stretched-link"></a>
		<div class="row no-gutters mt-auto">
			<div class="col-md-6">
				<a href="<?= $block_link ?>">Learn More</a>
			</div>
		</div>
	</div>
</div>
