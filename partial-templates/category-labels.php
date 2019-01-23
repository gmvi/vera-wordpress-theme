<?php

$categories=get_the_category();
echo '<div class="top-left">';
foreach($categories as $category) {
    if ($category->name != 'Blog') {
        echo "<p class=\"label\">$category->name</p>";
    }
} // foreach($categories
echo '</div>';


