<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		
			<header class="archive-header">
				<!--<h1 class="archive-title"><?php echo single_cat_title( '', false ); ?></h1>-->

				<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->
     <!-- Related Project Section on People Page Start -->  
<div class="wrap-div">
<?php if ( have_posts() ) : ?>
     <div class="col_2">       
            
            
			<?php /* The loop */ ?>
            
            <ul id="jpages1" class="box sports clear">
            <p class="heading-center"><span>Related Projects</span></p>
			
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'tax-people' ); ?>
			<?php endwhile; ?>
		<?php endif; ?>
		</ul>
        <!--<div class="holder1"></div>-->
        </div>
        
 <!-- Related Project Section on People Page End -->      
 
 <!-- Related People Section on People Page Start -->  
		<?php 
		$term = $wp_query->queried_object;
        $metaValues = get_terms_meta($term->term_id, 'related_peoples');
		if($metaValues!= ''){
		?>
        <div class="col_2">
       
    	<ul id="jpages2" class="box markets clear">
         <p class="heading-center"><span>Related People</span></p>
        <?php
		$rppls = explode(",",$metaValues[0]);
		foreach ( $rppls as $rps ) {
		$tm = get_term( $rps, 'people' );
		$metaValues2 = get_terms_meta($tm->term_id, 'people_image');
		?>
        <li>
        <a class="box1" href="<?php echo get_term_link($tm->slug,'people') ?>">
        <img src="<?php echo $metaValues2[0]; ?>" alt="<?php echo $tm->name; ?>" title="<?php echo $tm->name; ?>">
        <strong class="caption"><?php echo $tm->name; ?></strong>
        </a>
        </li>
        <?php
        }
		?>
        </ul>
        <!--<div class="holder2"></div>-->
        </div>
        <?php
		}
        ?>	 
        
         <!-- Related People Section on People Page End -->
        
    </div>    
        
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>