<?php /* Template Name: Case Detail */ ?>
<?php
session_start();
if (!is_user_logged_in()){
	wp_redirect(site_url().'/client-access/');
	exit;
}
makeconnection();
//$obj =  makeconnection();
//wspValidate($obj);
get_header();
$caseid = $wp_query->query_vars['id'];
?>
	<script>
	jQuery(document).ready(function() {
	/*jQuery(".createlog").on("load",function(e){*/		
	    //e.preventDefault();

	    var mydata = jQuery( "#dataarray" ).data();	
		jQuery.post(ajax_object.ajaxurl, {
			action: 'createLog',
			claimno:'<?php echo $caseid;?>'				
			}, function(data) {
				//window.open(link,'_blank');
      			//window.location.href = link;
			}); 
	}); 
	</script>

<div id="content" style="<?php echo $content_css; ?>">
  <div class="post-content">
    <div id="tab-header">
      <div class="mr-tab-responsive">
        <div class="mr-tab-responsive-left">
          <h1>Client Access Portal</h1>
        </div>
      
<!--        <div class="mr-tab-responsive-right">
        
        </div>-->
      </div>
      <div class="clr"></div>
      <?php 
				      $caseid = $wp_query->query_vars['id'];
				      $content = wspCaseDetails($caseid);      

				      $dataA= json_encode($content);
                ?>
      <div id="mr-article">       
      <input type="hidden" 
      data-claimNo ="<?php echo $content['summeryDetail'][0]['CaseAnsNbr'];?>" 
      data-claimant ="<?php echo $content['summeryDetail'][0]['Claimant'];?>" 
      data-insurer ="<?php echo $_SESSION['customerName'];?>"
      data-claimType ="<?php echo $content['detail'][0]['CoverageType'];?>" 
      data-dateInjury ="<?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseLossDt']));?>" 
      data-dateReferral ="<?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseReferralDt']));?>" 
      data-dateRecordReceived ="<?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseRecordsRecdDt']));?>"
      data-recordSentToAdjuster ="<?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseFinalRptSubmitDt']));?>"
      data-status ="<?php echo $content['detail'][0]['Status'];?>"
      id="dataarray">
      
         <table id="desktop">
          <thead>
            <tr class="mr-tr-col-head">
              <th class="mr-col-head">Claim Number</th>
              <td class="mr-col-data"><?php echo $content['summeryDetail'][0]['CaseAnsNbr'];?></td>
              <th class="mr-col-head">Name of Claimant</th>
              <td class="mr-col-data"><?php echo $content['summeryDetail'][0]['Claimant'];?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="mr-tr-col-center">
              <td class="mr-col-head-lt bg-r-on">Insurer</td>
               <td class="mr-col-head-lt bg-r"><?php echo $_SESSION['customerName'];?></td>
              <td class="mr-col-head-rt bg-r-on">Claim Type</td>
              <td class="mr-col-head-rt bg-r"><?php echo $content['detail'][0]['CoverageType'];?></td>
            </tr>
            <tr>
              <td class="mr-col-head-lt bg-r-on">Date of Injury</td>
              <td class="mr-col-head-lt bg-r"><?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseLossDt']));?></td>
              <td class="mr-col-head-rt bg-r-on">Date of Referral</td>
              <td class="mr-col-head-rt bg-r"><?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseReferralDt']));?></td>
            </tr>
            <tr>
              <td class="mr-col-head-lt bg-r-on">Date records received</td>
              <td class="mr-col-head-lt bg-r"><?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseRecordsRecdDt']));?></td>
              <td class="mr-col-head-rt bg-r-on">Date report was sent to adjuster</td>
              <td class="mr-col-head-rt bg-r"><?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseFinalRptSubmitDt']));?></td>
            </tr>
            <tr>
             <td class="mr-col-head-lt bg-r-on">Services Requested</td>
              <td class="mr-col-head-lt bg-r"><?php echo $content['detail'][0]['ServicesRequested'];?></td>
              <td class="mr-col-head-rt bg-r-on">Status</td>
              <td class="mr-col-head-rt bg-r"><?php echo $content['detail'][0]['Status'];?></td>             
            </tr>
          </tbody>
        </table>
       
       
       <div id="mobile" class="detailswrap">
       
        <div class="mainwrapin mainwrapstop">
        <div class="mainwrapsleft">
        Claim Number
        </div>
        <div class="mainwrapsright">
        <?php echo $content['summeryDetail'][0]['CaseID'];?>
        </div>
      	<div class="clrs"></div>
        </div>
        
        
        <div class="mainwrapin mainwrapstop">
        <div class="mainwrapsleft">
        Name of Claimant
        </div>
        <div class="mainwrapsright">
        <?php echo $content['summeryDetail'][0]['Claimant'];?>
        </div>
      	<div class="clrs"></div>
        </div>
        
        <div class="mainwrapin">
        <div class="mainwrapsleft">
      	 Insurer	 
        </div>
        <div class="mainwrapsright">
        <?php echo $_SESSION['customerName'];?>
        </div>
      	<div class="clrs"></div>
        </div>
        
        
        <div class="mainwrapin">
        <div class="mainwrapsleft">
        Claim Type
        </div>
        <div class="mainwrapsright">
        <?php echo $content['detail'][0]['CoverageType'];?>
        </div>
      	<div class="clrs"></div>
        </div>
        
        <div class="mainwrapin">
        <div class="mainwrapsleft">
        Date of Injury
        </div>
        <div class="mainwrapsright">
        <?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseLossDt']));?>
        </div>
      	<div class="clrs"></div>
        </div>
        
        <div class="mainwrapin">
        <div class="mainwrapsleft">
        Date of Referral
        </div>
        <div class="mainwrapsright">
        <?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseReferralDt']));?>
        </div>
      	<div class="clrs"></div>
        </div>
        
        <div class="mainwrapin">
        <div class="mainwrapsleft">
        Date records received
        </div>
        <div class="mainwrapsright">
        <?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseRecordsRecdDt']));?>
        </div>
      	<div class="clrs"></div>
        </div>
        
        <div class="mainwrapin">
        <div class="mainwrapsleft">
        Date report was sent to adjuster
        </div>
        <div class="mainwrapsright">
        <?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseFinalRptSubmitDt']));?>
        </div>
      	<div class="clrs"></div>
        </div>
        
        
        <div class="mainwrapin">
        <div class="mainwrapsleft">
        Status
        </div>
        <div class="mainwrapsright">
        <?php echo $content['detail'][0]['Status'];?>
        </div>
      	<div class="clrs"></div>
        </div>
        
        <div class="clrs"></div>
        </div>	
       
        
