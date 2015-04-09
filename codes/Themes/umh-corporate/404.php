<?php

/**

 * The template for displaying 404 pages (Not Found)

 *

 * @package WordPress

 * @subpackage Twenty_Twelve

 * @since Twenty Twelve 1.0

 */



get_header(); ?>



	<div id="primary" class="site-content">
		<div class="pagebtmshdws">
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



			<article id="post-0" class="post error404 no-results not-found">

				<header class="entry-header">

					<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentytwelve' ); ?></h1>

				</header>



				<div class="entry-content">

					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentytwelve' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .entry-content -->

			</article><!-- #post-0 -->



		</div><!-- #content -->

        <div class="clrs"></div>

        </div><!-- #home-page-cont -->

        <div class="clrs"></div>

        </div><!-- .cont-wrapper -->

        <div class="clrs"></div>

	</div>
<div class="clrs"></div>
</div><!-- #primary -->



<?php get_footer(); ?>