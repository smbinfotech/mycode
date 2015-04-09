<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<div class="clrs"></div>
		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php get_sidebar( 'footer' ); ?>
	<!--	<iframe src="http://www.fortunericebranhealth.com/#footer" height="195px" width="1000px" seamless="seamless" scrolling="no" frameborder="0" onload="totop()"></iframe>
	-->	<div class="footerColor" id="footer">
      <div class="footerLeft footerTop"><span id="update_count" class="counter">3399</span>
      
     <span id="atag"> people have pledged to use Fortune Rice Bran Health. Have you? 
      <a href="#"><img width="44" hspace="10" height="21" align="absmiddle" alt="Yes" src="<?php bloginfo('template_url'); ?>/images/counter-yes.gif" onclick="update_click_count();"></a></span></div>
      <div class="footerRight footerTop"> <a target="_blank" rel="nofollow" href="http://www.fortunecookingoil.com"><img width="13" hspace="5" height="14" align="absmiddle" src="<?php bloginfo('template_url'); ?>/images/back.png"> Back to main Site</a></div>
      <div class="clrs bdrBtm"></div>
      <div class="bdrBtm disclaimer">
          <p>Adequate exercise and balanced diet which includes balanced healthy cooking oil are key to good health </p>
          <p class="last">∞:Source: Joint FAO/WHO Food Standards Programme, Codex Committee on Fats and Oils, 18th Session, U.K., 3-7th February. 2003 #: Nearest to WHO recommendations +:Woyengo et al., Anticancer effects of phytosterols; Eur. Jour. Clin Nutr. (2009) 63, 813-821  ^: Ferulic Acid = 4 hydroxy 3 methoxy cinnamic acid.</p>
      </div>
      <div class="footerLeft footerBtm">Copyright 2012 Fortune Rice Bran Health. <a target="_blank" rel="nofollow" href="http://www.fortunericebranhealth.com/news.php">In the News </a> 
      <div class="clrs"></div>
    </div>
    
    <div class="clrs"></div>
		</footer><!-- #colophon -->
	</div> <!-- #page -->

	<?php wp_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.bxslider.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("#masonry-wrapper").masonry({ 
	singleMode: true, 
	itemSelector: '.post'
  });
jQuery("#masonry-wrapper1").masonry({ 
	singleMode: true, 
	itemSelector: '.post'
  });
jQuery(".widget_newsletterwidget .widget-title").click(function(){
jQuery(".newsletter-widget").toggle("slow");
});
var i = 0;
jQuery(".sidebar-inner .widget_text").attr('class', function() {
i++;
return 'widget_text widget widget'+i;
});
jQuery(".wid-title1").click(function(){
jQuery(".wid-cont1").toggle("slow");
jQuery(this).find("img").toggle();
});
jQuery(".wid-title2").click(function(){
jQuery(".wid-cont2").toggle("slow");
jQuery(this).find("img").toggle();
});
jQuery(".widget_categories ul").css("display","none");
jQuery(".widget_categories .widget-title").append("<img src='<?php bloginfo("template_url"); ?>/images/side-green.png' style='display: inline;' /> <img src='<?php bloginfo("template_url"); ?>/images/btm-green.png' style='display: none;' />");
jQuery(".widget_categories .widget-title").click(function(){
jQuery(".widget_categories ul").toggle("slow");
jQuery(this).find("img").toggle();
});
jQuery(".widget_recent_entries ul").css("display","none");
jQuery(".widget_recent_entries .widget-title").append("<img src='<?php bloginfo("template_url"); ?>/images/side-orange.png' style='display: inline;' /> <img src='<?php bloginfo("template_url"); ?>/images/btm-orange.png' style='display: none;' />");
jQuery(".widget_recent_entries .widget-title").click(function(){
jQuery(".widget_recent_entries ul").toggle("slow");
jQuery(this).find("img").toggle();
});
jQuery(".widget_nav_menu .menu-recipe-menu-container").css("display","none");
jQuery(".widget_nav_menu .widget-title").append("<img src='<?php bloginfo("template_url"); ?>/images/side-orange.png' style='display: inline;' /> <img src='<?php bloginfo("template_url"); ?>/images/btm-orange.png' style='display: none;' />");
jQuery(".widget_nav_menu .widget-title").click(function(){
jQuery(".widget_nav_menu .menu-recipe-menu-container").toggle("slow");
jQuery(this).find("img").toggle();
});
var j = 0;
jQuery(".archive-wraps").attr('class', function() {
j++;
return 'archive-wraps archive-wraps'+j;
});
var k = 0;
jQuery(".arch-wrap").attr('class', function() {
k++;
return 'arch-wrap arch-wrap'+k;
});
jQuery(".archive-wraps strong").click(function(){
jQuery(this).next(".arch-wrap").toggle("slow");
jQuery(this).find("img").toggle();
});
jQuery('.bxslider').bxSlider({
	mode:'horizontal',
	controls: false,
	auto : true,
});
jQuery(".comment-form-author input").attr("placeholder","Name");
jQuery(".comment-form-email input").attr("placeholder","Email");
jQuery(".comment-form-comment textarea").attr("placeholder","Comment");
jQuery(".form-submit #submit").attr("value","Submit");
if(navigator.userAgent.match(/Trident.*rv:11\./)) {
    jQuery('body').addClass('ie11');
}
});
/*function autoScroll() {
        window.scroll(0,0); // Horizontal/Vertical Position
}*/
if (navigator.userAgent.indexOf("MSIE 10") > -1) {
    document.body.classList.add("ie10");
}
</script>        
</body>
</html>