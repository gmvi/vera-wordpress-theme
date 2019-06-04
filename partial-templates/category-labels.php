<?php

$categories=get_the_category();

if ( is_post_type_archive(GALLERY_TYPE) ) {
	//shows labels for gallery archive page

	$up_next_gallery = get_field(UP_NEXT_GALLERY, $post->ID);

	if ($up_next_gallery) {
		echo "<div class=\"label mr-1 unselectable\">Up Next</div>";
	}

	$cur_gallery = get_field(CURR_GALLERY, $post->ID);

	if ($cur_gallery) {
		echo "<div class=\"label mr-1 unselectable\">Current</div>";
	}
} else {
	//shows labels for blog post archive page
	foreach($categories as $category) {
		if ($category->name != 'Blog') {
			echo "<div class=\"label mr-1 unselectable\">$category->name</div>";
		}
	}
}



