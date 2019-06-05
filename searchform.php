<?php
/**
 * The template for displaying search forms in Underscores.me
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label class="sr-only" for="vera-search"><?php esc_html_e( 'Search', 'understrap' ); ?></label>

	<div class="input-group">
		<input class="field form-control d-none" id="vera-search" name="s" type="text"
		       placeholder="<?php esc_attr_e( 'Search &hellip;', 'understrap' ); ?>" value="<?php the_search_query(); ?>">
        <div class="input-group-append">
		    <button class="submit btn btn-outline-primary border-0" id="searchsubmit" name="submit" type="submit"><i class="fa fa-search"></i></button>
        </div>
	</div>
</form>
