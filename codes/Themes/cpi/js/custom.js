jQuery(document).ready(function(){
var arrup = 'http://cpi.wsisrdev.com/wp-content/themes/cpi/images/arrow-up.png';
var arrup1 = '<img src='+arrup+' />';
var arrdown = 'http://cpi.wsisrdev.com/wp-content/themes/cpi/images/arrow-down.png';
var arrdown1 = '<img src='+arrdown+' />';
jQuery(".sidebar-menu #menu-sidebar-menu").accordion({
        accordion:true,
        speed: 500,
        closedSign: arrdown1,
        openedSign: arrup1
});
jQuery(".current-page-ancestor > span img").attr("src","http://cpi.wsisrdev.com/wp-content/themes/cpi/images/arrow-up.png");
jQuery(".current-menu-parent > span img").attr("src","http://cpi.wsisrdev.com/wp-content/themes/cpi/images/arrow-up.png");
jQuery(".current_page_item > span img").attr("src","http://cpi.wsisrdev.com/wp-content/themes/cpi/images/arrow-up.png");
jQuery('#pname').prop('readonly', true);
jQuery('#pname1').prop('readonly', true);
var tit = jQuery(".single-product .product_title").text(); 
jQuery("#pname").val(tit); 
jQuery("#pname1").val(tit); 
jQuery("div.holder").jPages({
        containerID  : "paginavid",
        perPage      : 12,
        startPage    : 1,
        startRange   : 1,
		previous: "Previous",
        next: "Next",
        midRange     : 6,
        endRange     : 1
});
jQuery(".indappmenuwrap").accordions({
        accordion:true,
        speed: 500,
        closedSign: arrdown1,
        openedSign: arrdown1
});
jQuery('body').append('<div class="scrollToTopButton"></div>');
jQuery(window).scroll(function() {
if (jQuery(this).scrollTop() > 500){
jQuery('.scrollToTopButton').fadeIn();
}
else{
jQuery('.scrollToTopButton').fadeOut();
}
});
jQuery('.scrollToTopButton').click(function() {
jQuery('html, body').animate({scrollTop: 0}, 800);
return false;
});
var i = 0;
jQuery("#sr-footer-btm-links .footer-bottom-widgets").attr('class', function() {
i++;
return 'footer-bottom-widgets widgets'+i;
});
jQuery(".widgets4").addClass("last");
var j = 0;
jQuery("footer .footer-top-widgets").attr('class', function() {
j++;
return 'footer-top-widgets widgets'+j;
});
var k = 0;
jQuery("#secondary .widget_text").attr('class', function() {
k++;
return 'widget widget_text widgets'+k;
});
jQuery(".widgets4").addClass("last");
jQuery('.resp-tabs-list li').each(function(i,el){
el.id = 'tabs'+i;
});
jQuery(window).scroll(function() {
resizeHeader();
});
jQuery(window).resize(function() {
resizeHeader();
sliderTops();
});
var windowWidth = jQuery(window).width();
if (windowWidth <= 1280) jQuery('body').addClass('resize-header');
});
function scrollto(target) {
	var headerheight = jQuery('nav').height() + jQuery('.headerwrap').height();
	var windowWidth = jQuery(window).width();
    var targetdiv = jQuery('.' + target);
	if(windowWidth < 600){
    jQuery('html, body').animate({
        scrollTop: targetdiv.offset().top - 20
    }, 1000);
}
else{
    jQuery('html, body').animate({
        scrollTop: targetdiv.offset().top - headerheight
    }, 1000);
}
}
function resizeHeader() {
   var scrollVal = jQuery(this).scrollTop();
   var windowWidth = jQuery(window).width();
   if (scrollVal > 50) jQuery('body').addClass('resize-header');
   else if (windowWidth > 1280) jQuery('body').removeClass('resize-header');
   else jQuery('body').addClass('resize-header');
}
function sliderTops() {
var windowWidth = jQuery(window).width();
var headerheight = jQuery('.headerwrap').height() - 10;
var headerheight1 = 0;	
if((windowWidth > 920) && (windowWidth < 1281)){
//jQuery("#sr-banner").css("margin-top",headerheight);
jQuery("#main").css("margin-top",headerheight);
}
else{
//jQuery("#sr-banner").css("margin-top",0);
jQuery("#main").css("margin-top",0);
}
}
function validateForm()
{
var x=document.forms["myForm"]["s"].value;
if (x==null || x=="")
  {
  alert("Search Parameter must be filled out");
  return false;
  }
}