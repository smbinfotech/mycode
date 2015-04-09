<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
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
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link href="ie.css" rel="stylesheet" type="text/css" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery(".menu-item-6").after("<li class='last menu-logo menu-item menu-item-type-post_type menu-item-object-page' id='menu-item-logo'><a href='<?php bloginfo('url'); ?>'><img src='<?php bloginfo('template_url'); ?>/images/logo.png' alt='<?php bloginfo('name'); ?>' /></a></li>");	
});
</script>    
<script type="text/javascript">
function validateForm1()
{
var x=document.forms["myForm1"]["s"].value;
if (x==null || x=="" || x=="Search")
  {
  alert("Search Parameter must be filled out");
  return false;
  }
}                  
</script>
<link type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery.bxslider.css">
<!--[if IE 9]>
<style>
.searchform input[type="submit"] { top: 0px; }
</style>
<![endif]-->
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
                    <?php dynamic_sidebar('sidebar-header'); ?>
				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->
		</header><!-- #masthead -->

		<div id="main" class="site-main">
		<div class="top-wrapper">
        	<div class="titleclass">
            	<h1><img src="<?php bloginfo('template_url'); ?>/images/blog-img.png" alt="" />Blog</h1>
            </div>
            <div class="search-breadcrumb">
            	<div class="searchform">
                	<div class="searchwrapper">
                        <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" onsubmit="return validateForm1()" name="myForm1">
                            <input type="text" class="field" autocomplete="off" id="s" name="s" value="Search" onfocus="(this.value == 'Search') && (this.value = '')"
       onblur="(this.value == '') && (this.value = 'Search')" />
                            <input type="submit" class="submit" name="submit" id="searchsubmit" value="" />
                        </form>
   					 </div>
                </div>
                <div class="breadcrumbsarea">
                    <a href="http://www.fortunericebranhealth.com/" id="homes">Home</a> &gt; <a href="<?php bloginfo('url'); ?>" id="blog">Blog</a>
                </div>
            </div>
            <div class="clrs"></div>
        </div>