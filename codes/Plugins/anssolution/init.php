<?php
/**
 * @package Function ansplugin
* @version 1.0
*/
/*
Plugin Name:AnsSolution
Plugin URI: http://wordpress.org/extend/plugins/ans/
Description:plugin for AnsSolution
Author: Murtaza Millwala
Version: 1.0
Author URI: http://wordpress.org
*/
global $dbh;

function makeconnection(){
try {
	global $dbh;
	$hostname = "173.220.110.218";
	$port = 7777;
	$dbname = "AnsCaseMgmt";
	$username = "AnsWebApprA7eD";
	$pw = "Du!HA$Tesp#aF3Tr";
	$obj = new PDO ("dblib:host=173.220.110.218:7777;dbname=AnsCaseMgmt",'AnsWebApprA7eD','Du!HA$Tesp#aF3Tr');
	//$obj = new PDO ("sqlsrv:Server=173.220.110.218,7777;Database=AnsCaseMgmt",'AnsWebApprA7eD','Du!HA$Tesp#aF3Tr');
	$dbh = $obj;
	//return $dbh;
	//$dbh =  new PDO('odbc:Driver=FreeTDS; Server=173.220.110.218; Port=7777; Database=AnsCaseMgmt; UID=AnsWebApprA7eD; PWD=Du!HA$Tesp#aF3Tr;');
	} catch (PDOException $e) {
		echo "Failed to get DB handle: " . $e->getMessage() . "\n";
		exit;
	}
}

function wspCases($dbh,$case=null){	
	global $dbh;
	$dbh->exec("SET ANSI_WARNINGS ON");
	$dbh->exec("SET ANSI_PADDING ON");	
	$dbh->exec("SET ANSI_NULLS ON");
	$dbh->exec("SET QUOTED_IDENTIFIER ON");
	$dbh->exec("SET CONCAT_NULL_YIELDS_NULL ON"); 	
	if(isset($_SESSION['custId'])&& !empty($_SESSION['custId'])){
		$status = trim($case);
		switch ($status) {
			case "active":
				$status ="ACTIVE";
				break;
			case "Closed":
				$status ="Closed";
				break;
			default:
				$status ="";
		}
		//$sth = $dbh->prepare("EXEC wspCases @CustID ='21st Century Pinnacle Ins Co',@ContID= 1180,@Status = NULL");
		$custID = $_SESSION['custId'];
		$contID = $_SESSION['contId'];

		$sth = $dbh->prepare("Exec wspCases  @CustID=".$custID.", @ContID =".$contID.", @Status='".$status."'");
		$sth->execute();
		$row = $sth->fetchAll(PDO::FETCH_ASSOC);		
		return $row;
		/*while ($row = $sth->fetch()) {
		 print_r($row);
		}*/
	}
}

function CoutOpenCalim(){
	global $dbh;
	$dbh->exec("SET ANSI_WARNINGS ON");
	$dbh->exec("SET ANSI_PADDING ON");
	$dbh->exec("SET ANSI_NULLS ON");
	$dbh->exec("SET QUOTED_IDENTIFIER ON");
	$dbh->exec("SET CONCAT_NULL_YIELDS_NULL ON");
	
	$custID = $_SESSION['custId'];
	$contID = $_SESSION['contId'];	
	$status = "Active";		
	$sth = $dbh->prepare("Exec wspCases  @CustID=".$custID.", @ContID =".$contID.", @Status='".$status."'");
	$sth->execute();	
	$row = $sth->fetchAll(PDO::FETCH_ASSOC);
	$count =  count($row);	
	return $count;
}

function wspCaseDetails($id){	
	//$dbh =  makeconnection();
	global $dbh;
	$dbh->exec("SET ANSI_WARNINGS ON");
	$dbh->exec("SET ANSI_PADDING ON");
	$dbh->exec("SET ANSI_NULLS ON");
	$dbh->exec("SET QUOTED_IDENTIFIER ON");
	$dbh->exec("SET CONCAT_NULL_YIELDS_NULL ON");
	$caseID = unserialize(base64_decode($id));
	$row['summeryDetail'][0]['CaseID']    = $caseID[0];
	$row['summeryDetail'][0]['Claimant']  = $caseID[1];
	$row['summeryDetail'][0]['CaseAnsNbr']= $caseID[2];
	
	$stmt = $dbh->prepare("Exec dbo.wspCaseDetails @CaseID=$caseID[0]");		
	$stmt->execute();	
	$row['detail'] = $stmt->fetchAll(PDO::FETCH_ASSOC);	
	//createLog($id); 
	return $row;
}

