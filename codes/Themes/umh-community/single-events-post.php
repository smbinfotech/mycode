<?php
/**
 * The Template for displaying all single posts
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
		<div id="content" class="cont-inner gradient" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content-events', get_post_format() ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
        <div class="clrs"></div>
        </div><!-- #home-page-cont -->
        <div class="clrs"></div>
        </div><!-- .cont-wrapper -->
        <div class="clrs"></div>
	</div><!-- #primary -->

<?php #get_sidebar(); ?>
<?php get_footer(); ?>