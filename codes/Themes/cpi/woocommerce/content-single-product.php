<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<?php
global $post;
$terms = wp_get_post_terms( $post->ID, 'product_cat' );
foreach($terms as $term){
$categories[] = $term->slug;
}
if(in_array( 'waterproof-switches', $categories ) ) {
?>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery('.related-product-widgets .widget-title').text('Mounting Options');
});
</script>
<?php
}
?>
<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>



	<div class="summary entry-summary">

		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>
       <div class="image-bullet"> 
        <?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>
    <div class="bullet_list">
    <a href="#quoteform" target="foobox" data-height="800px" data-width="600px" class="inquire-btn quoteform fbx-link">
    <img src="<?php bloginfo('template_url'); ?>/images/request-a-quote.jpg" alt="Request a Quote" /></a>
	<a href="#sampleform" target="foobox" data-height="800px" data-width="600px" class="inquire-btn sampleform fbx-link">
    <img src="<?php bloginfo('template_url'); ?>/images/request-a-sample.jpg" alt="Request a Sample" /></a>
    <div class="clr"></div>
    <?php echo get_post_meta( get_the_ID(), 'bullet_text', true ); ?>
	</div>
    <div class="clr"></div>
	</div><!-- .summary -->
	<div class="clr"></div>
    </div>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
