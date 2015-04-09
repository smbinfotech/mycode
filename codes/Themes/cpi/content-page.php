<?php
/**
 * Template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-content">
	<?php the_content(); ?>
  </div>
  <!-- .entry-content -->
</article>
<!-- #post-<?php the_ID(); ?> --> 
