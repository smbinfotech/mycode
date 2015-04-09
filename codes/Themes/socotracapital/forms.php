<?php
/**
Template Name: Forms Template
*/

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
                   	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-content">
						<?php the_content(); ?>
                        </div>
                        </article>
                        <?php
                    endwhile;
                    ?>
				<ul class="formslinks">
                	<li><a href="<?php bloginfo('url'); ?>/borrower-hard-private-money-loan-lender-financing/borrowers-short-form/">Borrowers Short Form Application</a></li>
                    <li><a href="<?php bloginfo('url'); ?>/wp-content/uploads/2013/09/SocotraCapitalResidentialLoanApplication.pdf">Borrowers Long Form Application</a></li>
                    <li><a href="<?php bloginfo('url'); ?>/broker-hard-private-money-loan-lender-financing/broker-approval-form/">Broker Approval Form</a></li>
                    <li><a href="<?php bloginfo('url'); ?>/broker-hard-private-money-loan-lender-financing/broker-loan-submission-form/">Brokers Loan Submission From</a></li>
                </ul>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>