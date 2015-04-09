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
<li>
<a href="<?php the_permalink(); ?>" class="box1">
<?php
   $mykey_values = get_post_custom_values('thumb_img');
   if($mykey_values != '') {
  foreach ( $mykey_values as $key => $value ) {
   ?>
<img title="<?php the_title(); ?>" alt="<?php the_title(); ?>" src="<?php bloginfo('url'); ?>/<?php echo $value; ?>" />   
<?php 
}
}
else{ 
if(has_post_thumbnail()){
$thumbnail=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"thumbs");
?>
<img title="<?php the_title(); ?>" alt="<?php the_title(); ?>" src="<?php echo $thumbnail[0];?>" />
<?php }else{
if (function_exists('z_taxonomy_image_url1')){
?>
<img title="<?php the_title(); ?>" alt="<?php the_title(); ?>" src="<?php echo z_taxonomy_image_url1(); ?>" alt="<?php the_title();?>" />
<?php
}
}
}
?>
<strong class="caption"><?php the_title(); ?></strong>
</a>
</li>
