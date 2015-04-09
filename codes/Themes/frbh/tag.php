<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
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
		<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'twentythirteen' ), single_tag_title( '', false ) ); ?></h1>

				<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->
	
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