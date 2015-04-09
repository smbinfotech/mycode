<?php
/**
 * @package Function custplugin
* @version 1.0
*/
/*
Plugin Name: Customs Post
Plugin URI: http://wordpress.org/extend/plugins/ans/
Description:plugin for Custom post
Author: Murtaza Millwala
Version: 1.0
Author URI: http://wordpress.org/
*/
global $statearray;

$statearray = array("NY","PA","WV");
$equipment = array("Cooking Equipment","Refrigeration Equipment","Dishwashers","Furniture","Kitchenware");

add_action( 'init', 'create_equipment_solutions' );

function create_equipment_solutions() {
	register_post_type( 'equipment_solutions',
	array(
	'labels' => array(
	'name' => 'Equipment Solutions',
	'singular_name' => 'Equipment Solutions',
	'add_new' => 'Add New',
	'add_new_item' => 'Add New Equipment Solutions',
	'edit' => 'Edit',
	'edit_item' => 'Edit Equipment Solution',
	'new_item' => 'New Equipment Solution',
	'view' => 'View',
	'view_item' => 'View Equipment Solution',
	'search_items' => 'Search Equipment Solutions',
	'not_found' => 'No Equipment Solution found',
	'not_found_in_trash' => 'No Equipment Solution found in Trash',
	'parent' => 'Parent Equipment Solution'
			),

			'public' => true,
			'menu_position' => 15,
			'supports' => array( 'title', 'editor','thumbnail'),
			'taxonomies' => array( '' ),
			'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
			'has_archive' => true
	)
	);
	
	register_post_type( 'equipment_supply',
	array(
	'labels' => array(
	'name' => 'Equipment Supply',
	'singular_name' => 'Equipment Supply',
	'add_new' => 'Add New',
	'add_new_item' => 'Add New Equipment Supply',
	'edit' => 'Edit',
	'edit_item' => 'Edit Equipment Supply',
	'new_item' => 'New Equipment Supply',
	'view' => 'View',
	'view_item' => 'View Equipment Supply',
	'search_items' => 'Search Equipment Supply',
	'not_found' => 'No Equipment Supply found',
	'not_found_in_trash' => 'No Equipment Supply found in Trash',
	'parent' => 'Parent Equipment Supply'
			),
	
			'public' => true,
			'menu_position' => 15,
			'supports' => array( 'title', 'editor','thumbnail'),
			'taxonomies' => array( '' ),
			'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
			'has_archive' => true
	)
	);
	
}

add_action( 'admin_init', 'viv_es_metabox' );

function viv_es_metabox() {	
	add_meta_box( 'equipment_solution_meta_box',
	'Equipment Detail',
	'display_equipment_solution_meta_box',
	'equipment_solutions', 'normal', 'high'
			);
	add_meta_box( 'equipment_solution_meta_box',
	'Equipment Detail',
	'display_equipment_solution_meta_box',
	'equipment_supply', 'normal', 'high'
			);
}