//add_action( 'user_register', 'myplugin_registration_save', 10, 1 );
function myplugin_registration_save( $user_id ) {	
	//global $dbh;
	//$dbh =  makeconnection();
	$hostname = "173.220.110.218";
	$port = 7777;
	$dbname = "AnsCaseMgmt";
	$username = "AnsWebApprA7eD";
	$pw = "Du!HA$Tesp#aF3Tr";
	$dbh = new PDO ("dblib:host=173.220.110.218:7777;dbname=AnsCaseMgmt",'AnsWebApprA7eD','Du!HA$Tesp#aF3Tr');
	//$dbh = new PDO ("sqlsrv:Server=173.220.110.218,7777;Database=AnsCaseMgmt",'AnsWebApprA7eD','Du!HA$Tesp#aF3Tr');
	
	$customerName = trim($_POST['customer_name']);
	$contact = trim($_POST['contact']);
	
	$stmt = $dbh->prepare("Exec wspValidate @CustName = '".$customerName."', @Contact = '".$contact."'");
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$to = get_option( 'admin_email', $default );	
	$subject = "New User Registration";	
	if($row[0]['Found']=="Y"){		
		$message = "New User is registerd with Valid Contact and Custumer name";		
		update_user_meta( $user_id, "active",1);
				
	}else{		
		$message = "New User is registerd with Invalid Contact or Custumer name";
		update_user_meta( $user_id, "active",0);
	}	
	if( wp_mail( $to, $subject, $message, $headers ) ) {
	} else {
		echo 'The message was not sent!';		
	}
}

add_action( 'wpmem_register_redirect','the_reg_redirect' );
function the_reg_redirect()
{	wp_redirect(site_url().'/thank-you-register/');
	exit();
}

function myplugin_auth_login($user, $password) {
   if ( !is_admin() ) {
		global $wpdb;
		global $dbh;
		$user_id = $user-> ID;	
		$key = 'customer_name';
		$single = true;
		$all_meta_for_user = get_user_meta($user_id);
		$customerName = $all_meta_for_user['customer_name'][0];		
		/*$customerName = get_user_meta( $user_id, $key, $single );		
		$key = 'contact';
		$single = true;
		$contact = get_user_meta( $user_id, $key, $single );*/
        $contact = $all_meta_for_user['last_name'][0].", ".$all_meta_for_user['first_name'][0];  // @Contact name last_name, first_name        
		
		/*................*/
		$obj =  makeconnection();
		//wspValidate($obj);		
		$stmt = $dbh->prepare("Exec wspValidate @CustName = '".$customerName."', @Contact = '".$contact."'");
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if($row[0]['Found']=="Y"){
			session_start();
			$_SESSION['customerName']=$customerName;
			$_SESSION['custId']=$row[0]['CustID'];
			$_SESSION['contId']=$row[0]['ContID'];
		}
		return $user;
	}
}

function close_session() {	
		session_start();
		session_destroy();	
}
add_action('wp_logout', 'close_session');
/*..................................*/
function set_content_type($content_type){
	return 'text/html';
}

/*...Report Mailer...*/
function reportMailer(){
	add_filter('wp_mail_content_type','set_content_type');	
	$message='<style>
			 .mr-tr-col-head td,.mr-tr-col-center td,.mr-tr-col-bottom td{padding:5px;}
			 {padding:5px;}
			</style>
			<table>
 			<thead>
				<tr class="mr-tr-col-head">
				<td class="mr-col-head">Claim Number</td>
				<td class="mr-col-data">'.$_POST['claimno'].'</td>
              <td class="mr-col-head">Name of Claimant</td>
              <td class="mr-col-data">'.stripslashes($_POST['claimant']).'</td>
            </tr>
          </thead>
          <tbody>
            <tr class="mr-tr-col-center">
              <td class="mr-col-head-lt bg-r-on">Insurer</td>
               <td class="mr-col-head-lt bg-r">'.$_POST['insurer'].'</td>
              <td class="mr-col-head-rt bg-r-on">Claim Type</td>
              <td class="mr-col-head-rt bg-r">'.stripslashes($_POST['claimtype']).'</td>
            </tr>
            <tr class="mr-tr-col-bottom">
              <td class="mr-col-head-lt bg-r-on">Date of Injury</td>
              <td class="mr-col-head-lt bg-r">'.$_POST['dateinjury'].'</td>
              <td class="mr-col-head-rt bg-r-on">Date of Referral</td>
              <td class="mr-col-head-rt bg-r">'.$_POST['datereferral'].'</td>
            </tr>
            <tr class="mr-tr-col-bottom">
              <td class="mr-col-head-lt bg-r-on">Date records received</td>
              <td class="mr-col-head-lt bg-r">'.$_POST['daterecordreceived'].'</td>
              <td class="mr-col-head-rt bg-r-on">Date report was sent to adjuster</td>
              <td class="mr-col-head-rt bg-r">'.$_POST['recordsenttoadjuster'].'</td>
            </tr>
            <tr class="mr-tr-col-bottom">
              <td class="mr-col-head-lt bg-r-on">Status</td>
              <td class="mr-col-head-lt bg-r">'.$_POST['status'].'</td>
              <td class="mr-col-head-rt bg-r-on"></td>
              <td class="mr-col-head-rt bg-r"></td>
            </tr>
          </tbody>
        </table>';	

	$current_user = wp_get_current_user();
    $to = $current_user->user_email;
    $subject = "Anssolutions Report";
    if( wp_mail( $to, $subject, $message, $headers ) ) {
    } else {
  			echo 'The message was not sent!';
    }
  die;
}



