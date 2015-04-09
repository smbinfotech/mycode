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

	</div><!-- #main .wrapper -->

	<footer id="colophon" role="contentinfo">

		<div id="site-footer">

        	<div class="footer-widgets">

				<?php dynamic_sidebar('footer-sidebar'); ?>

                <div class="clrs"></div>

            </div>

            <div id="copyrights">

            	<?php dynamic_sidebar('footer-copyrights'); ?>

            	<div class="clrs"></div>

            </div>

            <div class="clrs"></div>

        </div>

	</footer><!-- #colophon -->
</div><!-- #page -->
<?php if(is_home()|| is_author() || is_category() || is_archive()){ ?>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.imagesloaded.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.wookmark.js"></script>
<script type="text/javascript">
    (function ($){ 
      $('#list').imagesLoaded(function() {
        // Prepare layout options.
        var options = {
          itemWidth: 225, // Optional min width of a grid item
          autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('#list'), // Optional, used for some extra CSS styling
          offset: 10, // Optional, the distance between grid items
          outerOffset: 0
        };
        // Get a reference to your grid items.
        var handler = $('#list .post');

        var $window = $(window);
        $window.resize(function() {
          var windowWidth = $window.width(),
              newOptions = { flexibleWidth: '50%' };

          // Breakpoint
          if (windowWidth < 1024) {
            newOptions.flexibleWidth = '100%';
          }

          handler.wookmark(newOptions);
        });

        // Call the layout function.
        handler.wookmark(options);
      });

    })(jQuery);
  </script>
<?php } ?>  
<?php wp_footer(); ?>
<img id="socialfloat" src="<?php bloginfo('template_url'); ?>/images/myshare.png" />
</body>
</html>