function display_equipment_solution_meta_box( $es_post ) {    // $es_post is post object 
	// Retrieve current name of the Director and Movie Rating based on review ID
	$manufacturers = esc_html( get_post_meta( $es_post->ID, 'viv_es_manufacturers', true ) );
	$state = esc_html( get_post_meta( $es_post->ID, 'viv_es_state', true ) );
	$type_of_equipment = esc_html( get_post_meta( $es_post->ID, 'type_of_equipment', true ) );
	//$state_arr = array("NY","PA");
	//$equipment = array("Cooking Equipment","Refrigeration Equipment");
	$state_arr = array("NY","PA","WV");
 	$equipment = array("Cooking Equipment","Refrigeration Equipment","Dishwashers","Furniture","Kitchenware");
	?>
    <table>
        <?php if ( $es_post->post_type == 'equipment_solutions') {?>
        <tr>
            <td style="width: 100%">Type of Equipment</td>
            <td>
            <select style="width: 165px" name="type_of_equipment">
                <?php foreach($equipment as $row){?>                
                    <option value="<?php echo $row;?>" <?php echo selected( $row, $type_of_equipment ); ?>><?php echo $row?></option>
                    <?php }?>
                </select>           
            
            </td>
        </tr>
        <?php }?>
        <tr>
            <td style="width: 100%">Manufacturers</td>
            <td><input type="text" size="80" name="manufacturers" value="<?php echo $manufacturers; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 150px">State</td>
            <td>
                <select style="width: 100px" name="state">
                <?php foreach($state_arr as $row){?>                
                    <option value="<?php echo $row;?>" <?php echo selected( $row, $state ); ?>><?php echo $row?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

add_action( 'save_post', 'add_equipment_solutions_fields', 10, 2 );

function add_equipment_solutions_fields( $espost_id, $es_post ) {
	// Check post type for movie reviews
	if ( $es_post->post_type == 'equipment_solutions') {
		// Store data in post meta table if present in post data
		if ( isset( $_POST['manufacturers'] ) && $_POST['manufacturers'] != '' ) {
			update_post_meta( $espost_id, 'viv_es_manufacturers', $_POST['manufacturers'] );
		}
		if ( isset( $_POST['state'] ) && $_POST['state'] != '' ) {
			update_post_meta( $espost_id, 'viv_es_state', $_POST['state'] );
		}
		if ( isset( $_POST['type_of_equipment'] ) && $_POST['type_of_equipment'] != '' ) {
			update_post_meta( $espost_id, 'type_of_equipment', $_POST['type_of_equipment'] );
		}
		
	}
	if ( $es_post->post_type == 'equipment_supply') {
		// Store data in post meta table if present in post data
		if ( isset( $_POST['manufacturers'] ) && $_POST['manufacturers'] != '' ) {
			update_post_meta( $espost_id, 'viv_es_manufacturers', $_POST['manufacturers'] );
		}
		if ( isset( $_POST['state'] ) && $_POST['state'] != '' ) {
			update_post_meta( $espost_id, 'viv_es_state', $_POST['state'] );
		}		
	}
	
}
add_filter( 'template_include', 'include_template_function', 1 );

function include_template_function( $template_path ) {
	if ( get_post_type() == 'equipment_solutions' ) {
		if ( is_single() ) {
			// checks if the file exists in the theme first,
			// otherwise serve the file from the plugin
			if ( $theme_file = locate_template( array ( 'single-viv_temp.php' ) ) ) {
				$template_path = $theme_file;
			} else {
				$template_path = plugin_dir_path( __FILE__ ) . '/single-viv_temp.php';
			}
		}
	}
	return $template_path;
}

function add_custom_taxonomies() {
	// Add new "People" taxonomy to Projects
	register_taxonomy('food-service-type',array('equipment_solutions'), array(
	// Hierarchical taxonomy (like categories)
	'hierarchical' => true,
	// This array of options controls the labels displayed in the WordPress Admin UI
	'labels' => array(
	'name' => _x( 'Food service Type', 'taxonomy general name'),
	'singular_name' => _x( 'Food service Type', 'taxonomy singular name' ),
	'search_items' =>  __( 'Search Food service Type' ),
	'all_items' => __( 'All Food service Type' ),
	'parent_item' => __( 'Parent Food service Type' ),
	'parent_item_colon' => __( 'Parent Food service Type:' ),
	'edit_item' => __( 'Edit Food service Type' ),
	'update_item' => __( 'Update Food service Type' ),
	'add_new_item' => __( 'Add New Food service Type' ),
	'new_item_name' => __( 'New Food service Type' ),
	'menu_name' => __( 'Food service Type' )
	),
	// Control the slugs used for this taxonomy
	'rewrite' => array(
	'slug' => 'food-service-type', // This controls the base slug that will display before each term
	'with_front' => false, // Don't display the category base before "/locations/"
	'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
	),
	));

	register_taxonomy('equipment-type',array('equipment_supply'), array(
	// Hierarchical taxonomy (like categories)
	'hierarchical' => true,
	// This array of options controls the labels displayed in the WordPress Admin UI
	'labels' => array(
	'name' => _x( 'Equipment Type', 'taxonomy general name'),
	'singular_name' => _x( 'equipment-type', 'taxonomy singular name' ),
	'search_items' =>  __( 'Search equipment-type' ),
	'all_items' => __( 'All Food equipment-type' ),
	'parent_item' => __( 'Parent equipment-type' ),
	'parent_item_colon' => __( 'Parent equipment-type:' ),
	'edit_item' => __( 'Edit Equipment Type' ),
	'update_item' => __( 'Update Equipment Type' ),
	'add_new_item' => __( 'Add New Equipment Type' ),
	'new_item_name' => __( 'New Equipment Type' ),
	'menu_name' => __( 'Equipment Type' )
	),
	// Control the slugs used for this taxonomy
	'rewrite' => array(
	'slug' => 'equipment-type', // This controls the base slug that will display before each term
	'with_front' => false, // Don't display the category base before "/locations/"
	'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
	),
	));
	
}
add_action( 'init', 'add_custom_taxonomies', 0 );

/*
function search_filter( $atts ){
	global $statearray, $equipment;
	extract(shortcode_atts(array(
		'tex_type' => 'food-service-type',		
		), $atts));    

    if($tex_type !="equipment-type"){
	    echo "<select id='state' name='state'>";
		foreach($statearray as $row){
			echo "<option value='$row'>$row</option>";
		}
		echo "</select>";		
		echo "<div id='eq_div' style='display:none'><select id='type_of_equipment' name='type_of_equipment'>";
		echo "<option value=''>Select type</option>";
		foreach($equipment as $row){
			echo "<option value='$row'>$row</option>";
		}
	}else{
		echo "<select id='esupply_state' name='state'>";
			foreach($statearray as $row){
				echo "<option value='$row'>$row</option>";
			}
		echo "</select>";		
     }	
	echo "</select><input type='hidden' id='tex_type' value='$tex_type'></div>";
} */
//shorcode
function search_filter( $atts ){
	global $statearray, $equipment;
	extract(shortcode_atts(array(
	'tex_type' => 'food-service-type',
	), $atts));

	if($tex_type !="equipment-type"){
        echo "<form id='filter_form' name='filter_form' action='".site_url("search")."' method='POST'>"; 
		echo "<select id='state' name='state'>";
		echo "<option value=''>Select State</option>";
		foreach($statearray as $row){
			echo "<option value='$row'>$row</option>";
		}
		echo "</select>";
		echo "<div id='eq_div' style='display:none'><select id='type_of_equipment' name='type_of_equipment'>";
		echo "<option value=''>Select type</option>";
		foreach($equipment as $row){
			echo "<option value='$row'>$row</option>";
		}
		echo "</select><input type='hidden' id='tex_type' name='tex_type' value='$tex_type'>
		<input type='hidden' id='sub_cat' name='sub_cat' value=''>
		</div>";
		echo "</form>";
		
	}else{
        echo "<form id='filter_form' name='filter_form' action='".site_url("search")."' method='POST'>"; 
		echo "<select id='esupply_state' name='state'>";
		echo "<option value=''>Select State</option>";
		foreach($statearray as $row){
			echo "<option value='$row'>$row</option>";
		}
		echo "</select>";
		echo "</select><input type='hidden' id='tex_type' name='tex_type' value='$tex_type'>
		<input type='hidden' id='sub_cat' name='sub_cat' value=''>";
		echo "</form>";
		
	}
		//echo "</select><input type='hidden' id='tex_type' value='$tex_type'></div>";
}

						
add_shortcode( 'search_filter', 'search_filter' ); //[search_filter]
add_action( 'wp_ajax_meta_filter', 'meta_filter' );
add_action( 'wp_ajax_nopriv_meta_filter', 'meta_filter' );

add_action( 'wp_ajax_meta_filter_supply', 'meta_filter_supply' );
add_action( 'wp_ajax_nopriv_meta_filter_supply', 'meta_filter_supply' );

function enqueue_scripts_styles_init() {
	wp_enqueue_script( 'ajax-script', get_stylesheet_directory_uri().'/js/custom.js', array('jquery'), 1.0 );
	wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('init', 'enqueue_scripts_styles_init');

function meta_filter(){ 

	global $wpdb;	
	$state = trim($_POST['state']);
	$type_of_equipment = trim($_POST['type_of_equipment']);
	$tex_type = trim($_POST['tex_type']);
	$sub_cat = trim($_POST['sub_cat']);
	
	/*
	$type_of_equipment = trim($_POST['equipment_type']);
	$tex_type = trim($_POST['tex_type']);
	$sub_cat = trim($_POST['sub_cat']);*/
	
	
	$sql = "SELECT term_id from sa_terms where slug='$sub_cat'";
	
	$result  = $wpdb->get_results($sql);	
	$term_id = $result[0]->term_id;
	
	$data = get_posts(array(
			'meta_query' => array(
					'relation'      => 'AND',
					array(
							'key' => 'viv_es_state',
							'value' => $state,
							'compare'=>'='
					),
					array(
							'key' => 'type_of_equipment',
							'value' => $type_of_equipment,
							'compare'=>'='
					)
			),
			'post_type' => 'equipment_solutions',
			'tax_query' => array(
					array(
							//'taxonomy' => 'food-service-type',
							'taxonomy' => $tex_type,							
							'field' => 'term_id',
							'terms' => $term_id)
			))
	);
    
    if(!empty($data)){
        echo '<h1 class="equip-heading"><span>List of Products</span></h1>';
		foreach($data as $row){		
			$key = "viv_es_manufacturers";
			echo "<ul class='sr-product-list'><li><strong>".$row->post_title."</strong>";			
			echo "<span><b>Manufacturers - </b>".get_post_meta($row->ID,$key,true)."</span></li><div class='clr'></div></ul>";
			  
			}
	}	
	else{
    	echo "<h1 class='equip-heading'><span>No Record Found</span></h1> <p>There are currently no products in this category. Please try your search again.</p>";
    	//echo 1;
    }   
}

function meta_filter_supply(){
	global $wpdb;
	$state 		= trim($_POST['state']);
	$tex_type 	= trim($_POST['tex_type']);
	$sub_cat 	= trim($_POST['sub_cat']);
	
	$sql 		= "SELECT term_id from sa_terms where slug='$sub_cat'";
	$result  	= $wpdb->get_results($sql);
	$term_id	= $result[0]->term_id;	

	$data = get_posts(array(
			'meta_query' => array(
					'relation'      => 'AND',
					array(
							'key' => 'viv_es_state',
							'value' => $state,
							'compare'=>'='
					)				
			),
			'post_type' => 'equipment_supply',
			'tax_query' => array(
				array(
				'taxonomy' => $tex_type,
				'field' => 'term_id',
				'terms' => $term_id)
		))
	);

	if(!empty($data)){
		echo '<h1 class="equip-heading"><span>List of Products</span></h1>';
		foreach($data as $row){
			$key = "viv_es_manufacturers";
			echo "<ul class='sr-product-list'><li><strong>".$row->post_title."</strong>";			
			echo "<span><b>Manufacturers - </b>".get_post_meta($row->ID,$key,true)."</span><div class='clr'></div></li></ul>";
			 
		}
	}
	else{
		echo "<h1 class='equip-heading'><span>No Record Found</span></h1> <p>There are currently no products in this category. Please try your search again.</p>";
		//echo 1;
	}
	
}