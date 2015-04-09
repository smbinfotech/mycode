<?php
/**
 * Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
			<div class="sidebar-menu">
			<?php #wp_nav_menu( array( 'theme_location' => 'sidebar' ) );
			dynamic_sidebar('sidebar-menu'); ?>
            </div>
			<?php dynamic_sidebar('sidebar-1');  ?>
		</div><!-- #secondary .widget-area -->
