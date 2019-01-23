<?php get_header(); ?>
    <div class="container-fluid">
        <section class="row justify-content-md-center pb-1">
            <div class="col-md-8 text-center">
                <p class="label"><?php the_field('blog_overview_label', get_option('page_for_posts')); ?></p>
                <h2 class="medium-header"><?php the_field('blog_overview_title', get_option('page_for_posts')); ?></h2>
            </div>
        </section>
        <section class="row justify-content-md-center">
            <div class="col-md-10 text-center">
                <p><?php the_field('blog_overview_description', get_option('page_for_posts')); ?></p>
            </div>
        </section>
        <?php
        $menu_name = 'blogs';
        $wrapper_class_name = 'blog-subheader';
        include( locate_template( 'partial-templates/submenu.php') );
        ?>
        <?php
        $numOfCols = 3;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
        $count = 0;
        ?>
        <div class="row justify-content-md-center pt-2 pb-1">
            <div class="col-sm-11">
                <div class="card-deck">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); $count++; ?>
                        <div class="card border-0">
                            <img class="card-img-top square" style="object-fit:cover;" src="<?php echo the_post_thumbnail_url('medium')?>" alt="Card image cap">
                            <div class="card-body d-flex flex-column">
                                <p><?php echo get_the_date(); ?></p>
                                <h5 class="card-title blog-title"><?php echo the_title();?></h5>
                                <div class="row  mt-auto">
                                    <div class="col-md-6">
                                        <a href="<?php echo get_permalink()?>" class="blog-more">Learn More</a>
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