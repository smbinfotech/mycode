<?php /* Template Name: Case Summery */ ?>
<?php 
if (!is_user_logged_in()){
	wp_redirect(site_url().'/client-access/');
	exit;
}

session_start();

makeconnection();

get_header(); ?>
	<div id="content" style="<?php echo $content_css; ?>">
			<div class="post-content">
				
				<div id="tab-header">
         <div class="mr-tab-responsive">
              <div class="mr-tab-responsive-left">
               <h1>Client Access Portal</h1></div>
                <?php /* $current_user = wp_get_current_user(); ?>
                <div class="mr-tab-responsive-right">
                <p>Welcome <?php echo $current_user->user_login; ?>,</p>
                <?php echo do_shortcode('[wpmem_logout]'); ?>
                
                </div> <?php */ ?>
                <div class="clr"></div></div>
                <div class="clr"></div>
<div id="mr-article-1">
   <table id="desktop">
   <thead>
   <tr class="mr-tr-col-head mr-tr-lt-row">
   <th class="mr-col-head mr-tr-lt-dt">NAME OF THE CLAIM ADJUSTER</th>
   <th class="mr-col-head mr-tr-lt-dt">COMPANY NAME</th>
   <th class="mr-col-head mr-tr-lt-dt">NUMBER OF OPEN CLAIMS</th>
   </tr>
   <div class="clr"></div>
   <tr class="mr-tr-col-head mr-tr-rt-row">
   <th class="mr-col-data"><?php $user_id = get_current_user_id(); echo get_user_meta( $user_id, 'first_name', $single )." ".get_user_meta( $user_id, 'last_name', $single );?></th>
   <th class="mr-col-data"><?php echo $_SESSION['customerName'];?></th>
   <th class="mr-col-data"><?php echo CoutOpenCalim();?></th>
   </tr>
   </thead>
   </table>
   
   
   <div id="mobile" class="headmobile">
   <div class="mainwrapout headmobileout">        
		<div class="mainwrapin">
        <div class="mainwrapsleft">
        NAME OF THE CLAIM ADJUSTER
        </div>
        
        <div class="mainwrapsright">
        <?php $user_id = get_current_user_id(); echo get_user_meta( $user_id, 'first_name', $single )." ".get_user_meta( $user_id, 'last_name', $single );?>         
        </div>
        
        <div class="clrs"></div>
        </div>	
        
        
         <div class="mainwrapin">
        <div class="mainwrapsleft">
        COMPANY NAME
        </div>
        
        <div class="mainwrapsright">
       <?php echo $_SESSION['customerName'];?>
       </div>
        
        <div class="clrs"></div>
        </div>	
          
          
        <div class="mainwrapin">
        <div class="mainwrapsleft">
       NUMBER OF OPEN CLAIMS
        </div>
        
        <div class="mainwrapsright">
       <?php echo CoutOpenCalim();?>
       </div>
        
        <div class="clrs"></div>
        </div>	 
        
        
        
            
         <div class="clrs"></div>
         </div>
   
   
   <div class="clrs"></div>
   </div>
   
   
<!--   <table id="mobile">
   <thead>
   <tr class="mr-tr-col-head mr-tr-lt-row">
   <th class="mr-col-head mr-tr-lt-dt">NAME OF THE CLAIM ADJUSTER</th>
   <th class="mr-col-data"><?php $user_id = get_current_user_id(); echo get_user_meta( $user_id, 'contact', $single );?></th>
   </tr>
   <tr class="mr-tr-col-head mr-tr-lt-row">
   <th class="mr-col-head mr-tr-lt-dt">COMPANY NAME</th>
   <th class="mr-col-data"><?php echo $_SESSION['customerName'];?></th>
   </tr>
   <tr class="mr-tr-col-head mr-tr-rt-row">
   <th class="mr-col-head mr-tr-lt-dt">NUMBER OF OPEN CLAIMS</th>
   <th class="mr-col-data"><?php echo CoutOpenCalim();?></th>
   </tr>
   </thead>
   </table>-->
   
   <div class="clr"></div>
   <?php $case = $wp_query->query_vars['case'];?>
<div class="btn-tab">
    <ul class="tabbers">
    <li><a <?php if(!isset($case)||$case==""){  echo "class='btn-tab-ones-all'";}else {echo "class='btn-tab-ones'";}?>  href="<?php echo site_url()."/case-summary/";?>">All</a></li>
    <li><a <?php if(isset($case) && $case=="active"){  echo "class='btn-tab-ones-all'";} else {echo "class='btn-tab-ones'"; }?>  href="<?php echo site_url()."/case-summary/active/";?>">Active</a></li>
    <li><a <?php if(isset($case) && $case=="Closed"){  echo "class='btn-tab-ones-all'";}else {echo "class='btn-tab-ones'"; }?>  href="<?php echo site_url()."/case-summary/Closed/";?>">Closed</a></li>
     </ul>
