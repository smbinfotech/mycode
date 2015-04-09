<?php
/**
Template Name: Articles Template
*/

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
        <?php while ( have_posts() ) : the_post(); ?>
				<div class="entry-content">
                <h1><?php the_title(); ?></h1>
                </div>
				
			<?php endwhile; // end of the loop. ?>
			<?php
			$pages = get_pages('child_of='.$post->ID.'&sort_column=post_date&sort_order=desc');
			$count = 0;
			foreach($pages as $page)
			{
				$content = $page->post_content;
				if(!$content)
					continue;
				if($count >= 2)
					break;
				$count++;
				$content = apply_filters('the_content', $content);
				
			?>
				<div class="child-entry"><?php echo my_limit_words($content, 50); ?></div>
                <div class="readmore"><a href="<?php echo get_page_link( $page->ID ); ?>">Read More</a></div>
			<?php
			}
		?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>