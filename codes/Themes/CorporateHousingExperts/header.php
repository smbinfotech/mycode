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
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
    <!--[if gte IE 9]
        <style type="text/css">
        .gradient {
        filter: none;
        }
        </style>
        <![endif]-->
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/meanmenu.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/slicknav.css" />
    <?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.meanmenu.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.slicknav.js"></script>
<script type="text/javascript">
jQuery(document).ready(function () {
   jQuery('header nav.main-navigation-top').meanmenu({
		meanMenuContainer:'body'
});
jQuery('#menu-main-menu').slicknav({
	label: '',
	prependTo:'#navbar'
});
var i = 0;
	jQuery(".inner-thumbs img").attr('class', function() {
	i++;
	return 'imgs img'+i;
	});
});
</script>
<script type="text/javascript" src="<?php bloginfo("template_directory"); ?>/js/jquery.numeric.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(jQuery){
jQuery("#num").numeric();
jQuery('#name,#city').keydown(function (e) {
var key = e.keyCode;
if (!((key == 8) || (key == 32) || (key == 9) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
e.preventDefault();
}
});
});
</script>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div class="home-link">
            	<div class="header-left">
                    <div class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                    	<img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="Corporate Housing Experts" />
                   </a>
                  </div> 
                </div>
                <div class="header-right">
                <nav id="site-navigation" class="navigation main-navigation-top" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'topnav', 'menu_class' => 'nav-menu nav-menutop' ) ); ?>
				</nav>
                	<?php dynamic_sidebar('header-sidebar'); ?>
                </div>
               <div class="clear"></div>
			</div>

			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'mainnav', 'menu_class' => 'nav-menu' ) ); ?>
					<?php #get_search_form(); ?>
				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->
		</header><!-- #masthead -->

		<div id="main" class="site-main">
