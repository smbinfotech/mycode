<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
        <h2 class="category-title">Top 3 Topics</h2>
        <div class="top-cat">
        <div id="masonry-wrapper">
		<?php query_posts('cat=4&posts_per_page=3'); ?>
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php if ( has_post_thumbnail()) :  ?>
                    <div class="entry-thumbnail">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <?php endif; ?>
            
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h2>
                </header><!-- .entry-header -->

                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                    <div class="clrs"></div>
                </div><!-- .entry-summary -->
				<div class="clrs"></div>	
                <footer class="entry-meta">
                	<div class="footmeta">
                    <div class="postmeta">
                    <?php _e('Posted By'); ?> <a class="url" href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) ); ?>" title="<?php echo get_the_author(); ?>" rel="me"><?php echo get_the_author(); ?></a>.<br />
                  	 <?php the_time('m-d-Y') ?>.
           
                    </div>
                    <div class="postsocial">
                    	<?php if ( comments_open() && ! is_single() ) : ?>
                        <span class="comments-link">
                            <a href="<?php echo get_comments_link( $post->ID ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/comment_bubble.png" /></a>
                        </span><!-- .comments-link -->
                    	<?php endif; // comments_open() ?>
                        <span st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>' class='st_sharethis'></span>
                        <?php if(function_exists('like_counter_p')) { like_counter_p(''); } ?>
                    </div>
                    <div class="clrs"></div>
                    </div>
                	<div class="clrs"></div>
                </footer><!-- .entry-meta -->
</article><!-- #post -->

			<?php endwhile; ?>
		<?php endif;
		 wp_reset_query(); ?>
	    <br class="clrs">
		</div><!--#masonry-wrapper-->
        
        </div>
        <h2 class="category-title">Recent Blogs</h2>
        <div id="masonry-wrapper1">
		<?php if ( have_posts() ) : ?>
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php if ( has_post_thumbnail()) :  ?>
                    <div class="entry-thumbnail">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <?php endif; ?>
            
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h2>
                </header><!-- .entry-header -->

                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                    <div class="clrs"></div>
                </div><!-- .entry-summary -->
				<div class="clrs"></div>	
                <footer class="entry-meta">
                <div class="footmeta">
                    <div class="postmeta">
                    <?php _e('Posted By'); ?> <a class="url" href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) ); ?>" title="<?php echo get_the_author(); ?>" rel="me"><?php echo get_the_author(); ?></a>.<br />
                  	 <?php the_time('m-d-Y') ?>.
           
                    </div>
                    <div class="postsocial">
                    	<?php if ( comments_open() && ! is_single() ) : ?>
                        <span class="comments-link">
                            <a href="<?php echo get_comments_link( $post->ID ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/comment_bubble.png" /></a>
                        </span><!-- .comments-link -->
                    	<?php endif; // comments_open() ?>
                        <span st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>' class='st_sharethis'></span>
                        <?php if(function_exists('like_counter_p')) { like_counter_p(''); } ?>
                        </div>
                	<div class="clrs"></div>
                    </div>
                	<div class="clrs"></div>
                </footer><!-- .entry-meta -->
            </article><!-- #post -->

			<?php endwhile; ?>
		<?php endif; ?>
	    <br class="clrs">
		</div><!--#masonry-wrapper-->
        <div class="nav-btm-wrap">
         <nav id="nav-below" class="navigation" role="navigation">
          <?php my_pagination(); ?>
		</nav>
        <div class="btm-social">
	        <?php dynamic_sidebar('sidebar-bottom-social'); ?>
        </div>
        <div class="clrs"></div>
        </div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>