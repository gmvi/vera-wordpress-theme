<?php

$categories=get_the_category();
foreach($categories as $category) {
    if ($category->name != 'Blog') {
        echo "<div class=\"label\">$category->name</div>";
    }
}



