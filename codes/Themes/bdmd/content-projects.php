<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
   $mykey_values = get_post_custom_values('slideshow_images');
   if($mykey_values != '') {
?>
<div class="view-proj-images">
<a href="#foohiddengallery" class="footrigger">View Project Images</a>
<div id="foohiddengallery" style="display: none;">
<?php	   
  foreach ( $mykey_values as $key => $value ) {
   ?>
<a rel="foobox" title="<?php the_title(); ?>" href="<?php bloginfo('url'); ?>/<?php echo $value; ?>" class="foobox">
<img alt="<?php the_title(); ?>" src="<?php bloginfo('url'); ?>/<?php echo $value; ?>" />
</a>
<?php 
}
?>
</div>
</div>
<?php 
} 
?>
<div class="archive-header">
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
	</div><!-- .entry-content -->
 </div>
 
 <div class="wrap-div">
    
<!-- Related People Section on Project Page Start -->
<div class="col_2">

    <ul id="jpages1" class="box markets clear">
    <p class="heading-center"><span>Related People</span></p>
		<?php 
       	$term_list = get_the_terms( $post->ID, 'people' );
		sort($term_list);
	   	if ( ! empty( $term_list ) && ! is_wp_error( $term_list ) ){
        foreach ( $term_list as $term ) {
		//echo $term->term_id.'<br>';
        $metaValue = get_terms_meta($term->term_id, 'people_image'); ?>
        <li>
        <a class="box1" href="<?php echo get_term_link( $term ) ?>">
        <img src="<?php echo $metaValue[0]; ?>" alt="<?php echo $term->name; ?>" title="<?php echo $term->name; ?>">
        <strong class="caption"><?php echo $term->name; ?></strong>
        </a>
        </li>
        <?php
        } 
        }
        ?>	 
        </ul>
        <!--<div class="holder1"></div>-->
        </div>
<!-- Related People Section on Project Page End --> 
 
 
 <!-- Related Project Section on Project Page Start -->       
 <?php
 $mykey_values1 = get_post_custom_values('related_pro');
 if($mykey_values1 != '') { ?>
                
       <div class="col_2"> 
 
    <ul id="jpages2" class="box markets clear">
     <p class="heading-center"><span>Related Projects</span></p>
    <?php  foreach ( $mykey_values1 as $key => $provalue ) {
		$pids = $provalue;
		$postdata = get_post($pids); 
		$title = $postdata->post_title; ?>
        <li>
        <a href="<?php echo get_permalink( $pids ); ?>" class="box1">
        <?php
           $mykey_values = get_post_custom_values('thumb_img',$pids);
           if($mykey_values != '') {
          foreach ( $mykey_values as $key => $value ) {
           ?>
        <img title="<?php echo $postdata->post_title; ?>" alt="<?php echo $postdata->post_title; ?>" src="<?php bloginfo('url'); ?>/<?php echo $value; ?>" />   
        <?php 
        }
        }
        else{ 
        if(has_post_thumbnail($pids)){
        $thumbnail=wp_get_attachment_image_src(get_post_thumbnail_id($pids->ID),"thumbs");
        ?>
        <img title="<?php echo $postdata->post_title; ?>" alt="<?php echo $postdata->post_title; ?>" src="<?php echo $thumbnail[0];?>" />
        <?php }
        }
        ?>
        <strong class="caption"><?php echo $postdata->post_title; ?></strong>
        </a>
        </li>
        <?php } ?>
        </ul> 
        <!--<div class="holder2"></div>-->
        </div>
  <?php } ?> 
  
  </div>
  
   <!-- Related Project Section on Project Page End --> 
  
 </article><!-- #post -->
