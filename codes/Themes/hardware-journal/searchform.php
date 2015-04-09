<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" onsubmit="return validateForm1()" name="myForm1">
<input type="text" placeholder="Search Here..." class="field" autocomplete="off" id="s" name="s" value="">
<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'GO', 'Hardware Journal' ); ?>" />
</form>