<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<h3 class="line">Our Services</h3>
<section id="sr-cta">
  <?php dynamic_sidebar( 'cta' ); ?>
  <section class="clr"></section>
</section>
<h3 class="line2">Contact Us</h3>
<footer>
  <aside>
    <?php dynamic_sidebar( 'footer-address' ); ?>
  </aside>
  <aside class="last">
    <?php dynamic_sidebar( 'footer-form' ); ?>
  </aside>
  <section class="clr"></section>
</footer>
<!-- #footer -->
<section id="sr-copy">
  <?php dynamic_sidebar( 'footer-copy' ); ?>
</section>
</section>
<!-- #sr-container -->
</section>
<!-- #sr-main-container -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body></html>