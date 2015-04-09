<?php
/**
 * The template for displaying search forms in Twenty Eleven
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
	<form method="get" id="searchforms" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="text" class="field" autocomplete="off" id="sb" name="s" value="">
		<input type="submit" class="submits" name="submit" id="searchsubmits" value="<?php esc_attr_e( 'GO', 'Kapusta' ); ?>" />
	</form>
