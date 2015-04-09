<?php get_header(); ?>

<div class="banner">

    <div class="bannerarea">

    	<div class="banner-wrapper">

        	<div class="slider">

    			<?php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow(); } ?>

            </div>

            <div class="takeatour">

            	<?php dynamic_sidebar('take-a-tour-form'); ?>

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

                    <div class="home-page-top">

                        <?php dynamic_sidebar('home-page-top'); ?>

                        <div class="clrs"></div>

                    </div>

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



	<div id="home-footer-top">

    	<div class="home-footer-top">

    	<?php dynamic_sidebar('home-footer-top'); ?>

    	<div class="clrs"></div>

    </div>

    <div class="clrs"></div>

    </div>

<?php get_footer(); ?>