/***************************************
 * 
 * ............Non working.............
 * *************************************/
  
function wspCustomerContacts($dbh){
	$sth = $dbh->prepare("EXEC wspCustomerContacts @CustName = ?");
	//$name = "21st Century Pinnacle Ins Co";
	$name = "Zenith Insurance Company";
	$sth->bindParam(1, $name);
	$sth->execute();
	//return $row = $sth->fetch();
	while ($row = $sth->fetch()) {
		print_r($row);
	}
}

function wspCustomers($dbh){
	$stmt = $dbh->prepare("EXEC wspCustomers");
	$stmt->execute();
	while ($row = $stmt->fetch()) {
		print_r($row);
	}
}

function wspValidate($dbh){
	global $dbh;
	//$stmt = $dbh->prepare("Exec wspValidate @CustName = 'Zenith Insurance Company', @Contact = 'Casasnovas, Norma'");
	$customerName = "Zenith Insurance Company";
	$contact ="Casasnovas, Norma"; // lastname firstname
	$stmt = $dbh->prepare("Exec wspValidate @CustName = '".$customerName."', @Contact = '".$contact."'");
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if($row[0]['Found']=="Y"){
		session_start();
		$_SESSION['customerName']=$customerName;
		$_SESSION['custId']=$row[0]['CustID'];
		$_SESSION['contId']=$row[0]['ContID'];
		return true;
	}else{
		wp_redirect(site_url());
		exit;
	}
	/*while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
		print_r($row);
	}*/
}
function getUserInfo(){
	// Later it containing Session data;
	$userData = array();
	$userData['custName'] = "Zenith Insurance Company" ;
	$userData['contact'] ="Casasnovas, Norma";
	return $userData;
}

/*...for ajax...*/

function createLog(){ 
	global $userdata;
    get_currentuserinfo();
 if ($userdata->ID != '') {
	global $wpdb;
	$user_id = get_current_user_id();
	$caseid = $_POST['claimno'];
	$caseID  = unserialize(base64_decode($caseid));
	$CaseAnsNbr= $caseID[2];
	//$CaseAnsNbr=$_POST['claimno'];
	$key = 'first_name';
	$firstName = get_user_meta( $user_id,$key,true);
	$key = 'last_name';
	$lastname = get_user_meta( $user_id, $key, true);
	$customer_name = $lastname.", ".$firstName;
	$date = date('Y-m-d H:i:s');
	$myTableName = $wpdb->prefix . 'usertracker';
	$sql = "INSERT INTO " . $myTableName . " (name,date_time,case_id) VALUES ('".$customer_name."',NOW(),'".$CaseAnsNbr."')";
	$wpdb->query($sql);	
  }
	echo 1;	
	/*$wpdb->insert("wp_usertracker",array('name'=>$customer_name,'date_time'=>$date,'case_id'=>$CaseAnsNbr));
	 echo $wpdb->last_query;*/
	/*} */
	
}

add_action('admin_menu', 'UT_add_pages');

function UT_add_pages() {
	add_submenu_page('index.php', __('AnsUser Tracker'), __('AnsUser Tracker'), 'manage_options', 'userTracker', 'UT_statsPage');
}

function UT_statsPage() {
	global $wpdb;
	$record_perpage = 50;
	$start=0;
	
	if(isset($_GET["p"])){
		$page = intval($_GET["p"]);
	}else{
		$page = 1;
	}	
	$calc  = $record_perpage * $page;
	$start = $calc - $record_perpage;	
	
    $sql = "SELECT * from wp_usertracker ORDER BY usertracker_id DESC LIMIT $start, $record_perpage";	
    $total = $wpdb->get_var( "SELECT COUNT(*) from wp_usertracker",0,0);    
    $result  = $wpdb->get_results($sql);    
    
    $totalPages = ceil($total / $record_perpage);    
    $pagenum = isset( $_GET['p'] ) ? absint( $_GET['p'] ) : 1;
    $limit = 50; // number of rows in page
    $offset = ( $pagenum - 1 ) * $limit;
    
    $page_links = paginate_links( array(
    		'base' => add_query_arg( 'p', '%#%' ),
    		'format' => '',
    		'prev_text' => __( '&laquo;', 'aag' ),
    		'next_text' => __( '&raquo;', 'aag' ),
    		'total' => $totalPages,
    		'current' => $pagenum
    ) );        
	include_once 'usertracklist.php';
}