<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

 ?>
 <link type="text/css" href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet" />
<div class="page_404">

<img src="http://localhost/bdmdnew/wp-content/uploads/2014/11/404.png" alt="404" />

				<div class="content_404">
					<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentythirteen' ); ?></h2>
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentythirteen' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
	

    </div>

