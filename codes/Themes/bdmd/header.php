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
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]--><head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
<?php wp_head(); ?>
<!--<script src="<?php bloginfo('template_url'); ?>/js/jPages.js"></script>-->
<?php if(is_singular()){
?>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery(".prev-next-menu a").each(function() {
jQuery(this).addClass("borders1");
});
var i = 0;
jQuery(".borders1").attr('class', function() {
i++;
return 'borders1 border'+i;
});
});
</script>
<?php
} ?>
<!--<script src="<?php echo get_template_directory_uri(); ?>/js/empty-search.js"></script>-->
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery('.footrigger').click(function(e) {
e.preventDefault();
var hiddenAreaId = jQuery(this).attr('href');
jQuery(hiddenAreaId).find('a:first').click();
});
var aas = jQuery('.prev-next-menu').children().length;
if(aas === 3 ){
jQuery(".border1").addClass("border");
}
var i = 0;
jQuery(".sep").attr('class', function() {
i++;
return 'sep seps'+i;
});
if(jQuery(".seps2").next().hasClass("sep")){
jQuery(".seps3").css("display","none");
}
if(jQuery(".seps1").next().hasClass("sep")){
jQuery(".seps2").css("display","none");
}
//jQuery(".search-form").preventEmptySubmit({ msg: "Search Parameter must be filled out" });
/* jQuery("div.holder").jPages({
        containerID  : "jpages",
        perPage      : 4,
        startPage    : 1,
        startRange   : 1,
		previous: "« Previous",
        next: "Next »",
        midRange     : 2,
        endRange     : 1
});
jQuery("div.holder1").jPages({
        containerID  : "jpages1",
        perPage      : 2,
        startPage    : 1,
        startRange   : 1,
		previous: "« Previous",
        next: "Next »",
        midRange     : 4,
        endRange     : 1
});
jQuery("div.holder2").jPages({
        containerID  : "jpages2",
        perPage      : 2,
        startPage    : 1,
        startRange   : 1,
		previous: "« Previous",
        next: "Next »",
        midRange     : 4,
        endRange     : 1
});
var lis = jQuery('#jpages').children().length;
if(lis < 4 ){
jQuery(".holder").css("display","none");
}
var lis1 = jQuery('#jpages1').children().length;
if(lis1 <= 2 ){
jQuery(".holder1").css("display","none");
}
var lis2 = jQuery('#jpages2').children().length;
if(lis2 <= 2 ){
jQuery(".holder2").css("display","none");
}*/
});
</script>
<link type="text/css" href="<?php bloginfo('template_directory'); ?>/css/responsive.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:900' rel='stylesheet' type='text/css'>
</head>

