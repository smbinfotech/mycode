<?php
/**
Template Name: Events
*/



get_header(); ?>



	<div id="primary" class="site-content">

    <div class="cont-wrapper">

       		<div class="home-page-comm">

            	<div class="community-sidebar">

					<div class="comm-sidebar">                

					<?php dynamic_sidebar('sidebar-1'); ?>

                        

                    

                    <div class="clrs"></div>

                    </div>

                    <div class="clrs"></div>

                </div>

                <div class="clrs"></div>

            </div>

        	

                <div class="home-page-cont">

		<div id="content" class="cont-inner" role="main">
       	<div class="events">
        <div class="upcoming">
			<div class="upcoming_text">Upcoming Events</div>
		
        	<div class="event-wrapper" id="event-wrapper">
			            <?php
							$blogtime = date('Y');
							$prev_limit_year = $blogtime - 1;
							$prev_month = '';
							$prev_year = '';
							$args = array(
									'post_type'	=> 'events-post',
									'posts_per_page' => -1,
									'post_status' => 'future',
									'order' => 'ASC'
									  );
							$postsbymonth = new WP_Query($args);
							while($postsbymonth->have_posts()) {
								$postsbymonth->the_post();
								
								if(get_the_time('F') != $prev_month || get_the_time('Y') != $prev_year && get_the_time('Y') == $prev_limit_year) {
									   #echo "<h2>".get_the_time('F')."</h2>\n\n";
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
							<div class="event_post">
                            <div class="event_titles">Event Name - <span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></div>
                            <div class="event_dates">Event Date - <?php the_time('l, F jS'); ?></div>
                            <div class="event_content"><?php the_content(); ?></div>
						<div class="clrs"></div>
                        </div>
							<?php
								}
								$prev_month = get_the_time('F');
								$prev_year = get_the_time('Y');
							}
							wp_reset_query();
        ?>	            
       </div><!-- .event-wrapper -->
        <div class="holder"></div>
       <div class="clrs"></div>
        </div>
		<div class="completed">
	        <div class="completed_text">Recently Completed Events</div>
                	<div class="event-wrapper" id="event-wrapper1">
			            <?php
							$args = array(
									'post_type'	=> 'events-post',
									'posts_per_page' => -1,
									'post_status' => 'publish',
									'order' => 'ASC'
									  );
							$postsbymonth = new WP_Query($args);
							while($postsbymonth->have_posts()) {
								$postsbymonth->the_post();
								?>
							<div class="event_post">
                            <div class="event_titles"><?php the_title(); ?></div>
                            <div class="event_dates">Event Date - <?php the_time('l, F jS'); ?></div>
                            <div class="event_content"><?php the_content(); ?></div>
						<div class="clrs"></div>
                        </div>
							<?php
							}
							wp_reset_query();
        ?>	            
       </div><!-- .event-wrapper -->
       <div class="holder1"></div>
       <div class="clrs"></div>
        
        </div>
        <div class="clrs"></div> 
        </div><!-- .Events -->

		</div><!-- #content -->

        <div class="clrs"></div>

        </div><!-- #home-page-cont -->

        <div class="clrs"></div>

        </div><!-- .cont-wrapper -->

        <div class="clrs"></div>

	</div><!-- #primary -->



<?php #get_sidebar(); ?>

<?php get_footer(); ?>