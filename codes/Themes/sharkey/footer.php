<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<div id="sr-social"><strong><span>Follow Us</span></strong>
  <?php dynamic_sidebar( 'social' ); ?>
</div>
<footer>
  <?php dynamic_sidebar( 'footer-text' ); ?>
</footer>
<!-- #footer -->

</section>
<!-- #Container -->

<?php
	/*
	 * Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body></html>