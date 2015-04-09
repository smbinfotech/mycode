<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<section id="sr-home-main-cta">
        		<aside class="frontcta">
                    	<div class="frontctatext">
                        	<a href="<?php bloginfo('url'); ?>/borrower-hard-private-money-loan-lender-financing/">
                            	<img alt="Borrowers" src="<?php bloginfo('template_directory'); ?>/images/borrowers.jpg"></a>
                                <h5>Borrowers</h5>
                                Providing equity-based lending
                                for borrowers, corporations, and
                                estates on Residential...</div>
				</aside>
                <aside class="frontcta">
                    	<div class="frontctatext">
                        	<a href="<?php bloginfo('url'); ?>/broker-hard-private-money-loan-lender-financing/">
                            	<img alt="Mortgage Brokers" src="<?php bloginfo('template_directory'); ?>/images/brokers.jpg"></a>
                                <h5>Mortgage Brokers</h5>
                                Socotra Capital will give you
                                personalized attention and reliable
                                service...</div>
				</aside>
                <div class="clear"></div>
                </section>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>