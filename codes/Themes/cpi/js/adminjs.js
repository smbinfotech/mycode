jQuery(document).ready(function(){
jQuery("#accordion h3:first").addClass("active");
jQuery("#accordion #acc-title").click(function(){
jQuery(this).next("#accordion #acc-content").slideToggle("slow").siblings("#accordion #acc-content:visible").slideUp("slow");
jQuery(this).toggleClass("active");
jQuery(this).siblings("h3").removeClass("active");
});
});