<!--        <table id="mobile">
        <thead>
        <tr class="mr-tr-col-head">
              <th class="mr-col-head">Claim Number</th>
              <td class="mr-col-data"><?php echo $content['summeryDetail'][0]['CaseID'];?></td>
        </tr>
        <tr class="mr-tr-col-head">      
              <th class="mr-col-head">Name of Claimant</th>
              <td class="mr-col-data"><?php echo $content['summeryDetail'][0]['Claimant'];?></td>
            </tr>
        </thead>
        <tbody>
            <tr class="mr-tr-col-center">
              <td class="mr-col-head-lt bg-r-on">Insurer</td>
               <td class="mr-col-head-lt bg-r"><?php echo $_SESSION['customerName'];?></td>
            </tr>  
            <tr class="mr-tr-col-center"> 
              <td class="mr-col-head-rt bg-r-on">Claim Type</td>
              <td class="mr-col-head-rt bg-r"><?php echo $content['detail'][0]['CoverageType'];?></td>
            </tr>
            <tr>
              <td class="mr-col-head-lt bg-r-on">Date of Injury</td>
              <td class="mr-col-head-lt bg-r"><?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseLossDt']));?></td>
            </tr>
            <tr>
              <td class="mr-col-head-rt bg-r-on">Date of Referral</td>
              <td class="mr-col-head-rt bg-r"><?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseReferralDt']));?></td>
            </tr>
            <tr>
              <td class="mr-col-head-lt bg-r-on">Date records received</td>
              <td class="mr-col-head-lt bg-r"><?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseRecordsRecdDt']));?></td>
            </tr>  
            <tr>
              <td class="mr-col-head-rt bg-r-on">Date report was sent to adjuster</td>
              <td class="mr-col-head-rt bg-r"><?php echo date('m/d/Y', strtotime($content['detail'][0]['CaseFinalRptSubmitDt']));?></td>
            </tr>
            <tr>
              <td class="mr-col-head-lt bg-r-on">Status</td>
              <td class="mr-col-head-lt bg-r"><?php echo $content['detail'][0]['Status'];?></td>
            </tr>
          </tbody>
        
        
        </table>-->
        <div class="clr"></div>
        <a href="<?php echo site_url().'/case-summary/'?>" class="backbtn">Back to Case Summary</a>
        <input type="submit" class="admit_btn" value="Email This Report">
        
        
        <div class="clr"></div>
      </div>
    </div>
  </div>
</div>
	<div id="sidebar" style="<?php echo $sidebar_css; ?>">
		<div id="login-box" class="login-box">
			<?php
			if (is_user_logged_in()){
				 generated_dynamic_sidebar('avada-login');
			}
			?>
        </div>
	<?php dynamic_sidebar('avada-page-sidebar'); ?>
     
  	</div>
<?php get_footer(); ?>