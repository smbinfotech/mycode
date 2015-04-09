<?php
/**
Template Name: Testimonials Template
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
			global $switched;
			switch_to_blog(1); ?>
		<?php
	      if(get_query_var( 'page')){
			$paged=get_query_var('page');
		}
		else{
		$paged=get_query_var('paged');
		}
       $args = array('post_type' => 'testimonials',order=> DESC,posts_per_page =>-1,paged=>$paged); ?>
       <?php query_posts($args); ?>
       
       <div class="testimonial_wrapper" id="testimonial_wrapper">
       <?php if(have_posts()) : ?>
	   <?php while(have_posts()) : the_post(); ?>
       		<div class="testimonials">
			<div class="testi_content">
            	<?php the_content(); ?>
            </div>
            <div class="testi_author">
            	<?php the_title(); ?>
            </div>
            </div>
          <?php endwhile; ?>
              <?php endif; ?>	
                 <?php wp_reset_query();?>
                  <div class="holder1"></div>
                 <div class="clear"></div>
                 </div>
		<?php restore_current_blog();?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>