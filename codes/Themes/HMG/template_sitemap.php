<?php

/*

Template Name: tpl_sitemap

*/



get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>
			    <div class="sitemaps">
				<h2 id="pages">Pages</h2>
				<ul>
                <?php wp_list_pages(array('exclude' => '489,490,538','title_li' => '',)); ?>
               </ul>
               
             </div>
	
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>