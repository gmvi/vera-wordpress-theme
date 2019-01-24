<?php
// Use for the blue submenu nav
/*
 * Usage:
 <?php
    $menu_name = 'gallery-menu';
    $wrapper_class_name = 'entry-header';
    include( locate_template( 'partial-templates/centered-submenu.php') );
 ?>
 * */
?>

<section class="<?php echo $wrapper_class_name ?>">
    <nav class="navbar navbar-expand-lg navbar-light menu">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <?php /* Primary navigation */
            wp_nav_menu( array(
                    'menu' => $menu_name,
                    'depth' => 2,
                    'container' => false,
                    'menu_class' => 'nav navbar-nav mx-auto mr-auto',
                    //Process nav menu using our custom nav walker
                    'walker' => new understrap_WP_Bootstrap_Navwalker())
            );
            ?>
        </div>
    </nav>
</section>
