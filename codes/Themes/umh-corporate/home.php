<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="blog" class="site-content">
		<div class="cont-wrapper">
        <div class="home-page-comm">

            	<div class="community-sidebar">

					<div class="comm-sidebar">                

					<?php dynamic_sidebar('sidebar-blog'); ?>

                    <div class="clrs"></div>

                    </div>

                    <div class="clrs"></div>

                </div>

                <div class="clrs"></div>

            </div>
            
		<div id="content" class="cont-inner" role="main">
        
		<?php if ( have_posts() ) : ?>
		<div id="list">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
            <div class="clrs"></div>
            </div>
            
      		<nav id="nav-below" class="navigation" role="navigation">
            <?php my_pagination(); ?>
			<!-- <div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div> -->
			</nav>
		<?php endif; // end have_posts() check ?>
		<div class="clrs"></div>
		</div><!-- #content -->
        <div class="clrs"></div>
        </div><!-- .cont-wrapper -->
        <div class="clrs"></div>
	</div><!-- #primary -->

<?php #get_sidebar(); ?>
<?php get_footer(); ?>