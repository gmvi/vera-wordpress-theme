<?php
/**
 * Created by PhpStorm.
 * User: Jessi Shank
 * Date: 2019-01-29
 * Time: 16:29
 *
 * Use include so that the context is kept
 * <?php
 *      $numOfCols = 3;
 *      include( locate_template( 'partial-templates/blog-list-cards.php') );?>
 */
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); $count++; ?>
    <?php $cardclass = (has_post_thumbnail() ? 'card-picture': 'card-pictureless')?>
    <div class="card border-0 <?php echo $cardclass ?>">
        <div class="top-left">
            <?php get_template_part('partial-templates/category-labels'); ?>
        </div>
        <?php if (has_post_thumbnail()): ?>
            <img class="card-img-top square" style="object-fit:cover;" src="<?php echo the_post_thumbnail_url('medium')?>">
        <?php endif ?>
        <div class="card-body d-flex flex-column">
            <p class="blog-overview-date"><?php echo get_the_date(); ?></p>
            <h5 class="card-title"><?php echo the_title();?></h5>
            <?php
            if (!has_post_thumbnail()):
                $short_excerpt = wp_trim_words(get_the_excerpt(), 10, '...');
                echo "<p class=\"excerpt\">$short_excerpt</p>";
            endif;
            ?>
            <div class="row no-gutters mt-auto">
                <div class="col-md-6">
                    <a href="<?php echo get_permalink()?>">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <?php if($count % $numOfCols == 0) echo '</div><div class="card-deck">'; ?>
<?php endwhile; ?>
<?php else : ?>
    <div class="col-sm-6 mx-auto text-center">
        <h2 class="medium-header pt-3">No posts were found.</h2>
    </div>
<?php endif; ?>