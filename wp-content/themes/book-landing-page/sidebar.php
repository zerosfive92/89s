<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Book_Landing_Page
 */

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}

?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'right-sidebar' ); ?>
</aside><!-- #secondary -->
