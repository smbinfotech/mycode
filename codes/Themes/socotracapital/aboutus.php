<?php
/**
Template Name: About Us Template
*/

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php
                        global $switched;
                        switch_to_blog(1); //switched to 2 ?>
					<?php
					$page = get_page_by_title('About Us');
                    $the_query = new WP_Query('page_id='. $page->ID);
                    while ( $the_query->have_posts() ) :
                        $the_query->the_post(); ?>
                        	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-content">
						<?php the_content(); ?>
                        </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>

                    <?php restore_current_blog(); //switched back to main site ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>