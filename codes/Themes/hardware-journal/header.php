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
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
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
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/slicknav.css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/meanmenu.css" />
<script src="<?php bloginfo('template_url'); ?>/js/jquery.slicknav.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jPages.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.meanmenu.js"></script>
<script type="text/javascript">
function validateForm1()
{
var x=document.forms["myForm1"]["s"].value;
if (x==null || x=="")
  {
  alert("Search Parameter must be filled out");
  return false;
  }
}                  
jQuery(document).ready(function(){
jQuery('.main-navigation').slicknav({
prependTo:'.navwrap'
});
jQuery("<div class='product_cat_nav'></div>").insertBefore(".widget-area .menu-product-categories-container");
/*jQuery('.widget-area .menu-product-categories-container').slicknav({
prependTo:'.product_cat_nav',
label: 'Product Categories'
});*/
var str = jQuery("#secondary .widget_nav_menu .widget-title").text();
jQuery('.widget-area .menu-product-categories-container').meanmenu({
meanMenuOpen: str+" <div class='three-lines openlines'><span /><span /><span /></div>",
meanMenuClose: str+" <div class='three-lines closelines'>X</div>",
meanScreenWidth: "768",
meanMenuContainer: '.product_cat_nav'
});
jQuery("ul.products").attr("id",'paginavid');
jQuery("div.holder").jPages({
        containerID  : "paginavid",
        perPage      : 8,
        startPage    : 1,
        startRange   : 1,
		previous: "« Previous",
        next: "Next »",
        midRange     : 5,
        endRange     : 1
});
jQuery("div.holder").jPages({
        containerID  : "articlesarea",
        perPage      : 3,
        startPage    : 1,
        startRange   : 1,
		previous: "« Previous",
        next: "Next »",
        midRange     : 5,
        endRange     : 1
});
});
</script>
</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
    	<div class="nav-wraps">
    	<div class="pagewraps">
    	<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav>
        <div class="clrs"></div>
        </div>
        </div>
        <div class="headwraps">
		<div class="pagewraps">
			<div class="search-wraps">
            	<?php get_search_form(); ?>
                <div class="navwrap">
                <div class="clrs"></div>
                </div>
            </div>
            <div class="logo-wraps">
                <?php dynamic_sidebar('media-kit'); ?>
            </div>
		<div class="clrs"></div>
        </div>
		<div class="clrs"></div>
        </div>
       	<div class="pagewraps pagewrapping">
            <div class="media-kit-responsive">
        	<?php dynamic_sidebar('media-kit-responsive'); ?>
       	</div>	
            <div class="clrs"></div>
        </div>
        <?php if(is_front_page()){ ?>
        <div class="slider-wraps">
        <div class="left-ads">
        <?php dynamic_sidebar('left-ads'); ?>
        </div>
        <div class="pagewraps pagewrapping">
        	<?php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow(); } ?>
            <div class="clrs"></div>
            <div class="newsletter-wraps">
            <?php dynamic_sidebar('newsletter-subscribe'); ?>
            <div class="clrs"></div>
            </div>
        </div>
        <div class="right-ads">
        <?php dynamic_sidebar('right-ads'); ?>
        </div>
            <div class="clrs"></div>
        </div>
        <?php } ?>
<!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="main" class="wrapper">
    <?php if(!is_front_page()){ ?>
		        <div class="left-ads">
        <?php dynamic_sidebar('left-ads'); ?>
        </div>
		<?php } ?>
    <div class="pagewraps pagewrapping">