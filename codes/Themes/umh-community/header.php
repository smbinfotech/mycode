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

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/meanmenu.css" media="all" />

<?php wp_head(); ?>
<?php
global $blog_id;
if($blog_id == '7'){
?>
<style>
.main-navigation li a{ padding: 3px 20px 2px; }
</style>
<?php	
}
?>
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
</head>



<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">

    	<div id="header">

		<hgroup>

			<div class="logo">

            	<a href="<?php bloginfo('url'); ?>">

                	<?php dynamic_sidebar('logo-sidebar'); ?>

                </a>

            </div>

            <div class="header-right">

	            <div class="header-social-print">

				<div class="header-links">
                    <img width="33" height="32" align="top" alt="United Methodist Homes" src="<?php bloginfo('template_url'); ?>/images/umh-icon-home.png">
                    	<a href="<?php echo network_site_url(); ?>" target="_blank">About UMH</a> <span>|</span> 
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