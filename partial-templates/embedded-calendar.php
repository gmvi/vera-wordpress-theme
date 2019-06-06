<?php
$cal_shortcode = get_field('calendar_shortcode');
$cal_header = get_field('calendar_header');
if ($cal_shortcode) :?>
    <section class="embedded-calendar">
        <h2 class="py-2"><?= $cal_header ?></h2>
        <div>
            <?= do_shortcode($cal_shortcode); ?>
        </div>
    </section>
<?php endif;?>
