<?php
/*
Template Name: People Template
*/
get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>
            <div class="people-list">
	            <?php dynamic_sidebar('sidebar-people'); ?>
			</div>        
<!--           <ul class="box markets clear">
            <?php 
            $terms = get_terms( 'people', 'orderby=id&hide_empty=0' );
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
            $metaValue = get_terms_meta($term->term_id, 'people_image'); ?>
            <li>
            <a class="box1" href="<?php echo get_term_link( $term ) ?>">
            <img src="<?php echo $metaValue[0]; ?>" alt="<?php echo $term->name; ?>" title="<?php echo $term->name; ?>">
            <strong class="caption"><?php echo $term->name; ?></strong>
            </a>
            </li>
            <?php
            } 
            }
            ?>	 
            </ul>  -->   

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>