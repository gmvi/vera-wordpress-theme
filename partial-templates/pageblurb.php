<section class="blurb">
    <div class="container">
        <div id="blurb-header"><p><?php the_field( 'header' ); ?></p></div>
        <?php if ( !empty( get_the_content() ) ): ?>
            <div id="blurb-text"><p><?php the_content(); ?></p></div>
        <?php endif; ?>
    </div>
</section>