<?php
/*

Template Name: Gallery Template

*/

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
                
			<?php endwhile; // end of the loop. ?>
            <div class="media_posts" id="gallery_wrapper">
			<?php
			
			$the_query = new WP_Query('category_name=gallery&posts_per_page=-1&orderby=date&order=DESC');
							// The Loop
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						?>
                        <div class="post_media gallery_media">
                        <div class="posts_title">
                        	<?php the_title(); ?>
                        </div>
                        <div class="posts_content entry-conent gallery_cont">
                        	<?php the_content(); ?>
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
            <div class="holder1"></div>
            
		</div><!-- #content -->
	</div><!-- #primary -->

<div id="secondary" class="widget-area media-sidebar" role="complementary">
			<?php dynamic_sidebar( 'sidebar-media' ); ?>
		</div><!-- #secondary -->
<?php get_footer(); ?>