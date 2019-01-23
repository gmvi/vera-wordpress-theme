<?php get_header(); ?>
    <div class="container-fluid">
        <section class="row justify-content-md-center">
            <div class="col-md-8 text-center">
                <p class="label">News and Stories</p>
                <h2 class="medium-header">Happening at Vera</h2>
            </div>
        </section>
        <section class="row justify-content-md-center">
            <div class="col-md-10 text-center">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
            </div>
        </section>
        <?php
        $numOfCols = 3;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
        $count = 0;
        ?>
        <div class="row">
        <?php if (have_posts()) : while (have_posts()) : the_post(); $count++; ?>
            <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                <div class="card">
                    <img class="card-img-top square" style="object-fit:cover;" src="<?php echo the_post_thumbnail_url('medium')?>" alt="Card image cap">
                    <div class="card-body">
                        <p><?php echo get_the_date(); ?></p>
                        <h5 class="card-title blog-title"><?php echo the_title();?></h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        <?php
        if($count % $numOfCols == 0) echo '</div><div class="row">';
        ?>
        <?php endwhile; ?>
        <?php else : ?>
            <div class="col-md-12 mx-auto">
                <h1>No posts were found.</h1>
            </div>
        </div>
        <?php endif; ?>
        </div>
    </div>


<?php get_footer(); ?>