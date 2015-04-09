<?php
/* Template Name: Full Width Template */

get_header(); ?>

<div id="sr-content" class="inner">
  <?php if(function_exists('rdfa_breadcrumb')){ rdfa_breadcrumb(); } ?>
  <div class="sr-full-width-area">
    <?php
			/*
			 * Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			get_template_part( 'loop', 'page' );
			?>
  </div>
  <div class="clr"></div>
</div>
<?php get_footer(); ?>
