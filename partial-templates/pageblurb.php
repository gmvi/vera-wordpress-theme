<section class="blurb">
    <div class="container">
        <div id="blurb-header"><p><?php the_field( 'header' ); ?></p></div>
        <?php $post_content = get_post()->post_content; ?>
        <?php if (strlen($post_content) > 0): ?>
            <div id="blurb-text"><p><?php echo $post_content ?></p></div>
        <?php endif; ?>
    </div>
</section>