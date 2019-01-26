<?php get_header(); ?>
    <div class="container-fluid">
        <section class="row justify-content-md-center pb-1">
            <div class="col-md-8 text-center">
                <p class="label"><?php the_field('blog_overview_label', get_option('page_for_posts')); ?></p>
                <h2 class="medium-header"><?php the_field('blog_overview_title', get_option('page_for_posts')); ?></h2>
            </div>
        </section>
        <section class="row justify-content-md-center">
            <div class="col-md-8 text-center">
                <p><?php the_field('blog_overview_description', get_option('page_for_posts')); ?></p>
            </div>
        </section>
        <?php
        $menu_name = 'blogs';
        $wrapper_class_name = 'blog-subheader';
        include( locate_template( 'partial-templates/centered-submenu.php') );
        ?>
        <?php
        $numOfCols = 3;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
        $count = 0;
        ?>
        <div class="row justify-content-md-center pt-5 pb-1">
            <div class="col-sm-11">
                <div class="card-deck pb-2">
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
                                <div class="row mt-auto">
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
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>


<?php get_footer(); ?>