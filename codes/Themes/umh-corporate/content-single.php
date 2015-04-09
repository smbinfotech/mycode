	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->
		<div class="entry-meta">
            <span class="date"><strong>Posted on</strong> <?php the_time('l, F jS, Y') ?> </span>
            <span class="author"> <strong><?php _e('By'); ?></strong> <a class="url" href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) ); ?>" title="<?php echo get_the_author(); ?>" rel="me"><?php echo get_the_author(); ?></a> </span>
            <span class="category"><strong>Posted in</strong> <?php the_category(','); ?> </span>
        </div>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	</article><!-- #post -->
