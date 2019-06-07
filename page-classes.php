<?php
/**
 * 
 * Template for the classes page
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
$classes_category = 'Classes';

$class_cat_param = get_query_var('class_cat');

//called to check if category is active
function cat_active($cat) {
	global $class_cat_param;
	if ($cat == $class_cat_param) {
		return " active";
	} else return "";
}

// this needs to match explicitly with the categories created for My Calendar
if (!empty($class_cat_param)) {
    switch ($class_cat_param) {
        case 'screenprint':
            $classes_category = 'Screenprint';
            break;
        case 'audio':
	        $classes_category = 'Audio Stage';
	        break;
    }
}

$args = array(
	'before'   => 1,
	'today'    => 'yes',
	'category' => $classes_category
);

$classes = mc_get_all_events($args);
$grouped_classes = array();

//iterate over all glasses, and group them accordingly based on if event_group_id field is set
foreach ($classes as $class) {
    if ($class->event_group_id == 0) { //this means event is not grouped
        $grouped_classes[$class->event_title] = $class;

	    //grab a subheader if it exists
	    $subheader = get_post_meta( $class->event_post, '_mc_event_subheader', true );
	    if (trim($subheader) !== '') {
		    $class->custom_subheader = $subheader;
	    }
    } else {
	    if (!isset($grouped_classes[$class->event_title])) {
            $event_times = array();

	        $event_schedule = new stdClass();
	        $event_schedule->link = $class->event_link;

	        $event_schedule->time_start = calendar_date_parse($class->occur_begin);
	        $event_schedule->time_end = calendar_date_parse($class->occur_end);

            array_push($event_times, $event_schedule);

            $class->event_times = $event_times;
	        //grab a subheader if it exists
            $subheader = get_post_meta( $class->event_post, '_mc_event_subheader', true );
            if (trim($subheader) !== '') {
                $class->custom_subheader = $subheader;
            }

	        $grouped_classes[$class->event_title] = $class;
        } else {
            $repeating_event = $grouped_classes[$class->event_title];

	        $event_schedule = new stdClass();
	        $event_schedule->link = $class->event_link;
	        $event_schedule->time_start = calendar_date_parse($class->occur_begin);
	        $event_schedule->time_end = calendar_date_parse($class->occur_end);

	        //grab a subheader if it exists
	        $subheader = get_post_meta( $class->event_post, '_mc_event_subheader', true );
	        if (trim($subheader) !== '') {
		        $class->custom_subheader = $subheader;
	        }

	        array_push($repeating_event->event_times, $event_schedule);
        }
    }
}

//takes in date in my calendar format, and converts to Date object
function calendar_date_parse($my_calendar_date) {
	return DateTime::createFromFormat('Y-m-d H:i:s', $my_calendar_date);
}
?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<main class="site-main" id="main" role="main">

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				<?php get_template_part('partial-templates/titlecard-fullwidth'); ?>

				<div  class="entry-content">
					<section class="info text-center">
						<div class="row header no-gutters">
							<div class="col-md-12">
								<h3><?php the_field('header'); ?></h3>
							</div>
						</div><!-- .header -->
						<div class="row body no-gutters">
							<div class="col-md-12">
								<?/* the_content() wasn't working here?? */?>
								<?= get_post(get_the_ID())->post_content; ?>
							</div>
						</div><!-- .body -->
					</section><!-- .info -->

					<section class="classes">
						<div class="row body">
							<div class="list-header m-auto">
								<a class="filter-category<?= cat_active(""); ?>" href="./">All</a>
                                <a class="filter-category<?= cat_active("screenprint"); ?>" href="?class_cat=screenprint">Screenprint</a>
                                <a class="filter-category<?= cat_active("audio"); ?>" href="?class_cat=audio">Audio & Stage</a>
							</div>
						</div>
                        <div class="container">
							<div class="row body class no-gutters">
                            <?php foreach ($grouped_classes as $class):
                                ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="square-wrapper">
                                        <div class="square-content class-title d-flex flex-column justify-content-between align-content-center">
                                            <a data-toggle="modal" data-target="#modal-<?= $class->event_id ?>">
                                                <?= $class->event_title?>
                                            </a>
                                            <?php
                                            if (trim($class->custom_subheader) !== '') {
                                                echo "<h4>" . nl2br($class->custom_subheader) . "</h4>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
							</div>
                        </div>
					</section>

				</div><!-- .entry-content -->

			</article><!-- #post-## -->
		
		</main><!-- #main -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>

<div class=modals>
	<?php foreach ($grouped_classes as $class): ?>
		<div class="modal fade" id="modal-<?= $class->event_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<span class="modal-title"><?= $class->event_title ?></span>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body"><?= wpautop( $class->event_desc ) ?></div>
                    <?php
                    if (isset($class->event_times)) {
                        foreach($class->event_times as $event_time) {

                            //if event is in the past, skip
                            $current_time = new DateTime();
                            if ($current_time > $event_time->time_end) { continue; }

                            ?>
                            <div class="modal-footer">
                                <div class="row w-100 mx-0 d-flex align-items-center">
                                    <div class="col-sm-2 text-right time-label">
                                        <h4><?= $event_time->time_start->format('l'); ?></h4>
                                    </div>
                                    <div class="col-sm-3 text-right time-label">
                                        <h4 class="text-primary font-weight-bold"><?= $event_time->time_start->format('F j'); ?></h4>
                                    </div>
                                    <div class="col-sm-4 text-right time-label">
                                        <?php
                                        $start_time = $event_time->time_start->format('g:ia');
                                        $end_time = $event_time->time_end->format('g:ia');

                                        if ($start_time == '12:00am' && $end_time == '11:59pm') {
                                            echo "<h4>All Day</h4>";
                                        } else {
                                            echo "<h4>" . $start_time . "-" . $end_time . "</h4>";
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="<?= $event_time->link; ?>"
                                           target="_blank"
                                           class="btn bordered-button btn-outline-primary btn-override pull-right my-auto">Register</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else if ( strlen(trim($class->event_link)) > 0 ) {
	                    ?>
                        <div class="modal-footer">
                            <a href="<?= $class->event_link ?>"
                               target="_blank"
                               class="btn bordered-button btn-outline-primary btn-override pull-right my-auto">Register</a>
                        </div>
                    <?php
                    }
                    ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>