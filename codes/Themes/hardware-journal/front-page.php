<?php get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="entry-page-image">
						<?php the_post_thumbnail(); ?>
					</div><!-- .entry-page-image -->
				<?php endif; ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<div class="clrs"></div>
<!-- Home CTA -->
<div class="home-cta">
<?php dynamic_sidebar('home-cta'); ?>
</div>
<!-- Home CTA -->
<div class="clrs"></div>
<!-- Current Issue Section -->
<div class="current-issue">
<?php dynamic_sidebar('current-issue'); ?>
</div>
<!-- Current Issue Section -->
<div class="clrs"></div>
<!-- Whats New Issue Section -->
<div class="whatsnew-section">
<div class="whatsnew">
<?php dynamic_sidebar('whatsnew'); ?>
</div>
<div class="facebook-box">
<?php dynamic_sidebar('facebook-box'); ?>
</div>
<div class="clrs"></div>
</div>
<!-- Whats New Issue Section -->
<div class="clrs"></div>
<!-- Latest Products Section -->
<div class="latest-products">
<?php dynamic_sidebar('latest-products-video'); ?>
</div>
<!-- Latest Products Section -->
<div class="clrs"></div>
<?php get_footer(); ?>