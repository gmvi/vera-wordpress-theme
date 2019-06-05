<?php

/**
 * Allows user to set tag (optional), title, and subtitle (optional).
 * See page.php and single-galleries.php for usage.
 *
 * Example:
 *
 * $tag = 'cats'
 * $title = 'is';
 * $subtitle = 'one';
 *
 * include( locate_template( 'partial-templates/half-or-block-header.php'));
 *
 */


if (has_post_thumbnail( get_the_ID() )) { ?>
	<div class="row no-gutters">

		<div class="col-sm-12 col-md-6 p-0 mh-100">
			<img class="h-100 single-blog-featured-image" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full')?>">
		</div>

		<div class="col-sm-12 col-md-6 py-5 p-sm-0 mh-100 single-blog-featured-text">
			<div class="h-100 content-hero">
				<div class="content-overlay textured-blerg"></div>
				<div class="d-flex align-content-center flex-wrap justify-content-center h-100 w-75 m-auto">
					<div>
						<?php

						if(strlen(trim($tag)) > 0) {
							echo "<span class=\"label\">" . $tag . " </span>";
						}

						if(strlen(trim($title)) > 0) {
							echo "<h2 class=\"single-blog-title text-white mb-0\">" . $title .  "</h2>";
						}

						if(strlen(trim($subtitle)) > 0) {
							echo "<p class=\"text-white-50 mt-3\">" . $subtitle . "</p>";
						}

						?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }
else {
	get_template_part('partial-templates/block-header');
}