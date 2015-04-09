var example=jQuery.noConflict();
var jsonObj=null;
jQuery(document).ready(function(){
 /*jQuery("#state").on("change",function(e){	
	    jQuery("#eq_div").show();
		var state = jQuery(this).val();
		//var text = jQuery(this).text();		
		jQuery.post(ajax_object.ajaxurl, {
			action: 'meta_filter',
			state:state						
			}, function(data) {
					jQuery("#viv_meta_content").empty().html(data);				
			}); 
	}); */
	
	jQuery("#state").on("change",function(e){	
	    jQuery("#eq_div").show();
		//var state = jQuery(this).val();		
		jQuery("#type_of_equipment").prop('selectedIndex',0);
	}); 
	
	jQuery("#type_of_equipment").on("change",function(e){
		
		
		var url = window.location.pathname;	    
	    var res = url.split("/");
	    var index = res.length -2;
	    var sub_cat = res[index];
	    jQuery("#sub_cat").val(sub_cat);
		
	    var state = jQuery("#state").val();
		var equipment_type = jQuery(this).val();
		var tex_type = jQuery("#tex_type").val();		
		if(jQuery(this).val()!=""){
		 jQuery("#filter_form").submit();
		}
		/*
		jQuery.post(ajax_object.ajaxurl, {
			action: 'meta_filter',
			state:state,
			equipment_type:equipment_type,		
			tex_type:tex_type,
			sub_cat: sub_cat		
		}, function(data) {			
			   if(data==1){
				   jQuery("#viv_meta_content").empty().html("No product found");
			   }else{
				jQuery("#viv_meta_content").empty().html(data);
			   }
		});  
		*/
		
		
     });
	
	jQuery("#esupply_state").on("change",function(e){		
		var url = window.location.pathname;	    
	    var res = url.split("/");
	    var index = res.length -2;
	    var sub_cat = res[index];	    
	    
	    jQuery("#sub_cat").val(sub_cat);
		
		//var state = jQuery(this).val();
		//var tex_type = jQuery("#tex_type").val();	
		if(jQuery(this).val()!=""){
           jQuery("#filter_form").submit();
		}
		/*
		jQuery.post(ajax_object.ajaxurl, {
			action: 'meta_filter_supply',
			state:state,				
			tex_type:tex_type,
			sub_cat: sub_cat		
		}, function(data) {			
			   if(data==1){
				   jQuery("#viv_meta_content").empty().html("No product found");
			   }else{
				jQuery("#viv_meta_content").empty().html(data);
			   }
		});  */
     });
	
	
}); // end of ready



