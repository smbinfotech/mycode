<?php
/* Template Name: Client Access */ ?>
<?php
$users = wp_get_current_user();
if(is_user_logged_in()){
if(in_array( "author", (array) $users->roles )){
wp_redirect(site_url().'/wp-admin/users.php'); exit;
}else{
wp_redirect(site_url().'/case-summary/'); exit;
}
}
?>
<?php get_header();  ?>
<div id="content" class="client-access">
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
                <div class="clrs"></div>
			</div>
			<?php if($data['comments_pages']): ?>
				<?php wp_reset_query(); ?>
				<?php #comments_template(); ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
	<div id="sidebar" style="<?php echo $sidebar_css; ?>"><?php if(is_front_page()){ generated_dynamic_sidebar(); } else { dynamic_sidebar('avada-page-sidebar'); } ?></div>
<?php get_footer(); ?>