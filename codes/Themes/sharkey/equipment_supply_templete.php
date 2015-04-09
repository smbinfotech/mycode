<?php
/*
Template Name: Equipment Supply Template
*/
get_header(); ?>

<div id="sr-content" class="inner">
  <?php if(function_exists('rdfa_breadcrumb')){ rdfa_breadcrumb(); } ?>
  
  <div class="sr-right-area">
    <?php
    $key = "tagline";
    $post_id = get_the_ID();
    $meta_values = get_post_meta( $post_id, $key, $single );
    echo $meta_values;
    while ( have_posts() ) : the_post(); ?>
    <?php    
    get_template_part( 'content', 'page' ); ?>
    <?php endwhile; // end of the loop. ?>
    <aside id="box">
      <ul>
        <?php 
        $terms = get_terms( 'equipment-type', 'orderby=name&hide_empty=0' );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {
        $metaValue = get_terms_meta($term->term_id, 'equipment_type_image');       
        ?>
        <li> <a class="box1" href="<?php echo get_term_link( $term ) ?>"> <img src="<?php echo $metaValue[0]; ?>" alt="<?php echo $term->name; ?>" title="<?php echo $term->name; ?>"> <strong class="caption"><?php echo $term->name; ?></strong> </a> </li>
        <?php
        } 
       }
    ?>
      </ul>
    </aside>
    <?php get_template_part( 'loop', 'page' );?>
  </div>
  
  <div class="sr-left-area">
    <?php get_sidebar(); ?>
  </div>
  <div class="clr"></div>
</div>
<?php get_footer(); ?>
