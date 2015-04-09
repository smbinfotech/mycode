<?php
/**
 * Template used to display Tag Archive pages
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<div class="sr-mid-container">
<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>
		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<div class="page-header">
					<h1 class="page-title"><?php
						printf( __( 'Tag Archives: %s', 'twentyeleven' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					?></h1>

					<?php
						$tag_description = tag_description();
						if ( ! empty( $tag_description ) ) {
							/**
							 * Filter the default Twenty Eleven tag description.
							 *
							 * @since Twenty Eleven 1.0
							 *
							 * @param string The default tag description.
							 */
							echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
						}
					?>
				</div>
	<?php while ( have_posts() ) : the_post(); ?>
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
          <p><?php echo my_limit_words(get_the_content(),75); ?></p>
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
		</section><!-- #primary -->

<?php get_sidebar('blog'); ?>
<div class="clr"></div>
</div>
<div class="clr"></div>
<?php get_footer(); ?>
