<?php
/**
 * Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
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
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
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
<script language="javascript" src="<?php bloginfo('template_url'); ?>/js/html5-site.js"></script>
<script type="text/javascript">
function hideshow(which){
if (!document.getElementById)
return
if (which.style.display=="none")
which.style.display="block"
else
which.style.display="none"
}
</script>
</head>

<body <?php body_class(); ?>>
<section id="sr-container">
<header>
  <div class="sr-top-info">
    <aside>
      <ul>
        <?php dynamic_sidebar( 'top-info' ); ?>
      </ul>
      <div class="clr"></div>
    </aside>
  </div>
  <aside>
    <div id="sr-logo"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
      <?php dynamic_sidebar( 'logo' ); ?>
      </a></div>
    <div id="sr-nav-bar">
      <div class="sr-phone">
        <?php dynamic_sidebar( 'call' ); ?>
      </div>
      <nav>
        <div id="access" role="navigation">
          <?php /* Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
          <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>">
            <?php _e( 'Skip to content', 'twentyten' ); ?>
            </a></div>
          <?php /* Our navigation menu. If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
          <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
        </div>
      </nav>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="sr-search-bar"><span>
      <aside class="desktop"><?php dynamic_sidebar( 'search' ); ?></aside>
      
      
      
      <aside class="mobile"><a href="javascript:hideshow(document.getElementById('adiv'))"><img src="<?php bloginfo('template_directory'); ?>/images/search-icon.png" alt="Search"></a>
        <div id="adiv" style="display:none">
          <?php dynamic_sidebar( 'search' ); ?>
        </div>
      </aside>
      
      
      
      </span>
      <?php dynamic_sidebar( 'tagline' ); ?>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </aside>
</header>
<!-- #header --> 