<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<div class="clear"></div>
<?php if(is_front_page()){
	?>
    <div class="bottom-widget-home" id="home-bottom-widget">
    <?php dynamic_sidebar('sidebar-homebottom'); ?>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
	<?php
	}
	?>
	</div><!-- #main .wrapper -->
    <div class="clear"></div>
    <?php if(is_front_page()){ ?>
    <div class="boatinventorywrapper">
    	<div class="boatinventorywrap">
        	<?php dynamic_sidebar('featured-boat-inventory-widget'); ?>
        </div>
    <div class="clear"></div>
    </div>
    <?php } ?>
	<footer id="colophon" role="contentinfo">
    	<div id="footer-wrap">
			<div class="footer-sidebar">
            	<?php dynamic_sidebar('footer-sidebar'); ?>
                <div class="clear"></div>
            </div>
            <div class="copyright-sidebar">
				<?php dynamic_sidebar('copyrights-sidebar'); ?>
	        <div class="clear"></div>
            </div>
            <div class="clear"></div>
            </div>
	</footer><!-- #colophon -->
</div><!-- #page -->
</div>
<?php wp_footer(); ?>
</body>
</html>