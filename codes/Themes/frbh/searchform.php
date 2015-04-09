<?php
/**
 * The template for displaying search forms in Twenty Eleven
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" onsubmit="return validateForm1()" name="myForm1">
                            <input type="text" class="field" autocomplete="off" id="s" name="s" value="Search" onfocus="(this.value == 'Search') && (this.value = '')"
       onblur="(this.value == '') && (this.value = 'Search')" />
                            <input type="submit" class="submit" name="submit" id="searchsubmit" value="" />
                        </form>
