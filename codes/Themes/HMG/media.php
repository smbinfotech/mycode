<?php
/*

Template Name: Media Template

*/

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
                
			<?php endwhile; // end of the loop. ?>
            <div class="media_posts">
			<?php
			
			$the_query = new WP_Query('category_name=media&posts_per_page=10&orderby=date&order=DESC');
							// The Loop
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						?>
                        <div class="post_media">
                        <div class="posts_title">
                        	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>
                        <div class="posts_meta">
                        	Published <?php the_time('F d, Y');?> <span class="authors"><?php the_author(); ?></span>
                        </div>
                        <div class="posts_content entry-conent">
                        	<?php the_excerpt(); ?><a href="<?php the_permalink(); ?>">Read More</a>
                        </div>
                        </div>
                        <?php
					}
				} else {
					// no posts found
				}
				/* Restore original Post Data */
				wp_reset_postdata();
			 ?>
            </div>
            
		</div><!-- #content -->
	</div><!-- #primary -->

<div id="secondary" class="widget-area media-sidebar" role="complementary">
			<?php dynamic_sidebar( 'sidebar-media' ); ?>
		</div><!-- #secondary -->
<?php get_footer(); ?>