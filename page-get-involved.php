<?php
/**
 * Get Involved template.
 *
 */

get_header();

// Get container type from Wordpress Customizer
$container = get_theme_mod( 'understrap_container_type' );

// Grab steps from custom fields plugin
$getting_involved_steps = SCF::get( 'Steps' );

function pad_zeroes( $num ) {
	if ( $num > 9 ) {
		return $num;
	}

	return str_pad( $num, 2, '0', STR_PAD_LEFT );
}

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
                    <div id="adventure-header"><?php the_field( 'adventure_header' ); ?></div>

					<?php if ( get_field( 'adventure_text' ) ): ?>
                        <div id="adventure-text"><?php the_field( 'adventure_text' ); ?></div>
					<?php endif; ?>
                </div>
            </section>

            <section class="steps">
                <div class="steps-header text-center"> Getting involved at Vera is easy:</div>

                <div class="row step-tabs">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
							<?php foreach ( $getting_involved_steps as $i => $step ) { ?>
								<?php $step_label = 'Step ' . pad_zeroes( $step['numbered_step_header'] );
								$step_element_id  = 'step-' . $step['numbered_step_header'];
								?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ( $i == 0 ) ? 'active' : '' ?>"
                                       id="tab-<?php echo $step_element_id ?>" data-toggle="tab"
                                       href="#<?php echo $step_element_id ?>" role="tab"
                                       aria-controls="<?php $step_element_id ?>"
                                       aria-selected="true"><?php echo $step_label ?></a>
                                </li>
							<?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="tab-content">
					<?php foreach ( $getting_involved_steps as $i => $step ) { ?>
						<?php $step_element_id = 'step-' . $step['numbered_step_header']; ?>
                        <div class="tab-pane <?php echo ( $i == 0 ) ? 'active' : '' ?>"
                             id="<?php echo $step_element_id ?>" role="tabpanel"
                             aria-labelledby="<?php echo $step_element_id ?>">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 tab-image">
                                    <img src="<?php echo wp_get_attachment_url($step['step_image']); ?>"/>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div id="step-label">
                                        <div class="small-primary-bg-header">
                                            <?php echo pad_zeroes( $step['numbered_step_header'] ); ?>
                                        </div>
                                        <?php if ( $step['mark_if_required'] ):
                                            echo '<span>required</span>';
                                            endif;
                                        ?>
                                    </div>
                                    <h2 class="large-header"><?php echo $step['step_header'] ?></h2>
                                    <div class="paragraph-content"><?php echo $step['step_content'] ?></div>
                                </div>
                            </div>
                        </div>
					<?php } ?>
                </div>
            </section>

            <section class="volunteer-committees row">
                <div class="row">
                    <div id="volunteer-content" class="col-sm-12 col-md-6">
                        <div id="content-wrapper">
                            <?php if ( get_field( 'adventure_text' ) ):
                                echo '<div class="small-primary-bg-header">' . get_field( 'get_involved_small_header' ) . '</div>';
                            endif;

                            echo '<h2 class="large-header">' . get_field( 'get_involved_header' ) . '</h2>';

                            echo '<div class="paragraph-content">' . get_field( 'get_involved_content' ) . '</div>';

                            echo '<a class="btn btn-outline-primary" href="' . get_field( 'get_involved_link' ) . '"> Learn More </a>'; ?>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <img class="volunteer-image" src="<?php echo get_field( 'get_involved_image' )['url'];?>" />
                    </div>
                </div>
            </section>
        </main><!-- #main -->

    </div><!-- #content -->

</div><!-- .wrapper -->

<?php get_footer(); ?>
