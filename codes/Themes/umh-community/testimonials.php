<?php
/*
Template Name: Testimonials
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
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>
            <?php endwhile; // end of the loop. ?>   
            <?php if ( have_posts() ) : ?>   
            <div id="news_container">   
			<?php
			$args = array( 'post_type' => 'testimonial', 'orderby' => 'date', 'posts_per_page' => -1 );
			query_posts($args);
			while ( have_posts() ) : the_post();
			?>
            <div class="news_container">
            	<h2><?php the_title(); ?></h2>
            <div class="entry-content">
            <?php the_content(); ?>
             </div>
             <div class="clrs"></div>
            </div>
            <?php
			endwhile;
			wp_reset_query();
			?>
            </div>
	<div class="holder"></div>
		<?php endif; ?>
		</div><!-- #content -->

        <div class="clrs"></div>

        </div><!-- #home-page-cont -->

        <div class="clrs"></div>

        </div><!-- .cont-wrapper -->

        <div class="clrs"></div>
<div class="pagebtmshdws"></div>
	</div><!-- #primary -->
<div class="clrs"></div>
	


<?php #get_sidebar(); ?>

<?php get_footer(); ?>