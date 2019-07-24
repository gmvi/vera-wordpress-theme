<!-- start of support block template -->
<?php

/**
 * Configures pink diagonal support block, allows user to pass in optional color override
 * (can be any color element recognized by css, such as 'white', or '#000000')
 * for the block immediately following the pink diagonal.
 *
 * See page-gallery.php, program-landing-generic.php, or front-page.php for examples
 *
 * use $no_bottom_cutout to remove the svg bottom section. this will also reduce the padding on the bottom of the div
 *
 * if the acf field `support_vera_text` is empty, this section will not render! because there is no data!
 *  a small buffer div will be returned instead
 *
 * Usage:
 * <?php
 *  $support_footer_color = 'white';
 *  include( locate_template( 'partial-templates/support-block.php') );
 * ?>
* */

if (get_field('support_vera_text')):
?>
<section class="volunteer-today-landing pt-5 <?= $no_bottom_cutout ? '' : 'pb-5' ?>">
	<svg class="top-cutout" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" preserveAspectRatio="none">
		<polygon  points="0,0 50,0 50,50"></polygon>
	</svg>
    <?php if (!$no_bottom_cutout): ?>
	<svg class="bottom-cutout" style="fill: <?php echo $support_footer_color ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" preserveAspectRatio="none">
		<polygon  points="50,50 0,50 0,0"></polygon>
	</svg>
    <?php endif; ?>
	<div class="content-overlay"></div>
	<div class="row no-gutters pt-3">
		<div class="col-md-1"></div>
		<div class="col-sm-11 offset-sm-1 col-md-5 offset-md-0 text-left mobile-space clickable pt-md-3">
			<span class="label"><?php the_field('support_vera_label') ?></span>
			<h2 class="banner-headline"><?php the_field('support_vera_text') ?></h2>
			<a href="<?php the_field('support_vera_link_url') ?>" class="btn bordered-button-white"><?php the_field('support_vera_link_text') ?></a>
		</div>
		<div class="col-md-5 d-none d-md-block">
			<img class="pl-3 support-vera-graphic" src="<?php echo get_field( 'support_vera_graphic' )['url'];?>" />
		</div>
		<div class="col-md-1"></div>
	</div>
</section>
<?php else:
    echo '<div class="py-3"></div>';
endif; ?>