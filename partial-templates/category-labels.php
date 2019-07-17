<?php
if ( is_post_type_archive(GALLERY_TYPE) || is_singular(GALLERY_TYPE) || is_tax('gallery_cat')) {
	//shows labels for gallery archive page
	$terms = get_the_terms( $post->ID , 'gallery_cat' );

	$up_next_gallery = get_field(UP_NEXT_GALLERY, $post->ID);

	if ($up_next_gallery) {
		echo "<div class=\"label mr-1 unselectable\">Up Next</div>";
	}

	$cur_gallery = get_field(CURR_GALLERY, $post->ID);

	if ($cur_gallery) {
		echo "<div class=\"label mr-1 unselectable\">Current</div>";
	}

	if ($terms) {
		foreach($terms as $term) {
			echo "<div class=\"label mr-1 unselectable\">$term->name</div>";
		}
	}


} else {
	$categories=get_the_category();

	//shows labels for blog post archive page
	foreach($categories as $category) {
		if ($category->name != 'Blog') {
			echo "<div class=\"label mr-1 unselectable\">$category->name</div>";
		}
	}
}



