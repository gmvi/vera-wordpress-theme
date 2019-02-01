<?php
$fb_args = array(
    'u' => get_permalink(),
    't' => get_the_title(),
);
$fb_share_url = 'https://www.facebook.com/sharer/sharer.php?' . http_build_query($fb_args);
$twit_args = array(
    'url' => get_permalink(),
    'text' => get_the_title(),
);
$twit_share_url = 'https://twitter.com/intent/tweet?' . http_build_query($twit_args);
?>
<div class="vera-bordered-social-icons p-0">
    <a href="<?= $fb_share_url?>" target="_blank"><i class="fa fa-facebook-f text-primary"></i></a>
    <a href="<?= $twit_share_url?>" target="_blank"><i class="fa fa-twitter text-primary"></i></a>
</div>