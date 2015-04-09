<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		
			<header class="archive-header">
				<h1 class="archive-title"><?php echo single_cat_title( '', false ); ?></h1>

				<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->
            
			<?php if ( have_posts() ) : ?>
            
			<?php /* The loop */ ?>
            <ul id="jpages" class="box sports clear">
            <p class="heading-center"><span>FEATURED PROJECTS</span></p>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'tax-market-type' ); ?>
			<?php endwhile; ?>
		<?php endif; ?>
		</ul>
        <!--<div class="holder"></div>-->
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>