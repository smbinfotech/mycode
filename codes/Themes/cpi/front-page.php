<?php
/**
 * Template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

<div id="sr-banner"><?php echo do_shortcode('[meteor_slideshow]'); ?><!--<img src="<?php bloginfo('template_directory'); ?>/images/banner-img.jpg" alt="">--></div>
<div id="sr-mid-box">
  <div class="sr-mid-container">
  <?php dynamic_sidebar('tagline2'); ?>
    <aside>
    <?php dynamic_sidebar('home-top-content'); ?>
    </aside>
  </div>
  <div class="scroll-arrows">
  
  </div>
</div>
<div id="sr-white-paper">
  <div class="sr-mid-container">
  <?php dynamic_sidebar('whitepaper'); ?>
  </div>
</div>
<div id="bottoms-arrows"><a class="greys" onclick="scrollto('bottoms1');" href="javascript:void(0)"></a></div>
<div id="sr-announcement">

  <div class="sr-mid-container bottoms1">
  
    <ul>
    <?php dynamic_sidebar('product-desc'); ?>
    </ul>
  </div>
</div>
<div id="bottoms-arrows" class="blue-arrow"><a class="blues" onclick="scrollto('bottoms2');" href="javascript:void(0)"></a></div>
<div id="sr-links-box">
  <div class="sr-mid-container ind-app-container bottoms2">
  	<div class="appindcontainer">
  		<div class="ind-app-wrapper ones">
        	<div class="ind-app-title">Industry</div>
        </div>
        <div class="ind-app-wrapper twos">
        	<div class="ind-app-title">Application</div>
        </div>
<!--        <div class="ind-app-wrapper threes">
        	<div class="ind-app-title">Products</div>
        </div>-->
		<div class="clr"></div>
      </div>  
		<div class="ind-app-menu desktopmenu">
          <div class="menu-industry-application-menu-container">
            <ul class="menu" id="menu-industry-application-menu">
        	<?php dynamic_sidebar('industry-application'); ?>
            </ul>
          </div>
        </div>  
        
        
        <div class="ind-app-menu mobilemenu">
          <div class="menu-industry-application-menu-container">
            <ul class="menu indappmenuwrap" id="menu-industry-application-menu">
        	<?php dynamic_sidebar('industry-application'); ?>
            </ul>
          </div>
        </div>
        
                    
        	<?php #wp_nav_menu( array( 'menu' => 'Industry Application Menu' ) ); ?>
        </div>
  </div>
</div>
<div id="bottoms-arrows" class="blue-arrow conts"><a class="blues" onclick="scrollto('bottoms3');" href="javascript:void(0)"></a></div>

<div id="sr-btm-cnt">
  <div class="sr-mid-container bottoms3">
    <aside>
      <?php while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'content', 'page' ); ?>
      <?php endwhile; // end of the loop. ?>
    </aside>
    <div class="clr"></div>
  </div>
</div>
<?php get_footer(); ?>
