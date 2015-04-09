<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div id="sr-content" class="inner">
  <?php if(function_exists('rdfa_breadcrumb')){ rdfa_breadcrumb(); } ?>
  
  <div class="sr-right-area es">
     
      <div class="equip-heading"><span><?php echo single_cat_title( '', false ); ?></span></div>
      <?php if ( category_description() ) : // Show an optional category description ?>
     <!-- <div class="archive-meta"><?php //echo category_description(); ?></div>-->
      <?php endif; ?>
 
    <!-- .archive-header -->
    <?php 
			
			echo "<strong class='select-txt'>Please select your state:</strong>";
			 do_shortcode( '[search_filter tex_type="food-service-type"]' );?>
    <div class="holder" id="viv_meta_content"> </div>
  </div>

  <div class="sr-left-area">
    <?php get_sidebar(); ?>
  </div>
  <div class="clr"></div>
</div>
<?php get_footer(); ?>
