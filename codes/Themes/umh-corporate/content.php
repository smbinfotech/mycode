<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  	<?php if(has_post_thumbnail()){ ?>
    <div class="entry-content-cnt">
      	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
	</div>
	<?php
	} else{
	?>	
    <div class="entry-content-cnt">
    	<a href="<?php the_permalink(); ?>">
        	<img src="<?php bloginfo('template_url'); ?>/images/default.jpg" />
        </a>
        </div>
	<?php	}
	?>
    
    <div class="entry-desc">
		<header class="entry-header">
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
		</header><!-- .entry-header -->
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
        </div>
	</article><!-- #post -->
