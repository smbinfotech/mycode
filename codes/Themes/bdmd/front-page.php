<?php get_header(); ?>
	<div class="home-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                	<div class="archive-header">
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->
                    </div>
                    <?php   
					 $mykey_values = get_post_custom_values('featured_pro_heading');
   				if($mykey_values != '') {
	   foreach ( $mykey_values as $key => $value ) {
		   echo $value;
	   }
   }
   ?>
   <?php   
					 $mykey_values1 = get_post_custom_values('featured_pro_content');
   				if($mykey_values1 != '') {
	   foreach ( $mykey_values1 as $key => $value1 ) {
		   echo $value1;
	   }
   }
   ?>
				</article><!-- #post -->

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #site-conten -->

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>