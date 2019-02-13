<?php

$categories=get_the_category();
foreach($categories as $category) {
    if ($category->name != 'Blog') {
    	$tag_link = get_tag_link($category->cat_ID);
	    echo "<div class=\"label mr-1\"><a href=\"$tag_link\">$category->name</a></div>";
    }
}



