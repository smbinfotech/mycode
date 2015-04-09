<?php
/**
 * @package Function titlescroller
* @version 1.0
*/
/*
Plugin Name:Page Title Scroller
Plugin URI: http://wordpress.org/extend/plugins
Description:plugin for Page Title on front page. 
Author: Murtaza Millwala
Version: 1.0
Author URI: http://wordpress.org
*/

add_action( 'admin_init', 'viv_es_metabox' );

function viv_es_metabox() {
	add_meta_box( 'Is Application Type:',
	'Is Application Type:',
	'display_is_application_meta_box',
	'page', 'normal', 'high'
			);
}

function display_is_application_meta_box( $es_post ) {    // $es_post is post object
	// Retrieve current name of the Director and Movie Rating based on review ID
	$is_application = esc_html( get_post_meta( $es_post->ID, 'is_application_viv', true ) );
    $image_title = esc_html( get_post_meta( $es_post->ID, 'text_for_image_viv', true ) );
	?>
    <table>
        <?php if ( $es_post->post_type == 'page') {?>
        <tr>
            <td style="width: 50%">Is Application:</td>
            <td>   
            <input type="checkbox" name="is_application" id="is_application" value="1" <?php if(isset($is_application) && $is_application=="1"){ echo "checked='checked'"; }?>>                  
            </td>
        </tr> 
         <tr>
            <td style="width: 50%">Text on scroll image:</td>
            <td>   
            <input type="text" name="image_title" id="image_title" size="50" <?php if(isset($image_title) && !empty($image_title)){?>value="<?php echo $image_title;?>" <?php }?>>                  
            </td>
        </tr>

    </table>
    <?php }
}

add_action( 'save_post', 'add_is_page_fields', 10, 2 );

function add_is_page_fields( $espost_id, $es_post ) {
	// Check post type for movie reviews
	if ( $es_post->post_type == 'page') {
		// Store data in post meta table if present in post data
		if ( isset( $_POST['is_application'] ) && $_POST['is_application'] != '' ) {            
				update_post_meta( $espost_id, 'is_application_viv', $_POST['is_application'] );			
				update_post_meta( $espost_id, 'text_for_image_viv', $_POST['image_title'] );
		}else {
			     update_post_meta( $espost_id, 'is_application_viv',0 );
		}
			
		}
}

add_shortcode( 'Application_view', 'application_list' ); //[Application_view]

function application_list( $atts ){
		global $wpdb;
		$sql  = "SELECT *
		FROM ".$wpdb->prefix."posts AS wpp
		LEFT JOIN  ".$wpdb->prefix."postmeta as wpm ON wpm.post_id = wpp.ID
		WHERE wpm.meta_key = 'is_application_viv' and wpm.meta_value=1 AND  wpp.post_status='publish'";
		
		$result = $wpdb->get_results($sql);
		$total = count($result);
		echo "<div id='tutleco'><strong class='title'>Applications</strong>";
		$i =1;
		foreach($result as $row){ 
		$metavalue =  get_post_meta( $row->ID, "text_for_image_viv");        
            echo "<div class='myclass' id='$row->ID'>".$row->post_title."</div>";
			if($total==$i)
			 echo "</div>";			
			 echo "<div style='display:none;'>".get_the_post_thumbnail( $row->ID, 'large',array( 'id' =>'vivimg_'.$row->ID) )."</div>";	

 			echo  "<div style='display:none;' id='excerpt_$row->ID'>".$row->post_excerpt;			
			echo  ' <a href="' . get_permalink($row->ID) . '">READ MORE</a></div>';
			echo "<span style='display:none;' id='metvalue_$row->ID'>".$metavalue[0]."</span>";
			$metavalue =  get_post_meta( $row->ID, "text_for_image_viv");
			
			$i++;	
		}
		$metavalue =  get_post_meta( $result[0]->ID, "text_for_image_viv");
		/*echo "<div id='app_image_box'>".get_the_post_thumbnail( $result[0]->ID, 'large',array( 'id' =>'result_image') )."
		 <div id='ex_content'>"."<span class='app-widget-heading'>".$metavalue[0]."</span>".$result[0]->post_excerpt ."<a href='".get_permalink($result[0]->ID)."'>READ MORE</a></div></div>";
		/*echo "<div id='app_image_box'><img id='result_image' width='279' height='268' src=''>
			   <div id='ex_content'></div>
			   </div>";*/		   
			   
		echo "<div id='app_image_box'><div class='app-left'>"."<span class='app-widget-heading' id='mettitle'>".$metavalue[0]."</span>"."</div><div class='app-right'>".get_the_post_thumbnail( $result[0]->ID, 'large',array( 'id' =>'result_image') )."</div><div class='clr'></div>
		 <hr class='widget-hr'><div id='ex_content'>".$result[0]->post_excerpt ."<a href='".get_permalink($result[0]->ID)."'>READ MORE</a></div></div>";
			   
}

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
		     add_post_type_support( 'page', 'excerpt' );
		}
