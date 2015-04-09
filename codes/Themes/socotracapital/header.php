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
header("Access-Control-Allow-Origin: *");
?>
<xml version="1.0">
<!DOCTYPE>
<cross-domain-policy>
    <allow-access-from domain="*"/>
    <allow-http-request-headers-from domain="*.socotram.gopagoda.com" headers="*"/>
</cross-domain-policy>
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
<?php wp_head(); ?>
<!-- bxSlider CSS file -->
<link href="<?php bloginfo('template_directory'); ?>/css/jquery.bxslider.css" rel="stylesheet" />
<link href="<?php bloginfo('template_directory'); ?>/css/website.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.bxslider.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.tinyscrollbar.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.ba-hashchange.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jPages.js"></script>
<?php $siteurl =  get_site_url(); ?>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("#scrollbar1").tinyscrollbar();	
jQuery("#scrollbar2").tinyscrollbar();
jQuery('.bxslider').bxSlider({
  mode: 'fade',
  auto : true,
  pause : 7000,
  speed: 1000,
  controls: false,
  pager: false
});
var i = 0;
jQuery("#sr-home-main-cta .frontcta").attr('class', function() {
i++;
return 'frontcta frontcta'+i;
});
var j = 0;
jQuery(".footer-content .footeritems").attr('class', function() {
j++;
return 'footeritems footeritems'+j;
});
var items = jQuery('#v-nav>ul>li').each(function () {
       jQuery(this).click(function () {
            //remove previous class and add it to clicked tab
            items.removeClass('current');
            jQuery(this).addClass('current');

            //hide all content divs and show current one
            jQuery('#v-nav>div.tab-content').hide().eq(items.index(jQuery(this))).show('fast');

            window.location.hash = jQuery(this).attr('tab');
        });
    });

    if (location.hash) {
        showTab(location.hash);
    }
    else {
        showTab("tab1");
    }

    function showTab(tab) {
        jQuery("#v-nav ul li[tab=" + tab + "]").click();
    }

    // Bind the event hashchange, using jquery-hashchange-plugin
    jQuery(window).hashchange(function () {
        showTab(location.hash.replace("#", ""));
    })

    // Trigger the event hashchange on page load, using jquery-hashchange-plugin
    jQuery(window).hashchange();
	jQuery("div.holder").jPages({
        containerID  : "gallery_wrapper",
        perPage      : 9,
        startPage    : 1,
        startRange   : 1,
		previous: "« Previous",
        next: "Next »",
        midRange     : 5,
        endRange     : 1
    });
	jQuery("div.holder1").jPages({
        containerID  : "testimonial_wrapper",
        perPage      : 10,
        startPage    : 1,
        startRange   : 1,
		previous: "« Previous",
        next: "Next »",
        midRange     : 5,
        endRange     : 1
    });
	jQuery("#sitename").attr("value","<?php echo $siteurl; ?>");
	jQuery("#sitename1").attr("value","<?php echo $siteurl; ?>");
	jQuery("#sitename2").attr("value","<?php echo $siteurl; ?>");
	jQuery("#sitename3").attr("value","<?php echo $siteurl; ?>");
	jQuery(".nav-menu").append("<li class='investors menu-item menu-item-type-post_type menu-item-object-page' id='menu-item-accredit'><a href='<?php bloginfo('url'); ?>/accredited-investors/'>Accredited Investors</a></li>");
	jQuery("#mframe1").contents().find("#sitename").attr("value","<?php echo $siteurl; ?>");
});
</script>
<?php
/* global $blog_id;
if($blog_id == '1'){
}
else{
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	var ids = jQuery(".wpcf7").attr("id");
	jQuery(".wpcf7-form").attr("action","<?php echo network_site_url(); ?>#"+ids);
});	
</script>
<?php
} */
?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<section id="logo">
            	<a href="<?php bloginfo('url'); ?>">
                	<img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="Socotra Capital Logo" />
                </a>
            </section>
            <section id="header-widgets">
            	<div class="header-phone">
	                <div class="phone-text">Call Today to Discuss Your Hard Money Loan Needs</div>
					<?php
				   $mykey_values1 = get_post_custom_values('phone_num');
				   if($mykey_values1 != '') {
			 	   foreach ( $mykey_values1 as $key => $value1 ) {
				   ?>
                   <div class="phone-number"><?php echo $value1; ?></div>
				   <?php
                   }  /* foreach  mykey_values1 */
				   }
				   else{  /* if  mykey_values1 */
					dynamic_sidebar('header-phone-sidebar');
				   }
				   ?>
                </div>
                <div class="header-tagline">
                <?php
				   $mykey_values1 = get_post_custom_values('tagline');
				   if($mykey_values1 != '') {
			 	   foreach ( $mykey_values1 as $key => $value1 ) {
				   ?>
                   <?php echo $value1; ?>
				   <?php
                   }  /* foreach  mykey_values1 */
				   }
				   else{  /* if  mykey_values1 */
					dynamic_sidebar('header-tagline');
				   }
				   ?>
                </div>
                <div class="clear"></div>
            </section>
            <div class="clear"></div>
		</hgroup>
	</header><!-- #masthead -->
    <div id="banner-area">
    	<div class="banner-inner">
    		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			</nav><!-- #site-navigation -->
            <div id="mbanner">
            <div class="mbannerlft">
                <div id="header-image"> 
                    <div class="slidertxt">
                     <?php dynamic_sidebar('banner-area-tagline'); ?>
                        <div class="slidercontent">To real estate investors and corporations on Residential and Commercial Properties.  Socotra Capital is a direct California Hard Money Lender with local and community roots.  Contact us Today!</div>
                            </div><!-- .slidertxt -->
                    <div class="sliderimg">
                           <ul class="bxslider">
                          <li><img src="<?php bloginfo('template_directory'); ?>/images/banner01.jpg" /></li>
                          <li><img src="<?php bloginfo('template_directory'); ?>/images/banner02.jpg" /></li>
                          <li><img src="<?php bloginfo('template_directory'); ?>/images/banner03.jpg" /></li>
                          <li><img src="<?php bloginfo('template_directory'); ?>/images/banner04.jpg" /></li>
                        </ul> 
                    </div><!-- .sliderimg -->
                    <div class="clear"></div>
                </div><!-- #header-image -->
            </div><!-- .mbannerlft -->
            <div class="mbannerrit" id="mbannerrit">
			<?php #dynamic_sidebar('banner-contact'); 
			global $blog_id;
            if($blog_id == '1'){
            dynamic_sidebar('banner-contact'); 
			}
			else{
			global $switched;
            switch_to_blog(1);
			echo do_shortcode('[contact-form-7 id="57" title="Contact Us Form"]');
			restore_current_blog();
			} 
			?>
            </div>
            </div>
            </div>
            <div class="clear"></div>
            </div>
            <div class="clear"></div>
       </div>
    <div class="clear"></div>
    </div>
    <?php global $switched;switch_to_blog(1);?>
	<input type="hidden" id="parnet_base_url" value="<?php echo bloginfo('url');?>"/>
	<?php restore_current_blog();?>
	<div id="main" class="wrapper">