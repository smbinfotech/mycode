<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php //get_sidebar( 'main' ); ?>
            <?php dynamic_sidebar( 'footer' ); ?>
		</footer><!-- #colophon -->
	</div><!-- #page -->

<div class="subscribe-form" id="subscribe-form" style="display:none;">
<!-- Begin MailChimp Signup Form -->

<link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">

<style type="text/css">

               #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }

               /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.

                  We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */

</style>

<div id="mc_embed_signup">

<form action="//bdmd.us4.list-manage.com/subscribe/post?u=ed7cd4fe7e5d2d39634bb1f71&amp;id=0f3a00cc9e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>

    <div id="mc_embed_signup_scroll">

               <h2>Subscribe to our Email Newsletter</h2>

<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>

<div class="field1 mc-field-group">

               <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>

</label>

               <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">

</div>

<div class="field2 mc-field-group">

               <label for="mce-FNAME">First Name </label>

               <input type="text" value="" name="FNAME" class="" id="mce-FNAME">

</div>

<div class="field3 mc-field-group">

               <label for="mce-LNAME">Last Name </label>

               <input type="text" value="" name="LNAME" class="" id="mce-LNAME">

</div>

<div class="mc-field-group input-group">

    <strong>Email Format </strong>

    <ul><li><input type="radio" value="html" name="EMAILTYPE" id="mce-EMAILTYPE-0"><label for="mce-EMAILTYPE-0">html</label></li>

<li><input type="radio" value="text" name="EMAILTYPE" id="mce-EMAILTYPE-1"><label for="mce-EMAILTYPE-1">text</label></li>

</ul>

</div>

<ul class="mtnlinks">
<li><a href="http://us4.campaign-archive1.com/home/?u=ed7cd4fe7e5d2d39634bb1f71&id=0f3a00cc9e" title="View previous campaigns">View previous campaigns.</a>
</li>
<li>Powered by <a href="http://eepurl.com/bbgvon" title="MailChimp - email marketing made easy and fun">MailChimp</a></li></ul>

               <div id="mce-responses" class="clear">

                              <div class="response" id="mce-error-response" style="display:none"></div>

                              <div class="response" id="mce-success-response" style="display:none"></div>

               </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->

    <div style="position: absolute; left: -5000px;"><input type="text" name="b_ed7cd4fe7e5d2d39634bb1f71_0f3a00cc9e" tabindex="-1" value=""></div>

    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>

    </div>

</form>

</div>          

 

<!--End mc_embed_signup--> 
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 1){  
        jQuery('.hdr-inner').addClass("sticky");
    }
    else{
        jQuery('.hdr-inner').removeClass("sticky");
    }
});
});
</script>
<?php wp_footer(); ?>
</body>
</html>