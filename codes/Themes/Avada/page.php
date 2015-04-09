<?php get_header(); ?>
	<?php
	if(get_post_meta($post->ID, 'pyre_full_width', true) == 'yes') {
		$content_css = 'width:100%';
		$sidebar_css = 'display:none';
	}
	elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'left') {
		$content_css = 'float:right;';
		$sidebar_css = 'float:left;';
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'right') {
		$content_css = 'float:left;';
		$sidebar_css = 'float:right;';
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'default') {
		if($data['default_sidebar_pos'] == 'Left') {
			$content_css = 'float:right;';
			$sidebar_css = 'float:left;';
		} elseif($data['default_sidebar_pos'] == 'Right') {
			$content_css = 'float:left;';
			$sidebar_css = 'float:right;';
		}
	}
	?>
	<div id="content" style="<?php echo $content_css; ?>">
    <?php if(is_front_page()){
	?>
    <div id="front-cta" class="front-cta">
    	<div class="front-ctas">
        	<?php dynamic_sidebar('front-cta'); ?>
            <div class="clrs"></div>
        </div>
    <div class="clrs"></div>
    </div>
    <div class="clrs"></div>
	<?php
	}
	?>
		<?php if(have_posts()): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php global $data; if(!$data['featured_images_pages'] && has_post_thumbnail()): ?>
			<div class="image">
				<?php the_post_thumbnail('blog-large'); ?>
			</div>
			<?php endif; ?>
			<div class="post-content">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
			<?php if($data['comments_pages']): ?>
				<?php wp_reset_query(); ?>
				<?php comments_template(); ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
	<div id="sidebar" style="<?php echo $sidebar_css; ?>">
		<div id="login-box" class="login-box">
			<?php 
			if (is_user_logged_in()){
			generated_dynamic_sidebar('avada-login');
			}
			?>
        </div>
	
	<?php if(is_front_page()){ 
	generated_dynamic_sidebar();
	 } else { 
	dynamic_sidebar('avada-page-sidebar');
	 } ?>
     
  	</div>
<?php get_footer(); ?>