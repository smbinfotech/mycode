<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]--><head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/meanmenu.css" media="all" />
<script src="<?php bloginfo('template_url'); ?>/js/jquery.meanmenu.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jPages.js"></script> 
<script type="text/javascript">
jQuery(document).ready(function(){
 jQuery('#site-navigation .menu-primary-menu-container').meanmenu();
	var i = 0;
	jQuery("#home-footer-top .widget").attr('class', function() {
	i++;
	return 'widget_text widget widget'+i;
	});
	var j = 0;
	jQuery(".footer-widgets .widget_nav_menu").attr('class', function() {
	j++;
	return 'widget_nav_menu widget widget'+j;
	});
	var k = 0;
	jQuery(".home-page-comm .widget_text").attr('class', function() {
	k++;
	return 'widget_text widget widget'+k;
	}); 
	/*jQuery(window).scroll(function(){
    if (jQuery(window).scrollTop() >= 160) {
       jQuery('.main-navigation').addClass('fixed');
	   jQuery('.mean-bar').addClass('fixed');
    }
    else {
       jQuery('.main-navigation').removeClass('fixed');
	   jQuery('.mean-bar').removeClass('fixed');
    }
});*/
jQuery("div.holder").jPages({
        containerID  : "news_container",
        perPage      : 10,
        startPage    : 1,
        startRange   : 1,
		previous: "Previous",
        next: "Next",
        midRange     : 5,
        endRange     : 1
    });
var ht_news = jQuery('#news_container').html();
if (ht_news != 0) {
}
else{
jQuery('div.holder').css('display','none');
}
jQuery('.printomatic').attr('title', 'Print this Page');
/* 
jQuery("#small").click(function(event){
event.preventDefault();
jQuery("#content").animate({"font-size":"14px", "line-height":"18px"});
});
jQuery("#medium").click(function(event){
event.preventDefault();
jQuery("#content").animate({"font-size":"16px", "line-height":"20px"});
});
jQuery("#large").click(function(event){
event.preventDefault();
jQuery("#content").animate({"font-size":"20px", "line-height":"24px"});
});
*/
jQuery(".TestimonialRotatorWidget").click(function(){
	var url = '<?php bloginfo('url'); ?>/testimonials/';
	jQuery(location).attr('href', url);
});
jQuery('#name, #namec, #firstnames, #lastnames, #firstnamec, #lastnamec').keydown(function(e){
var key = e.keyCode;
if (!((key == 8) || (key == 32) || (key == 9) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
e.preventDefault();
}
});
jQuery("#zip").attr("maxLength", 5);
jQuery("#zip").keydown(function (e) {
if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) {
return;
}
if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
e.preventDefault();
}
});
jQuery("#socialfloat").click(function(){
jQuery("#sthoverbuttons").toggle("slow");
});
});
</script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	// clear cf7 error msg on mouseover
	$(".wpcf7-form-control-wrap").mouseover(function(){
		$obj = $("span.wpcf7-not-valid-tip",this);
    	        $obj.css('display','none');
	});
});
</script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fluidtextresizer.js"></script>
<script type="text/javascript">
      var mytextsizer = new fluidtextresizer({
          controlsdiv: "sizecontroldiv", //id of special div containing your resize controls. Enter "" if not defined
          targets: ["#content"], //target elements to resize text within: ["selector1", "selector2", etc]
	      levels: 3, //number of levels users can magnify (or shrink) text
          persist: "session", //enter "session" or "none"
          animate: 300 //animation duration of text resize. Enter 0 to disable
});
</script>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
    	<div id="header">
		<hgroup>
			<div class="logo">
            	<a href="<?php bloginfo('url'); ?>">
                	<img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="United Methodist Home" />
                </a>
            </div>
            <div class="header-right">
	            <div class="header-social-print">
                   <div class="header-links">
                    <img width="33" height="32" align="top" alt="United Methodist Homes" src="<?php bloginfo('template_url'); ?>/images/umh-icon-home.png">
                    	<a href="<?php bloginfo('url'); ?>" target="_blank">About UMH</a> <span>|</span> 
                        <a href="http://www.umhfoundation.org/" target="_blank">UMH Foundation</a>
                    </div>
					<div class="header-social"><?php dynamic_sidebar('header-social'); ?></div>
                    <div class="header-print"><?php dynamic_sidebar('header-print'); ?></div>
                    <div class="clrs"></div>
                </div>    
            	<div class="header-tagline"><?php dynamic_sidebar('header-tagline'); ?></div>
           		<div class="clrs"></div>
            </div>
            <div class="clrs"></div>
		</hgroup>
        <div class="clrs"></div>
		</div>
        <div class="clrs"></div>
	</header><!-- #masthead -->
        <div class="navs">
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav>
        <div class="clrs"></div>
        </div>
        <!-- #site-navigation -->
	<div id="main" class="wrapper">