</div>
<div class="clr"></div>
<table id="desktop"><thead class="col-dp-n">
			<tr class="mr-tr-col-head">
			<td class="mr-col-head caseno">Case Number</td>
            <td class="mr-col-head clname">Claiment Name</td>            
			<td class="mr-col-head datein">Date of Injury</td>
            <td class="mr-col-head daterf">Date of Refferral</td>            
            <td class="mr-col-head sr">Services Requested</td>
            <td class="mr-col-head status">Status</td>		
			</tr>	
		</thead>
		<tbody>
               <?php
				    //$case = $wp_query->query_vars['case'];		     
				    $content= wspCases($obj,$case);
			    ?>
		
		<?php 
		if(!empty($content)){
		  foreach($content as $row){ ?>                	
                <tr class="mr-tr-col-center">
                    <td class="bd-left-no">
					<?php $queryArray =array($row['CaseID'],$row['Claimant'],$row['CaseAnsNbr']);?>
                    <a href="<?php echo site_url()."/case-detail/".base64_encode(serialize($queryArray));?>"
                    class="createlog" ><?php echo $row['CaseAnsNbr'];?> 
                    </a>
                    </td>
                    <td><?php echo $row['Claimant'];?></td>
                    <td><?php echo date('m/d/Y', strtotime($row['CaseLossDt']));//$row['CaseLossDt'];?></td>
                    <td><?php echo date('m/d/Y', strtotime($row['CaseReferralDt']));?></td>                    
                    <td><?php echo $row['ServicesRequested'];?></td> 
                    <td><?php echo $row['Status'];?></td>                   
                </tr>
                <?php }
                }else{?>
                <tr class="mr-tr-col-center">
                    <td class="bd-left-no" colspan="5">No records found</td>                                     
                </tr>
                
                <?php }?>

 </tbody>
</table>



<?php
//$case = $wp_query->query_vars['case'];			     
$content= wspCases($obj,$case);	     
?>
<?php 
	if(!empty($content)){
?>
<div id="mobile">

<?php
		  foreach($content as $row){ ?>  
  <div class="mainwrapout">        
		<div class="mainwrapin firstwaps">
        <div class="mainwrapsleft">
        Case Number
        </div>
        
        <div class="mainwrapsright">
        <?php
		$queryArray =array($row['CaseID'],$row['Claimant']);?>
         <a href="<?php echo site_url()."/case-detail/".base64_encode(serialize($queryArray));?>"><?php echo $row['CaseAnsNbr'];?></a>
        </div>
        
        <div class="clrs"></div>
        </div>	
        
        
         <div class="mainwrapin">
        <div class="mainwrapsleft">
        Claiment Name
        </div>
        
        <div class="mainwrapsright">
       <?php echo $row['Claimant'];?>
        </div>
        
        <div class="clrs"></div>
        </div>	
          
          
        <div class="mainwrapin">
        <div class="mainwrapsleft">
        Date of Injury
        </div>
        
        <div class="mainwrapsright">
       <?php echo date('m/d/Y', strtotime($row['CaseLossDt']));//$row['CaseLossDt'];?>
        </div>
        
        <div class="clrs"></div>
        </div>	 
        
        
        <div class="mainwrapin">
        <div class="mainwrapsleft">
        Date of Refferral
        </div>
        
        <div class="mainwrapsright">
       <?php echo date('m/d/Y', strtotime($row['CaseReferralDt']));?>
        </div>
        
        <div class="clrs"></div>
        </div>	
          
          
        <div class="mainwrapin">
        <div class="mainwrapsleft">
        Services Requested
        </div>
        
        <div class="mainwrapsright">
       <?php echo $row['ServicesRequested'];?>
        </div>
        
        <div class="clrs"></div>
        </div>	
          
         <div class="mainwrapin">
        <div class="mainwrapsleft">
        Status
        </div>
        
        <div class="mainwrapsright">
       <?php echo $row['Status'];?>
        </div>
        
        <div class="clrs"></div>
        </div>	
            
         <div class="clrs"></div>
         </div>          
          
          
<!--        <table id="mobile">
                <tr class="mr-tr-col-center">
                    <td class="mr-col-head datascm theadsclass">Case Number</td>
                    <td class="bd-left-no datascm dataclass">
					 <?php $queryArray =array($row['CaseID'],$row['Claimant']);?>
                    <a href="<?php //echo site_url()."/case-detail/".base64_encode(serialize($queryArray));?>"><?php echo $row['CaseAnsNbr'];?></a>
					</td>
                </tr> 
                <tr class="mr-tr-col-center">   
                    <td class="mr-col-head datascm theadsclass">Claiment Name</td> 
                    <td class="dataclass datascm"><?php echo $row['Claimant'];?></td>
                </tr>
                <tr class="mr-tr-col-center">               
                    <td class="mr-col-head datascm theadsclass">Date of Injury</td>
                    <td class="dataclass datascm"><?php echo date('m/d/Y', strtotime($row['CaseLossDt']));//$row['CaseLossDt'];?></td>
                </tr>
                <tr class="mr-tr-col-center">   
                    <td class="mr-col-head datascm theadsclass">Date of Refferral</td>
                    <td class="dataclass datascm"><?php echo date('m/d/Y', strtotime($row['CaseReferralDt']));?></td>
                </tr> 
                <tr class="mr-tr-col-center">   
                    <td class="mr-col-head datascm theadsclass">Services Requested</td>
                    <td class="dataclass datascm"><?php echo $row['ServicesRequested'];?></td>
                </tr> 
                 
                <tr class="mr-tr-col-center last-tr-data">  
                    <td class="mr-col-head datascm theadsclass">Status</td>		
                    <td class="dataclass datascm"><?php echo $row['Status'];?>
                    </td>    
                </tr>	
				</table>-->
                <?php }
				?>

          <div class="clrs"></div>
          </div>
                <?php
                } else{?>
                <table id="mobile">
                <tr class="mr-tr-col-center">
                    <td class="bd-left-no" colspan="5">No records found</td>                                     
                </tr>
                 </tbody>
				</table>
                <?php }?>


	
</div><!--end of mr-article-1-->
</div><!--enf of tab-head-->
	</div>
    </div>
	<div id="sidebar" style="<?php echo $sidebar_css; ?>">
		<div id="login-box" class="login-box">
			<?php if (is_user_logged_in()){
				 generated_dynamic_sidebar('avada-login');
			} ?>
        </div>
	<?php dynamic_sidebar('avada-page-sidebar'); ?>
     
  	</div>
<?php get_footer(); ?>