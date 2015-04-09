<?php
/**
 * Template for displaying Author Archive pages
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

				<?php
					/*
					 * Queue the first post, that way we know what author
					 * we're dealing with (if that is the case).
					 *
					 * We reset this later so we can run the loop properly
					 * with a call to rewind_posts().
					 */
					the_post();
				?>

				<div class="page-header">
					<h1 class="page-title author"><?php printf( __( 'Author Archives: %s', 'twentyeleven' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
				</div>

				<?php
					/*
					 * Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();
				?>

				<?php
				// If a user has filled out their description, show a bio on their entries.
				if ( get_the_author_meta( 'description' ) ) : ?>
				<div id="author-info">
					<div id="author-avatar">
						<?php
						/**
						 * Filter the Twenty Eleven author bio avatar size.
						 *
						 * @since Twenty Eleven 1.0
						 *
						 * @param int The height and width avatar dimension in pixels. Default 60.
						 */
						echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 60 ) );
						?>
					</div><!-- #author-avatar -->
					<div id="author-description">
						<h2><?php printf( __( 'About %s', 'twentyeleven' ), get_the_author() ); ?></h2>
						<?php the_author_meta( 'description' ); ?>
					</div><!-- #author-description	-->
				</div><!-- #author-info -->
				<?php endif; ?>

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