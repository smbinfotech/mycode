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
elseif(has_post_thumbnail()){
$thumbnail=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"thumbs");
?>
<img title="<?php the_title(); ?>" alt="<?php the_title(); ?>" src="<?php echo $thumbnail[0];?>" />
<?php }elseif (function_exists('z_taxonomy_image_url1')){
?>
<img title="<?php the_title(); ?>" alt="<?php the_title(); ?>" src="<?php echo z_taxonomy_image_url1(); ?>" alt="<?php the_title();?>" />
<?php
}
?>
<strong class="caption"><?php the_title(); ?></strong>
</a>
</li>
<?php /* ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
	<h1 class="tax-title">
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h1>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post -->
<?php */ ?>
