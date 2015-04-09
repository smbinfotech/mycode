<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
        	<?php if (!is_front_page()) : ?>
			<?php the_post_thumbnail(); ?>
			<?php endif; ?>
			<!--<h1 class="entry-title"><?php the_title(); ?></h1>-->
			<?php the_content(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post -->
