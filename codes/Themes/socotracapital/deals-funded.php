<?php
/**
Template Name: Deals Funded Template
*/

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php
			global $switched;
			switch_to_blog(1); ?>
	    <div class="holder"></div>
			<?php
	      if(get_query_var( 'page')){
			$paged=get_query_var('page');
		}
		else{
		$paged=get_query_var('paged');
		}
       $args = array('post_type' => 'deals_funded',order=> DESC,posts_per_page =>-1,paged=>$paged); ?>
       <?php query_posts($args); ?>
       
       <div class="gallery_wrapper" id="gallery_wrapper">
       <?php if(have_posts()) : ?>
	   <?php while(have_posts()) : the_post(); ?>
       		<div class="gallery_box">
            	<div class="gallery_img">
                <?php //Featured Image Code
				   if(has_post_thumbnail()){
                       $thumbnail=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"full");
                        ?>
                       <?php add_thickbox(); ?>
                       <a class="thickbox" href="<?php echo $thumbnail[0];?>" title="<?php the_title();?>">
                        <img src="<?php echo $thumbnail[0];?>" alt="<?php the_title();?>" />
                        </a>
                 <?php
	                 }    
				?>
                </div>
            	<div class="gallery_title">
                <a class="thickbox" href="#TB_inline?width=500&height=300&inlineId=gallery_main" title="<?php the_title();?>">	
					<?php the_title(); ?>
                </a>
                </div>
                <div class="gallery_text">
                	<?php echo my_limit_words(get_the_content(),1); ?>
                </div>
                    <div style="display: none;" id="gallery_main">
                            <div class="gallery_mains">
                                    <div class="gallery_img">
                                    <?php //Featured Image Code
                                       if(has_post_thumbnail()){
                                           $thumbnail=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"full");
                                            ?>
                                            <img src="<?php echo $thumbnail[0];?>" alt="<?php the_title();?>" />
                                     <?php
                                         }    
                                    ?>
                                    </div>
                                                    <div class="gallery_items">
                                                                            <div class="gallery_title">
                                                                                <?php the_title(); ?>
                                                                            </div>
                                                                            <div class="gallery_text">
                                                                                <?php the_content(); ?>
                                                                            </div>
                                                    <div class="clear"></div>
                                                    </div>
                            </div>
                    </div>
            </div>
          <?php endwhile; ?>
              <?php endif; ?>	
                 <?php wp_reset_query();?>
                 <div class="clear"></div>
                 </div>
		<?php restore_current_blog();?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>