<body <?php body_class(); ?>>
<div class="search-box-mobview site-header"><?php get_search_form(); ?></div>
	<div id="page" class="hfeed site max-width">
		<header id="masthead" class="site-header clear" role="banner">

	<div class="hdr-inner">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'top', 'menu_class' => 'nav-menu' ) ); ?>
					
				</nav><!-- #site-navigation -->
                <?php get_search_form(); ?>
                
			<!-- #navbar -->
            </div>
             <p class="quick-nav">
        	<span class="back"><a href="javascript:history.go(-1)" onMouseOver="self.status=document.referrer;return true"><img src="<?php bloginfo('template_directory'); ?>/images/back.png"></a></span>
            <span class="bake-to-home"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('template_directory'); ?>/images/homeicon.png"></a></span>
       		 </p>
		   <?php //Featured Image Code
		  if(is_singular('projects')){
			?>
              <div class="grey-bar clear"> 
			<?php breadcrumb_trail();
             ?>
             <div class="prev-next-menu">
             <?php 
			 $term = $wp_query->queried_object;
			 $ts = get_the_terms($term->ID, 'market-type' );
			 if($ts){
			 $i=0;
			 foreach($ts as $tss){
			 $args=array(
			  'category_name' => $tss->name,
			  'post_type' => 'projects',
			  'orderby' => 'date',
			  'order'=> 'ASC',
			  'posts_per_page' => -1
			);
			$new = new WP_Query($args);
			while ($new->have_posts()) : $new->the_post();
			endwhile;
			next_post_link( '%link', '<span>&laquo;</span> Previous Project', true, '', $taxonomy = 'market-type' );
			previous_post_link( '%link','Next Project <span>&raquo;</span>',true, '', $taxonomy = 'market-type' );
			wp_reset_postdata(); 
			$i++;
			if($i==1) break;
			}	
			}
				?>
             <div class="clrs"></div>
            </div>
             </div>
             <?php
			} 
			elseif(is_page_template('next-prev.php')){
			?>
			<div class="grey-bar clear"> 
			<?php breadcrumb_trail();
             ?>
             <div class="prev-next-menu">
				<?php
                $pagelist = get_pages("child_of=".$post->post_parent."&parent=".$post->post_parent."&sort_column=post_date&sort_order=asc");
                $pages = array();
                foreach ($pagelist as $page) {
                   $pages[] += $page->ID;
                }
                
                $current = array_search($post->ID, $pages);
                $prevID = $pages[$current-1];
                $nextID = $pages[$current+1];
                ?>
                <?php if (!empty($prevID)) { ?>
                <a href="<?php echo get_permalink($prevID); ?>" title="<?php echo get_the_title($prevID); ?>"><span>&#171;</span>Previous Page</a>
                <?php }
                if (!empty($nextID)) { ?>
                <a href="<?php echo get_permalink($nextID); ?>" title="<?php echo get_the_title($nextID); ?>">Next Page<span>&#187;</span></a>
                <?php } ?>
                <div class="clrs"></div>
            </div>
             </div>            
            <?php
			}
			?>
            
            <?php
          if(is_tax()){ ?>
            <div class="grey-bar clear">
            <?php  
			if(is_tax('people')){
			breadcrumb_trail();
			?>
            <div class="prev-next-menu">
            <?php				
			$term =	$wp_query->queried_object;
			$previous_person = get_adjacent_category($term->slug,'people',"previous");
			if($previous_person){
			?>
            <a class="border1" href="<?php echo get_term_link($previous_person); ?>" title="<?php echo $previous_person->name;?>">
            <span>&#171;</span>Previous person
            </a>
            <?php }
			$next_person = get_adjacent_category($term->slug,'people',"next");
			if($next_person){
			?>
            <a href="<?php echo get_term_link($next_person); ?>" title="<?php echo $next_person->name;?>">
            Next person <span>&#187;</span>
            </a>
            <?php }	?>
            <div class="clrs"></div>
            </div>
            <?php }
			elseif(is_tax('market-type')){
			breadcrumb_trail();	
			?>
            <div class="prev-next-menu">
            <?php				
			$term =	$wp_query->queried_object;
			$previous_market = get_adjacent_category($term->slug,'market-type',"previous");
			if($previous_market){
			?>
            <a class="border1" href="<?php echo get_term_link($previous_market); ?>" title="<?php echo $previous_market->name;?>">
            <span>&#171;</span>Previous Market Type
            </a>
            <?php }
			$next_market = get_adjacent_category($term->slug,'market-type',"next");
			if($next_market){
			?>
            <a href="<?php echo get_term_link($next_market); ?>" title="<?php echo $next_market->name;?>">
            Next Market Type <span>&#187;</span>
            </a>
            <?php }	?>
            <div class="clrs"></div>
            </div>
           
            <?php	
			} ?>
             </div>

             
             <?php
		  }
          ?>
           <div class="banner max-width clear">
          <div id="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('template_directory'); ?>/images/banner-logo.gif"></a></div>
          
          <?php
          if(!is_tax()){
			if(is_home()){
				?>
			<img src="<?php bloginfo('template_url'); ?>/images/blog-banner.jpg" alt="<?php the_title();?>" />	
			<?php }
			elseif(is_search()){
			?>
            <img src="<?php bloginfo('template_url'); ?>/images/search-banner.jpg" alt="Search BDMD" />
            <?php	
			}elseif(!is_singular('projects') && !is_page()){ ?>
			<img src="<?php bloginfo('template_url'); ?>/images/blog-banner.jpg" alt="<?php the_title();?>" />		
			<?php } else{
			 if(has_post_thumbnail()){
         $thumbnail=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"full");	
			}	  
             ?>
          <img title="<?php the_title(); ?>" alt="<?php the_title(); ?>" src="<?php echo $thumbnail[0];?>" />
          <?php }
		  	}else{
			 ?>
            <?php if (function_exists('z_taxonomy_image_url')){	?>
		  <img src="<?php echo z_taxonomy_image_url(); ?>" alt="<?php the_title();?>" />
		  <?php
          }
			 ?>
             
             <?php
		  }
          ?>
		   </div>
		</header><!-- #masthead -->

		<div id="main" class="site-main">
