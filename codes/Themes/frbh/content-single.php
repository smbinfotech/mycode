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
	<header class="entry-header">
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <div class="postmeta">
                    <?php _e('Posted By'); ?> <a class="url" href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) ); ?>" title="<?php echo get_the_author(); ?>" rel="me"><?php echo get_the_author(); ?></a>. <?php the_time('F-d-Y') ?>.
           
                    </div>
                    <div class="postsocial">
                        <span class="comments-link">
                            <a href="<?php echo get_comments_link( $post->ID ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/single-comment.png" /></a>
                        </span><!-- .comments-link -->
                        <span st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>' class='st_sharethis'></span>
                        <?php if(function_exists('like_counter_p')) { like_counter_p(''); } ?>
                    </div>
                	<div class="clrs"></div>
		<div class="post-banner"><div class="bxslider">
        
			<?php
                   $mykey_values = get_post_custom_values('slider_image');
                   if($mykey_values != '') {
                 ?>
                     <?php            
                  foreach ( $mykey_values as $key => $value ) {
                   ?>
                   <div class="image-wrap">
                 <img src="<?php bloginfo('url'); ?>/<?php echo $value; ?>" alt="" />
                 </a>
                </div> 
                   <?php 
                   } /* foreach  mykey_values2 */
                   }  /* if  mykey_values2 */
				   ?>
            </div></div>

		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
        <button class="read-blog"><a href="<?php bloginfo('url'); ?>">Read all Blogs</a></button>
	</div><!-- .entry-content -->


</article><!-- #post -->
