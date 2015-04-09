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
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<div id="sr-banner">
  <aside><?php echo do_shortcode('[layerslider id="1"]'); ?></aside>
</div>
<div id="sr-cta-nav">
  <aside><span>
    <?php dynamic_sidebar( 'banner-navigation' ); ?>
    </span></aside>
</div>
<div id="sr-content">
  <?php
			/*
			 * Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			get_template_part( 'loop', 'page' );
			?>
</div>
<!-- #content -->

<div id="sr-btm-box">
  <div class="sr-left"> <strong>Latest Equipment Update</strong>
    <iframe width="282" height="191" src="https://www.youtube.com/embed/GuLO8sil1GU" frameborder="0" allowfullscreen></iframe>
    <span>Showcasing TurboChef iSeries:</span> Utilizing TurboChef's patented technology to rapidly cook food without compromising quality, the ventless iSeries ovens maximize throughput and versatility with it’s large cavity size and ability to cook with most any metal pan. Utilizing TurboChef's patented technology to rapidly cook food without compromising quality, the ventless iSeries ovens maximize throughput and versatility with it’s large cavity size.
    <div class="clr"></div>
    <a href="#" class="subscribe"><em><img src="<?php bloginfo('template_directory'); ?>/images/mail-icon02.jpg" alt=""></em>Subscribe Now!</a> </div>
  <div class="sr-right">
    <?php dynamic_sidebar( 'contact-form' ); ?>
  </div>
  <div class="clr"></div>
</div>
<div id="sr-em-box"><strong><span>Equipment Manufacturers</span></strong>
  <aside> <img src="/wp-content/uploads/2014/11/allied.jpg" alt=""> <img src="/wp-content/uploads/2014/11/angelo-po.jpg" alt=""> <img src="/wp-content/uploads/2014/11/blakeslee.jpg" alt=""> <img src="/wp-content/uploads/2014/11/deluxe.jpg" alt=""> <img src="/wp-content/uploads/2014/11/enofrigo.jpg" alt=""> <img src="/wp-content/uploads/2014/11/erco.jpg" alt=""> <img src="/wp-content/uploads/2014/11/hubbell.jpg" alt=""> <img src="/wp-content/uploads/2014/11/impact-menu-systems.jpg" alt=""> <img src="/wp-content/uploads/2014/11/jasper-chair.jpg" alt=""> <img src="/wp-content/uploads/2014/11/rasito-bisani.jpg" alt=""> <img src="/wp-content/uploads/2014/11/rotisol.jpg" alt=""> <img src="/wp-content/uploads/2015/02/Smart-Kitchen.jpg" alt=""> <img src="/wp-content/uploads/2014/11/shat-r-shield.jpg" alt=""> <img src="/wp-content/uploads/2014/11/seco.jpg" alt=""> <img src="/wp-content/uploads/2014/11/thunder-group.jpg" alt=""> <img src="/wp-content/uploads/2014/11/turbochef.jpg" alt=""> <img src="/wp-content/uploads/2014/11/turbo-air.jpg" alt=""> <img src="/wp-content/uploads/2014/11/utility.jpg" alt=""> <img src="/wp-content/uploads/2014/11/walsh-simmons-seating.jpg" alt=""> <img src="/wp-content/uploads/2014/11/wabash-valley.jpg" alt=""> </aside>
</div>
<?php get_footer(); ?>
