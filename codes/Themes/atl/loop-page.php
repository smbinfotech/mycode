<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if ( is_front_page() ) { ?>
  <!--<h2 class="entry-title"><?php //the_title(); ?></h2>-->
  <?php } else { ?>
  <!--<h1 class="entry-title"><?php //the_title(); ?></h1>-->
  <?php } ?>
  <div class="entry-content"><?php if(function_exists('rdfa_breadcrumb')){ rdfa_breadcrumb(); } ?>
  <?php if(is_page(572)){ ?>
  <?php $content = get_the_content(); ?>
  <?php if($content){
    the_content();
  }
  else{
	 ?>
     <div class="empty_texts">
     <?php $mykey_values1 = get_post_custom_values('custom_text');
		   if($mykey_values1 != '') {
		  foreach ( $mykey_values1 as $key => $value1 ) {
		 echo $value1;
	   }  /* foreach  mykey_values1 */
	   }  /* if  mykey_values1 */
	   ?>
     </div>
     <?php
	 }
  }
  else{
	 the_content();
	 }?>
    
    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
    <?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
  </div>
  <!-- .entry-content --> 
</div>
<!-- #post-## -->

<?php //comments_template( '', true ); ?>
<?php endwhile; // end of the loop. ?>
