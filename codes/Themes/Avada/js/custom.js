var example=jQuery.noConflict();
var jsonObj=null;
jQuery(document).ready(function(){	
		
	jQuery(".admit_btn").on("click",function(){		
		//console.log(mydata);
		jQuery(this).val("sending....");
		jQuery(this).attr('disabled','disabled');
		var mydata = jQuery( "#dataarray" ).data();		
		console.log(mydata);
		jQuery.post(ajax_object.ajaxurl, {
			action: 'reportMailer',
			claimno:mydata.claimno,
			claimant:mydata.claimant,
			claimtype:mydata.claimtype,
			dateinjury:mydata.dateinjury,
			daterecordreceived:mydata.daterecordreceived,
			datereferral:mydata.datereferral,
			insurer:mydata.insurer,
			recordsenttoadjuster:mydata.recordsenttoadjuster,
			status:mydata.status			
			}, function(data) {				
				alert("Report has been sent to your email address."); 
				jQuery(".admit_btn").val("Email This Report");
				jQuery(".admit_btn").removeAttr('disabled');
			});		
	})
	
	
	/*jQuery(".createlog").on("click",function(e){
		e.preventDefault();
		var link = jQuery(this).attr('href');
		var text = jQuery(this).text();		
		jQuery.post(ajax_object.ajaxurl, {
			action: 'createLog',
			claimno:text						
			}, function(data) {
				window.open(link,'_blank');
      			//window.location.href = link;
			});
	}); */
	
});



