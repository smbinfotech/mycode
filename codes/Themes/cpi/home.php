<?php
/**
 * Main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>
<div class="sr-mid-container">
<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>
		<div id="primary">
			<div id="content" role="main">
			<?php if ( have_posts() ) :	// Start the Loop.
				while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
     
     <div class="entry-header">
     <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
          <div class="entry-meta">
            <?php
				if ( 'post' == get_post_type() )
					twentyeleven_posted_on();
					post_meta_datas();
					edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' );
			?>
          </div>
          <!-- .entry-meta --> 
        </div>
        <!-- .entry-header -->
        <?php twentyeleven_post_thumbnail(); ?>
        <div class="entry-summary">
          <p><?php echo my_limit_words(get_the_content(),50); ?></p>
          <a href="<?php the_permalink(); ?>" class="more-link">Read More...</a>
        </div>
        <div class="clr"></div>
        <!-- .entry-summary --> 
      </article>
      <!-- #post-## -->
      
      <?php

				endwhile;
				// Previous/next post navigation.
				twentyeleven_paging_nav();

			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif;
		?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar('blog'); ?>
<div class="clr"></div>
</div>
<div class="clr"></div>
<?php get_footer(); ?>