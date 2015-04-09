<?php
/**
 * Template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<div id="sr-content" class="inner">
  <?php if(function_exists('rdfa_breadcrumb')){ rdfa_breadcrumb(); } ?>
  <div class="sr-right-area">
    <?php if ( have_posts() ) : ?>
    <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    <?php
				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
    <?php else : ?>
    <div id="post-0" class="post no-results not-found">
      <h1 class="equip-heading"><span>
        <?php _e( 'Nothing Found', 'twentyten' ); ?></span>
      </h1>
      <div class="entry-content">
        <p>
          <?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?>
        </p>
        <?php get_search_form(); ?>
      </div>
      <!-- .entry-content --> 
    </div>
    <!-- #post-0 -->
    <?php endif; ?>
  </div>
  <div class="sr-left-area">
    <?php get_sidebar(); ?>
  </div>
  <div class="clr"></div>
</div>
<?php get_footer(); ?>
