<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<div role="complementary" class="widget-area" id="secondary">
<aside class="sidelinks">
<div class="sidelinks-title">
	<h3>Borrowers</h3>
</div>
<div class="menu-borrowers-links-container">
	<ul class="menu" id="menu-borrowers-links">
		<li>
        	<a href="<?php bloginfo('url'); ?>/borrower-hard-private-money-loan-lender-financing/">Borrowers</a>
        </li>
		<li>
        	<a href="<?php bloginfo('url'); ?>/borrower-hard-private-money-loan-lender-financing/borrowers-short-form/">Short Form Application</a>
        </li>
		<li>
        	<a href="<?php bloginfo('url'); ?>/wp-content/uploads/2013/09/SocotraCapitalResidentialLoanApplication.pdf">Long Form Application</a>
        </li>
		<li>
        	<a href="<?php bloginfo('url'); ?>/deals-funded/">Deals Funded</a>
        </li>
		<li>
        	<a href="<?php bloginfo('url'); ?>/company/about-us/">About Us</a>
        </li>
	</ul>
</div>
</aside>

<aside class="sidelinks">
<div class="sidelinks-title">
	<h3>Brokers</h3>
</div>
<div class="menu-brokers-links-container">
	<ul class="menu" id="menu-brokers-links">
    	<li>
        	<a href="<?php bloginfo('url'); ?>/broker-hard-private-money-loan-lender-financing/">Brokers</a>
         </li>
		<li>
        	<a href="<?php bloginfo('url'); ?>/broker-hard-private-money-loan-lender-financing/broker-approval-form/">Broker Approval Form</a>
        </li>
		<li>
        	<a href="<?php bloginfo('url'); ?>/broker-hard-private-money-loan-lender-financing/broker-loan-submission-form/">Loan Submission Form</a>
        </li>
		<li>
        	<a href="<?php bloginfo('url'); ?>/deals-funded/">Deals Funded</a>
        </li>
	</ul>
</div>
</aside>

<aside class="sidelinks">
<div class="sidelinks-title">
	<h3>Quick</h3>
</div>
<div class="menu-quick-links-container">
	<ul class="menu" id="menu-quick-links">
    	<li>
        	<a href="<?php bloginfo('url'); ?>">Home</a>
        </li>
		<li>
        	<a href="<?php bloginfo('url'); ?>/borrower-hard-private-money-loan-lender-financing/">Borrowers</a>
        </li>
		<li>
        	<a href="<?php bloginfo('url'); ?>/broker-hard-private-money-loan-lender-financing/">Brokers</a>
        </li>
		<li>
        	<a href="<?php bloginfo('url'); ?>/deals-funded/">Deals Funded</a>
        </li>
		<li>
        	<a href="<?php bloginfo('url'); ?>/accredited-investors/">Accredited Investors</a>
        </li>
		<li>
        	<a href="<?php bloginfo('url'); ?>/sitemap/">Sitemap</a>
        </li>
	</ul>
</div>
</aside>


	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php endif; ?>
	</div>
