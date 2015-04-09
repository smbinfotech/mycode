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
<div class="blogpage">
<?php 
if(has_post_thumbnail()){
         $thumbnail=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"full"); 
   }   
             ?>
          <p class="thumb-img"><img title="<?php the_title(); ?>" alt="<?php the_title(); ?>" src="<?php echo $thumbnail[0];?>" /></p>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
    <?php 
	if(!is_category()){
	$category = get_the_category(); 
	if($category[0]){
	echo '<a href="'.get_category_link($category[0]->term_id ).'" class="cat-items">'.$category[0]->cat_name.'</a>';
	}
	}
	?>
		<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h1>' ); ?>
		<div class="entry-meta">
	    <span class="date"><a href="<?php the_permalink(); ?>"><?php the_time('F d, Y'); ?></a></span>
        <span class="author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></span>
		<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?></span>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
    <?php if(is_single()){
		the_content();
	}else{
	the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>" class="readmores">Read More</a>
		<?php } ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
    <?php echo get_the_tag_list( $before, $after ); ?>
	</footer><!-- .entry-meta -->

</article><!-- #post -->
</div>
