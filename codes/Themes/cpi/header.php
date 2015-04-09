<?php
/**
 * Header template for the theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) & !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
<?php
	// Print the <title> tag based on what is being viewed.
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/responsive.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/*
	 * We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/meanmenu.css" media="all" />
<script src="<?php bloginfo('template_url'); ?>/js/scriptbreaker-multiple-accordion.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/indapp.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jPages.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/custom.js"></script>
</head>
<body <?php body_class(); ?>>
<div id="sr-container">
<header>
<div id="headerwrap" class="headerwrap">
  <div class="sr-mid-container">
    <div class="sr-tagline desktop"><?php dynamic_sidebar('tagline'); ?></div>
    <div class="sr-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="Control Products, Inc."></a></div>
    <div class="sr-tagline mobile"><?php dynamic_sidebar('tagline'); ?></div>
    <div class="sr-top-right-info"><?php dynamic_sidebar('top-info'); ?>
      <?php dynamic_sidebar( 'social' ); ?>
      <?php dynamic_sidebar('top-phone'); ?>
      <?php get_search_form(); ?>
    </div>
    <div class="clr"></div>
  </div>
  <div class="clr"></div>
  <nav>
    <div class="sr-mid-container">
      <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
      <div class="clr"></div>
    </div>
  </nav>
  <div class="clr"></div>
</div>
</header>
<div id="main" class="main-container-wrapper">


