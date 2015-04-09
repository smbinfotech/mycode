<?php

/**

 * The template for displaying Archive pages

 *

 * Used to display archive-type pages if nothing more specific matches a query.

 * For example, puts together date-based pages if no date.php file exists.

 *

 * If you'd like to further customize these archive views, you may create a

 * new template file for each specific one. For example, Twenty Twelve already

 * has tag.php for Tag archives, category.php for Category archives, and

 * author.php for Author archives.

 *

 * @link http://codex.wordpress.org/Template_Hierarchy

 *

 * @package WordPress

 * @subpackage Twenty_Twelve

 * @since Twenty Twelve 1.0

 */



get_header(); ?>



	<div id="blog" class="site-content">

	<div class="cont-wrapper">
        <div class="home-page-comm">

            	<div class="community-sidebar">

					<div class="comm-sidebar">                

					<?php dynamic_sidebar('sidebar-blog'); ?>

                    <div class="clrs"></div>

                    </div>

                    <div class="clrs"></div>

                </div>

                <div class="clrs"></div>

            </div>

		<div id="content" class="cont-inner" role="main">



		<?php if ( have_posts() ) : ?>

			<header class="archive-header">

				<h1 class="archive-title"><?php

					if ( is_day() ) :

						printf( __( 'Daily Archives: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );

					elseif ( is_month() ) :

						printf( __( 'Monthly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );

					elseif ( is_year() ) :

						printf( __( 'Yearly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );

					else :

						_e( 'Archives', 'twentytwelve' );

					endif;

				?></h1>

			</header><!-- .archive-header -->

		 <div id="list">

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
            <div class="clrs"></div>
            </div>
      		<nav id="nav-below" class="navigation" role="navigation">
            <?php my_pagination(); ?>
			<!-- <div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div> -->
			</nav>
		<?php endif; ?>

		</div><!-- #content -->

        <div class="clrs"></div>

        </div><!-- #home-page-cont -->

        <div class="clrs"></div>

        </div><!-- .cont-wrapper -->

        <div class="clrs"></div>

	</div><!-- #primary -->



<?php #get_sidebar(); ?>

<?php get_footer(); ?>