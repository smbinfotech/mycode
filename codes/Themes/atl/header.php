<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
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
<meta name="viewport" content="width=device-width">
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
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/slicknav.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/menu.css" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<script language="javascript" src="<?php bloginfo('template_url'); ?>/js/html5-site.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/modernizr.min.js"></script>

<script src="<?php bloginfo('template_url'); ?>/js/jquery.slicknav.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery('#access').slicknav();
jQuery("#wpmem_reg .form").validate({
			rules: {
				first_name: "required",
				last_name: "required",
				logs: {
					required: true,
					minlength: 2
				},
				password: {
					required: true,
					minlength: 5
				},
				confirm_password: {
					required: true,
					minlength: 6,
					equalTo: "#password"
				},
				user_email: {
					required: true,
					email: true
				}
			},
			messages: {
				first_name: "Please enter your firstname",
				last_name: "Please enter your lastname",
				logs: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				user_email: "Please enter a valid email address"
			}
		});
jQuery("#wpmem_login .form").validate({
			rules: {
				logs: {
					required: true,
				},
				user: {
					required: true,
				},
				email: {
					required: true,
				},
				pwd: {
					required: true,
				}
			},
			messages: {
				logs: {
					required: "Please enter a username",
				},
				user: {
					required: "Please enter a username",
				},
				email: {
					required: "Please enter a valid email address",
				},
				pwd: {
					required: "Please provide a password",
				}
			}
		});		
/*if ('#cmd_file_thumbs table tbody:empty') {
jQuery('#cdm_wrapper').css('min-height','250px');
};	
*/
jQuery("#upload_form p").each(function() {
jQuery('#upload_form p:empty').remove();
});
});
function validateForm()
{
var x=document.forms["sp_upload_form"]["dlg-upload-name"].value;
if (x==null || x==""){
alert("Please Enter a File Name");
return false;
}
var mydiv=document.getElementById('upload_list');
if(!mydiv.hasChildNodes()){
alert("Please Upload a File");
return false;
}
}
</script>
<!--<?php if(!current_user_can('activate_plugins') && is_user_logged_in()) { 
?>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("#menu-top-menu").append("<li class='file-upload menu-item menu-item-type-post_type menu-item-object-page' id='file-upload'><a href='<?php bloginfo('url'); ?>/user-file-upload'>User File Upload</a></li>");
jQuery("#menu-top-menu").append("<li class='file-upload menu-item menu-item-type-post_type menu-item-object-page' id='file-upload'><a href='<?php bloginfo('url'); ?>/admin-file-upload'>Admin File Upload</a></li>");
});
</script>
<?php } ?>-->
<?php if(is_page(559)){ ?>
<script type="text/javascript">
jQuery(document).ready(function(){
var i = 0;
jQuery(".myClass").attr('class', function() {
i++;
return 'myClass'+i;
});
var uns = jQuery("#usersnames").html();
jQuery("#usersnames").remove();
jQuery('.myClass3').after("<div id='unames'></div>");
jQuery('#unames').html(uns);
});
</script>
<?php } ?>
</head>

<body <?php body_class(); ?>>
<?php if((is_page(561) || is_page(576)) && current_user_can('activate_plugins') && is_user_logged_in()){
wp_redirect(home_url()); exit;
}
?>
<?php if(is_page(560) && is_user_logged_in()){
wp_redirect(home_url()); exit;
}
?>
<?php if(is_page(559) && is_user_logged_in()){
wp_redirect(sites_urls()); exit;
}
?>
<section id="sr-main-container">
<section id="sr-container">
<header>
  <section id="sr-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
    <?php dynamic_sidebar( 'logo' ); ?>
    </a></section>
  <section id="sr-top-area">
  	<?php if(is_user_logged_in()) { 
	echo do_shortcode('[wpmem_logout]');
	if(!current_user_can('activate_plugins')){ ?>
    <a href='<?php bloginfo('url'); ?>/change-password' class="register loggedin">Change Password</a>
    <a href='<?php bloginfo('url'); ?>/user-file-upload' class="register loggedin">User File Upload</a>
	<a href='<?php bloginfo('url'); ?>/admin-file-upload' class="register loggedin">Admin File Upload</a>
	<?php
	}
	} else{
	?>
  	<a class="login" href="<?php bloginfo('url'); ?>/login/">Client Login</a>
    <a href="<?php bloginfo('url'); ?>/register/" class="register">Register</a>
    <?php } ?>
    <?php dynamic_sidebar( 'login' ); ?>
  </section>
  <section class="clr"></section>
</header>
<!-- #header -->
<nav>
  <div id="access" role="navigation">
    <?php /* Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
    <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>">
      <?php _e( 'Skip to content', 'twentyten' ); ?>
      </a></div>
    <?php /* Our navigation menu. If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
    <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
  </div>
  <section class="clr"></section>
</nav>
<section id="sr-banner">
  <?php if(is_front_page()){
				?>
  <?php if ( function_exists( 'show_simpleresponsiveslider' ) ) show_simpleresponsiveslider(); ?>
  <?php
			}
			else{
            if(has_post_thumbnail())
                      {
                       $thumbnail=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"full");
                        ?>
  <img src="<?php echo $thumbnail[0];?>" alt="<?php the_title();?>" class="featured-img"/>
  <?php }
				}
			?>
  <section class="clr"></section>
</section>
