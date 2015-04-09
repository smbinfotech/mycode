<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
</div>
<div class="clr"></div>
<div id="bottoms-arrows" class="grey-arrow"><a class="greys" onclick="scrollto('bottoms4');" href="javascript:void(0)"></a></div>
<footer>
  <div class="sr-mid-container bottoms4">
  <?php dynamic_sidebar('footer-top'); ?>
    <div class="clr"></div>
  </div>
</footer>
<div id="sr-footer-btm-links">
  <div class="sr-mid-container">
  <?php dynamic_sidebar('footer-bottom'); ?>
    <div class="clr"></div>
  </div>
</div>
<!-- #colophon -->
</div>
<!-- #container -->

<?php wp_footer(); ?>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.meanmenu.js"></script>
<script type="text/javascript">
jQuery(document).ready(function () {
/*jQuery('header nav').meanmenu({
meanScreenWidth: "920",
meanMenuContainer: '#sr-container'
});*/
});
</script>
<div id="quoteform" style="display:none;">
<?php echo do_shortcode('[contact-form-7 id="518" title="Request a Quote"]'); ?>
</div>
<div id="sampleform" style="display:none;">
<?php echo do_shortcode('[contact-form-7 id="519" title="Request a Sample"]'); ?>
</div>
<div id="whitepaperform" style="display:none;">
<?php echo do_shortcode('[contact-form-7 id="2005" title="Download White Paper Form"]'); ?>
</div>
</body></html>