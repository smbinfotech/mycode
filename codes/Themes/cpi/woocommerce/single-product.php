<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

 <div class="sr-mid-container product-page">
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
    	<div id="primary" class="site-content">
        	<div id="content" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>
<?php 
global $post;
$terms = get_the_terms( $post->ID, 'product_cat' );
foreach ($terms as $term) {
$term_link = get_term_link( $term, 'product_cat' );
echo "<a class='homereadmore applinks' href='".$term_link."'>Go To " . $term->name . "</a>";
}
?>
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		#do_action( 'woocommerce_sidebar' );
		
	?>
    <div id="secondary" class="widget-area" role="complementary">
        	<?php dynamic_sidebar('product-sidebar-1');	?>
            <?php #dynamic_sidebar('related-products-sidebar');	?>
		</div><!-- #secondary .widget-area -->
<div class="clr"></div>

</div>
<div class="clr"></div>
<!-- .blue-section-product -->
<div class="blue-section-product">
<!-- .blue-section -->
<div class="blue-section">
<div class="sr-mid-container">
<!-- #product_tab -->
<div class="pro-tabs">
<div id="product_tab"> 
<ul class="resp-tabs-list">
	<?php if(get_post_meta( get_the_ID(), 'product_dimensions', true )){ ?> 
    <li>Product Dimensions</li> 
    <?php } ?>
    
   	<?php if(get_post_meta( get_the_ID(), 'wire_diagram', true )){ ?> 
    <li>Wire Diagram</li> 
    <?php } ?>
   
    <?php if(get_post_meta( get_the_ID(), 'product_specifications', true )){ ?> 
    <li>Product Specifications</li> 
    <?php } ?>
    
    <?php if(get_post_meta( get_the_ID(), 'specifications', true )){ ?> 
    <li>Specifications</li> 
    <?php } ?>
    
    <?php if(get_post_meta( get_the_ID(), 'product_drawings', true )){ ?> 
    <li>Product Drawings</li> 
    <?php } ?>
    
    <?php if(get_post_meta( get_the_ID(), 'data_sheet', true )){ ?> 
    <li>Data Sheet</li> 
    <?php } ?>

    <?php if(get_post_meta( get_the_ID(), 'product_measurements', true )){ ?> 
    <li>Product Measurements</li> 
    <?php } ?>    
    
    <?php if(get_post_meta( get_the_ID(), 'signal_conditioners', true )){ ?> 
    <li>Signal Conditioners</li> 
    <?php } ?>
    
    <?php if(get_post_meta( get_the_ID(), 'create_part_number', true )){ ?> 
    <li>Create Part Number</li> 
    <?php } ?>
    
    <?php if(get_post_meta( get_the_ID(), 'mounting_option', true )){ ?> 
    <li>Mounting Option</li> 
    <?php } ?>

    <?php if(get_post_meta( get_the_ID(), 'endurance_ratings', true )){ ?> 
    <li>Endurance Ratings</li> 
    <?php } ?>  
    
    <?php if(get_post_meta( get_the_ID(), 'certifications', true )){ ?> 
    <li>Certifications</li> 
    <?php } ?>  
    
    <?php if(get_post_meta( get_the_ID(), 'video', true )){ ?> 
    <li>Video</li> 
    <?php } ?>
        
</ul> 
<!-- .resp-tabs-container -->
<div class="resp-tabs-container"> 
		<?php if(get_post_meta( get_the_ID(), 'product_dimensions', true )){ ?> 
        <div><?php echo get_post_meta( get_the_ID(), 'product_dimensions', true ); ?></div>
        <?php } ?>
        
        <?php if(get_post_meta( get_the_ID(), 'wire_diagram', true )){ ?> 
        <div><?php echo get_post_meta( get_the_ID(), 'wire_diagram', true ); ?></div>
        <?php } ?>
        
        <?php if(get_post_meta( get_the_ID(), 'product_specifications', true )){ ?> 
        <div><?php echo get_post_meta( get_the_ID(), 'product_specifications', true ); ?></div>
        <?php } ?>
        
        <?php if(get_post_meta( get_the_ID(), 'specifications', true )){ ?> 
        <div><?php echo get_post_meta( get_the_ID(), 'specifications', true ); ?></div>
        <?php } ?>
        
        <?php if(get_post_meta( get_the_ID(), 'product_drawings', true )){ ?> 
        <div><?php echo get_post_meta( get_the_ID(), 'product_drawings', true ); ?></div>
        <?php } ?>

        <?php if(get_post_meta( get_the_ID(), 'data_sheet', true )){ ?> 
        <div><?php echo get_post_meta( get_the_ID(), 'data_sheet', true ); ?></div>
        <?php } ?>        
        
        <?php if(get_post_meta( get_the_ID(), 'product_measurements', true )){ ?> 
        <div><?php echo get_post_meta( get_the_ID(), 'product_measurements', true ); ?></div>
        <?php } ?>           
        
        <?php if(get_post_meta( get_the_ID(), 'signal_conditioners', true )){ ?> 
        <div><?php echo get_post_meta( get_the_ID(), 'signal_conditioners', true ); ?></div>
        <?php } ?>
        
        <?php if(get_post_meta( get_the_ID(), 'create_part_number', true )){ ?> 
        <div><?php echo get_post_meta( get_the_ID(), 'create_part_number', true ); ?></div>
        <?php } ?>
        
        <?php if(get_post_meta( get_the_ID(), 'mounting_option', true )){ ?> 
        <div><?php echo get_post_meta( get_the_ID(), 'mounting_option', true ); ?></div>
        <?php } ?>

        <?php if(get_post_meta( get_the_ID(), 'endurance_ratings', true )){ ?> 
        <div><?php echo get_post_meta( get_the_ID(), 'endurance_ratings', true ); ?></div>
        <?php } ?>   

        <?php if(get_post_meta( get_the_ID(), 'certifications', true )){ ?> 
        <div><?php echo get_post_meta( get_the_ID(), 'certifications', true ); ?></div>
        <?php } ?>               
        
       	<?php if(get_post_meta( get_the_ID(), 'video', true )){ ?> 
        <div><?php echo get_post_meta( get_the_ID(), 'video', true ); ?></div>
        <?php } ?>

  </div>  <!-- .resp-tabs-container -->
  </div> <!-- #product_tab -->
  </div>
  <div class="blue-section-sidebar">
  	<?php dynamic_sidebar('blue-section-sidebar'); ?>
  </div>
  
 <div class="clr"></div>
</div>
  
</div>
<!-- .blue-section -->
<div class="clr"></div>
</div>
<!-- .blue-section-product -->


<div class="white-section-product">
<!-- .blue-section -->
<div class="white-section">
<div class="sr-mid-container">
    <div class="white_left">
    <h2>Applications</h2>  
    <ul>
    <?php 
    global $post;
    $terms = get_the_terms( $post->ID, 'application' );
    foreach ($terms as $term) {
    ?>
    <li>
    <?php
    $term_link = get_term_link( $term, 'application' );
    echo "<a class='applications_link' href='".$term_link."'>" . $term->name . "</a>";
    ?>
    </li>
    <?php
    }
    ?>
    </ul>
    </div>
    
<?php if(get_post_meta( get_the_ID(), 'related_links', true )){ ?>    
    <div class="white_right">
    <h2>Related Links</h2>  
    <?php echo get_post_meta( get_the_ID(), 'related_links', true ); ?>
    </div>
<?php } ?>
 <div class="clr"></div>
</div>
  
</div>
<!-- .blue-section -->
<div class="clr"></div>
</div>


<?php get_footer( 'shop' ); ?>
