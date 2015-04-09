<?php global $data; ?>
<?php if($data['header_number'] || $data['header_email']): ?>
<?php echo '<span>Call Us Today!</span><span class="nums">'. $data['header_number'].'</span>'; ?><?php if($data['header_number'] && $data['header_email']): ?><span class="sep">|</span><?php endif; ?><a class="emails" href="mailto:<?php echo $data['header_email']; ?>"><?php echo $data['header_email']; ?></a><a id="searches" href="javascript:void();"><img src="<?php bloginfo('template_url'); ?>/images/search-icon.jpg" /></a>
<?php endif; ?>
