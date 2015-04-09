<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div class="cont-wrapper">
       		<div class="home-page-comm">
            	<div class="community-sidebar">
					<div class="comm-sidebar">                
					<?php dynamic_sidebar('sidebar-1'); ?>
                    <div class="clrs"></div>
                    </div>
                    <div class="clrs"></div>
                </div>
                <div class="clrs"></div>
            </div>
        	
                <div class="home-page-cont">
		<div id="content" class="cont-inner" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>

			<?php twentytwelve_content_nav( 'nav-above' ); ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

		</div><!-- #content -->
        <div class="clrs"></div>
        </div><!-- #home-page-cont -->
        <div class="clrs"></div>
        </div><!-- .cont-wrapper -->
        <div class="clrs"></div>
	</div><!-- #primary -->

<?php #get_sidebar(); ?>
<?php get_footer(); ?>