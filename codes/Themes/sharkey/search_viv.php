<?php
/*
Template Name: search-results
*/

get_header(); ?>

<div id="sr-content" class="inner">
  <?php if(function_exists('rdfa_breadcrumb')){ rdfa_breadcrumb(); } ?>

<div class="sr-right-area">
	<?php
	//print_r($_POST);
	if($_POST['tex_type']=="equipment-type"){
		meta_filter_supply();
	}else{		
		meta_filter();
	}
	?>
</div>

<div class="sr-left-area">
	<?php get_sidebar(); ?>
</div>

  <div class="clr"></div>
</div>
<?php get_footer(); ?>
