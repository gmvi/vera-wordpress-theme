<?php
/**
 * Get Involved template.
 *
 */

get_header();

// Get container type from Wordpress Customizer
$container = get_theme_mod( 'understrap_container_type' );

$getting_involved_steps = SCF::get( 'Steps' );
error_log(print_r($getting_involved_steps, true));

?>

<div class="wrapper" id="index-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

        <main class="site-main" id="main">
            <section class="volunteer-hero">
                <div class="volunteer-hero-text">
                    <div class="centered">
                        <p class="label">Get Involved</p>
                        <h2>Volunteer today!</h2>
                    </div>
                </div>
            </section>

            <section class="adventure">
                <div class="container">
                    <div id="adventure-header"><?php the_field('adventure_header'); ?></div>

                    <?php if( get_field('adventure_text') ): ?>
                        <div id="adventure-text"><?php the_field('adventure_text'); ?></div>
                    <?php endif; ?>
                </div>
            </section>

            <section class="steps">
                <div class="steps-header text-center"> Getting involved at Vera is easy: </div>
                <div class="row">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php foreach ($getting_involved_steps as $i=>$step) { ?>
                            <?php $step_label = (str_replace(' ', '-', strtolower($step['numbered_step_header'])));?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($i == 0) ? 'active' : ''?>" id="tab-<?php echo $step_label?>" data-toggle="tab" href="#<?php echo $step_label?>" role="tab" aria-controls="<?php $step_label?>" aria-selected="true"><?php echo $step['numbered_step_header']?></a>
                            </li>
                        <?php } ?>
                    </ul>

                    <div class="tab-content">
	                    <?php foreach ($getting_involved_steps as $i=>$step) { ?>
	                    <?php $step_label = (str_replace(' ', '-', strtolower($step['numbered_step_header'])));?>
                            <div class="tab-pane <?php echo ($i == 0) ? 'active' : '' ?>" id="<?php echo $step_label?>" role="tabpanel" aria-labelledby="<?php echo $step_label?>"><?php echo $step['step_content'] ?></div>
                        <?php } ?>
                    </div>
                </div>
            </section>

            <section class="volunteer-committees">
                <div class="row">
                    <div class="col-sm-12 col-md-6">

                    </div>
                    <div class="col-sm-12 col-md-6">

                    </div>
                </div>
            </section>
        </main><!-- #main -->

    </div><!-- #content -->

</div><!-- .wrapper -->

<?php get_footer(); ?>
