<?php
/*

Template Name: Events Template

*/

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
                
			<?php endwhile; // end of the loop. ?>
            <div class="media_posts">
            <?php
							$blogtime = date('Y');
							$prev_limit_year = $blogtime - 1;
							$prev_month = '';
							$prev_year = '';
							$args = array(
									'category_name'	=> 'events',
									'posts_per_page' => -1,
									'post_status' => 'future',
									'order' => 'ASC'
									  );
							$postsbymonth = new WP_Query($args);
							while($postsbymonth->have_posts()) {
								$postsbymonth->the_post();
								
								if(get_the_time('F') != $prev_month || get_the_time('Y') != $prev_year && get_the_time('Y') == $prev_limit_year) {
									   echo "<h2>".get_the_time('F')."</h2>\n\n";
								}
							   $mykey_values1 = get_post_custom_values('event_date');
							   if($mykey_values1 != '') {
							   foreach ( $mykey_values1 as $key => $value1 ) {
								$eventDate = DateTime::createFromFormat('Ymd', $value1);
								$current_date = strtotime( $value1 );
							   }  /* foreach  mykey_values1 */
							   }
								//$currentDate = new DateTime();
								$currentDate = date('M d, Y');
 								$currentDate = strtotime( $currentDate );
								if ($current_date > $currentDate){
								?>
						<div class="evennts_post">
                            <div class="event_details">
                                <div class="event_title"><?php the_time('l, F jS'); ?><?php the_title(); ?></div>
                                <h4><?php the_content(); ?></h4>
                            </div>
						<div class="clear"></div>
                        </div>
							<?php
								}
								$prev_month = get_the_time('F');
								$prev_year = get_the_time('Y');
							}
							wp_reset_query();
        ?>
            </div>
            
		</div><!-- #content -->
	</div><!-- #primary -->

<div id="secondary" class="widget-area media-sidebar" role="complementary">
			<?php dynamic_sidebar( 'sidebar-media' ); ?>
		</div><!-- #secondary -->
<?php get_footer(); ?>