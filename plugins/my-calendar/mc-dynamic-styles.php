<?php
/**
 * Created by PhpStorm.
 * User: sudoguest
 * Date: 2019-06-19
 * Time: 17:36
 */

/**
 * Publically written head styles & scripts
 *
 * **largely copied from my-calendar's head function (my_calendar_head() in my-calendar-core.php),
 *      just removing some option checks that were causing it not to render in a custom style**
 */
function mc_categories_styles() {
    global $wpdb, $wp_query;
    $mcdb = $wpdb;
    if ( 'true' == get_option( 'mc_remote' ) && function_exists( 'mc_remote_db' ) ) {
        $mcdb = mc_remote_db();
    }
    // generate category colors.
    $category_styles = '';
    $inv             = '';
    $type            = '';
    $alt             = '';
    $categories      = $mcdb->get_results( 'SELECT * FROM ' . my_calendar_categories_table( get_current_blog_id() ) . ' ORDER BY category_id ASC' );
    foreach ( $categories as $category ) {
        $class = mc_category_class( $category, 'mc_' );
        $hex   = ( strpos( $category->category_color, '#' ) !== 0 ) ? '#' : '';
        $color = $hex . $category->category_color;
        if ( '#' != $color ) {
            $hcolor = mc_shift_color( $category->category_color );
            if ( 'font' == get_option( 'mc_apply_color' ) ) {
                $type = 'color';
                $alt  = 'background';
            } elseif ( 'background' == get_option( 'mc_apply_color' ) ) {
                $type = 'background';
                $alt  = 'color';
            }
            if ( 'true' == get_option( 'mc_inverse_color' ) ) {
                $inverse = mc_inverse_color( $color );
                $inv     = "$alt: $inverse;";
            }
            if ( 'font' == get_option( 'mc_apply_color' ) || 'background' == get_option( 'mc_apply_color' ) ) {
                // always an anchor as of 1.11.0, apply also to title.
                $category_styles .= "\n.mc-main .$class .event-title, .mc-main .$class .event-title a { $type: $color; $inv }";
                // todo -- review: not sure if they want this...
                // apply same styles to category labels
                $category_styles .="\n.category-key ul li.cat_" . strtolower($category->category_name) . " a { $type: $color; $inv }";
            }
        }
    }

    $styles     = (array) get_option( 'mc_style_vars' );
    $style_vars = '';
    foreach ( $styles as $key => $var ) {
        if ( $var ) {
            $style_vars .= sanitize_key( $key ) . ': ' . $var . '; ';
        }
    }
    if ( '' != $style_vars ) {
        $style_vars = '.mc-main {' . $style_vars . '}';
    }

    $all_styles = "
<style type=\"text/css\">
<!--
/* Styles by My Calendar - Joseph C Dolson http://www.joedolson.com/ */
$category_styles
.mc-event-visible {
	display: block!important;
}
$style_vars
-->
</style>";
    echo $all_styles;
}