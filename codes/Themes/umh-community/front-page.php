<?php get_header(); ?>

<div class="banner">

    <div class="bannerarea">

    	<div class="banner-wrapper">

        	<div class="slider">

    			<?php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow(); } ?>

            </div>

            <div class="takeatour">

            	<?php dynamic_sidebar('map-directions'); ?>

            </div>

        	<div class="clrs"></div>

        </div>

    	<div class="clrs"></div>

    </div>

    <div class="clrs"></div>

</div>

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

                                    <div class="entry-content">

                                        <?php the_content(); ?>

                                    </div><!-- .entry-content -->

                                </article><!-- #post -->

                        <?php endwhile; // end of the loop. ?>

            

                    </div><!-- #content -->

                    <div class="clrs"></div>

                    <div class="home-page-btm">

                    	<div class="home-btm-widget home-btm-widget-one">

							<?php dynamic_sidebar('home-page-bottom-one'); ?>

                            <div class="clrs"></div>

                        </div>

                        <div class="home-btm-widget home-btm-widget-two">

                        	<?php dynamic_sidebar('home-page-bottom-two'); ?>

                            <div class="clrs"></div>

                        </div>

                        <div class="home-btm-widget home-btm-widget-three">

                        	<?php dynamic_sidebar('home-page-bottom-three'); ?>

                            <div class="clrs"></div>

                        </div>

                        <div class="clrs"></div>

                    </div>

                    <div class="clrs"></div>

                </div>

	        <div class="clrs"></div>

        </div>

        <div class="clrs"></div>

	</div><!-- #primary -->



<?php get_footer(); ?>