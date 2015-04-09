<?php
/*

Template Name: Publications Template

*/

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
                <?php endwhile; // end of the loop. ?>
			
            <div class="media_posts">
			<?php
			   $the_query = new WP_Query('category_name=publications&posts_per_page=20&orderby=date&order=DESC');
				while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <div class="post_media">
                        <div class="publication_image">
                        <?php if(has_post_thumbnail()){
						 $thumbnail=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"full");
	                 	?>
					    <a href="<?php the_permalink(); ?>">
                        	<img src="<?php echo $thumbnail[0];?>" alt="<?php the_title();?>" />
                        </a>
			          <?php } ?>
                        </div>
                        <div class="publication_cont">
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
                        <div class="clear"></div>
                        </div>
                        <?php	endwhile;
						wp_reset_postdata();
						 ?>
            </div>
            
		</div><!-- #content -->
	</div><!-- #primary -->

<div id="secondary" class="widget-area media-sidebar" role="complementary">
			<?php dynamic_sidebar( 'sidebar-media' ); ?>
		</div><!-- #secondary -->
<?php get_footer(); ?>