<?php
/*
Template Name: Community Template
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

                    <div class="takeatour">

                        <?php dynamic_sidebar('take-a-tour-form'); ?>

                     </div>

                     <?php dynamic_sidebar('sidebar-inner'); ?>

                    <div class="clrs"></div>

                </div>

                <div class="clrs"></div>

            </div>

        	

                <div class="home-page-cont">

		<div id="content" class="cont-inner community" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>
                    <div class="map-wrapper">
                        <div class="maparea">
                        	<?php dynamic_sidebar('sidebar-map'); ?>
                            <div class="clrs"></div>
                        </div>
                    </div>
					<div class="entry-content">
						<?php the_content(); ?>
                        <div class="clrs"></div>
					</div> 
				</article><!-- #post -->
			<?php endwhile; // end of the loop. ?>
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