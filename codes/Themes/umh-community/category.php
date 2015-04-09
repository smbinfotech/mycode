<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages for posts in a category.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
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