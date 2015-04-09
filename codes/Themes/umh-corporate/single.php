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
	<div id="blogs">
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

        	

                <div class="home-page-cont">

		<div id="content" class="cont-inner" role="main">



			<?php while ( have_posts() ) : the_post(); ?>



				<?php get_template_part( 'content', 'single' ); ?>



			<!--	<nav class="nav-single">

					<span class="nav-previous"><?php previous_post_link('%link','<img src="' . get_bloginfo("template_directory") . '/images/blue-bullet-prev.png" /> %title'); ?></span>

					<span class="nav-next"><?php next_post_link('%link','%title <img src="' . get_bloginfo("template_directory") . '/images/blue-bullet.png" />'); ?></span>

				</nav> --><!-- .nav-single -->

			<?php endwhile; // end of the loop. ?>


		<div class="clrs"></div>
		</div><!-- #content -->

        <div class="clrs"></div>

        </div><!-- #home-page-cont -->

        <div class="clrs"></div>

        </div><!-- .cont-wrapper -->

        <div class="clrs"></div>

	</div>
	<div class="clrs"></div>

<div class="clrs"></div>
<div class="pagebtmshdws"></div>
</div><!-- #primary -->
<div class="clrs"></div>
<?php #get_sidebar(); ?>

<?php get_footer(); ?>