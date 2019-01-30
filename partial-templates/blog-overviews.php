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
                    <?php include( locate_template( 'partial-templates/blog-list-cards.php') );?>
                </div>
            </div>
        </div>
    </div>
    </div>


<?php get_footer(); ?>