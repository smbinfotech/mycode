<?php
/**
 * The Header for our theme.
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
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<script src="<?php bloginfo('template_directory'); ?>/js/jPages.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.countdown.js"></script>
<script type="text/javascript">
function validateForm()
{
var x=document.forms["myForm"]["s"].value;
if (x==null || x=="")
  {
  alert("Search Parameter must be filled out");
  return false;
  }
}

function validateForm1()
{
var x=document.forms["myForm1"]["s"].value;
if (x==null || x=="")
  {
  alert("Search Parameter must be filled out");
  return false;
  }
}                  
</script>
<script type="text/javascript">
jQuery(document).ready(function () {
	var i = 0;
	jQuery(".header-top-sidebar .widget_text").attr('class', function() {
	i++;
	return 'widget widget_text widget'+i;
	});
	var j = 0;
	jQuery("#secondary .widget_text").attr('class', function() {
	j++;
	return 'widget widget_text widget'+j;
	});
	jQuery("#togs").click(function() { 
<<<<<<< HEAD
	    jQuery("#mytoggle").toggle("slow");
=======
	    jQuery("#mytoggle").slideToggle("slow");
>>>>>>> 0717de3d381aa7b4086933d17120ab8740244116
   });
	jQuery("#togs1").click(function() { 
	    jQuery("#mytoggle1").slideToggle("slow");
  });
<<<<<<< HEAD
=======
  jQuery("#s").on("keypress", function(e) {
    if (e.which === 32 && !this.value.length)
        e.preventDefault();
});
  jQuery(".widget_search #s").on("keypress", function(e) {
    if (e.which === 32 && !this.value.length)
        e.preventDefault();
});
	jQuery("div.holder").jPages({
        containerID  : "testimonial_wrapper",
        perPage      : 10,
        startPage    : 1,
        startRange   : 1,
		previous: "« Previous",
        next: "Next »",
        minHeight: false,
        midRange     : 5,
        endRange     : 1
    });
	jQuery("div.holder1").jPages({
        containerID  : "gallery_wrapper",
        perPage      : 10,
        startPage    : 1,
        startRange   : 1,
		previous: "« Previous",
        next: "Next »",
        minHeight: false,
        midRange     : 5,
        endRange     : 1
    });
	jQuery("div.holder2").jPages({
        containerID  : "search-reultslist",
        perPage      : 10,
        startPage    : 1,
        startRange   : 1,
		previous: "« Previous",
        next: "Next »",
        minHeight: false,
        midRange     : 5,
        endRange     : 1
    });
>>>>>>> 0717de3d381aa7b4086933d17120ab8740244116
});
</script>
</head>

<body <?php body_class(); ?>>
<div id="main-wrapper">
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
    	<div class="headers">
	<div class="header-top-sidebar">
    	    <?php dynamic_sidebar('header-top-sidebar'); ?>
            <div class="clear"></div>
      </div>
      <div class="nav-logo-wrapper">
      			<hgroup>
			<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="Hagadone Marine Group Logo"></a>
		</hgroup>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><div class="searchwrapper">
   		 	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" onsubmit="return validateForm1()" name="myForm1">
                <input type="text" placeholder="Search Here..." class="field" autocomplete="off" id="s" name="s" value="">
                <input type="hidden" name="search-type" value="fullsite" />
                <input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'GO', 'HMG' ); ?>" />
			</form>
    </div><!-- #site-navigation -->
      <div class="clear"></div>
      </div>

        </div>
	</header><!-- #masthead -->
    
	<div class="banner" id="banner">
		<?php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow(); } ?>
        <div class="searchinventorywrapper">
            <div class="searchinventory">
                <a href="<?php bloginfo('url'); ?>/boat-api/">Search Our Boat Inventory</a>
            </div>
            <div class="clear"></div>
        </div>
        <?php if(is_front_page()){
			?>
            <div class="partner-logo" id="partner-logo">
			<?php dynamic_sidebar('partner-logo-widget'); ?>
            </div>
			<?php 
			}
			?>
    </div>
    <div class="clear"></div>
	<div id="main" class="wrapper">