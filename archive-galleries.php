<?php
/**
 * Galleries archive page
 *
 */

get_header();

// Get container type from Wordpress Customizer
$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="index-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
        <div>
	        <?php
	        $numOfCols = 3;
	        $rowCount = 0;
	        $bootstrapColWidth = 12 / $numOfCols;
	        $count = 0;
	        ?>
            <div class="row justify-content-md-center pt-5 pb-1 no-gutters">
                <div class="col-sm-11">
                    <div class="card-deck pb-2">
				        <?php include( locate_template( 'partial-templates/blog-list-cards.php') );?>
                    </div>
                </div>
            </div>
        </div>

        <div id="blog-pagination" class="row justify-content-between">
            <div class="col-md-2 text-center text-md-left"><?php previous_posts_link( '&#8592; Newer posts' ); ?></div>
            <div class="col-md-2 text-center text-md-left"><?php next_posts_link( 'Older posts &#8594;' ); ?></div>
        </div>
    </div>
</div>
