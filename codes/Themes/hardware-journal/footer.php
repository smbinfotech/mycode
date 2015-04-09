<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<!-- Banner Ads Section -->
<div class="bottom-banner">
<?php dynamic_sidebar('bottom-banner'); ?>
</div>
<!-- Banner Ads Section -->
<div class="clrs"></div>
</div>
    <?php if(!is_front_page()){ ?>
    <div class="right-ads">
        <?php dynamic_sidebar('right-ads'); ?>
        </div>
		<?php } ?>
<div class="clrs"></div>
	</div><!-- #main .wrapper -->
	<footer class="footers">
		<div class="footer" id="footer">
        	<div class="pagewraps">
            	<div class="footer-sidebar">
                	<?php dynamic_sidebar('footer-sidebar'); ?>
                </div>
            <div class="clrs"></div>
			</div>
        </div>
	</footer><!-- #colophon -->
<div class="clrs"></div>    
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>