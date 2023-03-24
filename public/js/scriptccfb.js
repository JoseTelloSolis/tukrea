/*  Table of Contents 
01. MENU ACTIVATION
02. Search Toggle on Mobile
03. Slider Hide/Show Next/Previous on Slider
04. prettyPhoto Activation
05. FITVIDES RESPONSIVE VIDEOS
06. MOBILE SELECT MENU
07. HOVER FOR ICONS

*/


/*
=============================================== 01. MENU ACTIVATION  ===============================================
*/

jQuery(document).ready(function(){
	jQuery("ul.sf-menu").supersubs({ 
	        minWidth:    4,   // minimum width of sub-menus in em units 
	        maxWidth:    25,   // maximum width of sub-menus in em units 
	        extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
	                           // due to slight rounding differences and font-family 
	    }).superfish({ 
			animation: {height:'show'},   // slide-down effect without fade-in 
			autoArrows:    false,               // if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance 
			dropShadows:   false,               // completely disable drop shadows by setting this to false 
			delay:     400               // 1.2 second delay on mouseout 
		});
		
		
		jQuery("ul.sf-menu2").supersubs({ 
	        minWidth:    4,   // minimum width of sub-menus in em units 
	        maxWidth:    25,   // maximum width of sub-menus in em units 
	        extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
	                           // due to slight rounding differences and font-family 
	    }).superfish({ 
			animation: {height:'show'},   // slide-down effect without fade-in 
			autoArrows:    false,               // if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance 
			dropShadows:   false,               // completely disable drop shadows by setting this to false 
			delay:     400               // 1.2 second delay on mouseout 
		});
});



/*
=============================================== 02. Search Toggle on Mobile  ===============================================
*/
jQuery(document).ready(function($){
$(".search-icon").click(function () {
  if ($('.searchform').is('.searchform2')) {
      $('.searchform').removeClass('searchform2');

  }
  else{

      $('.searchform').addClass('searchform2');
  }

$(".search-icon").toggleClass("search-icon2");


});

});



/*
=============================================== 03. Slider Hide/Show Next/Previous on Slider  ===============================================
*/
/* View/Hide Slider Arrows */
jQuery(window).load(function() {
    jQuery("#main .flexslider .flex-direction-nav li").hide();
    jQuery("#main .flexslider").hover( 
        function(){ 
			jQuery("#main .flexslider .flex-direction-nav li").stop(true, true).fadeIn(400); 
		},
        function(){ 
			jQuery("#main .flexslider .flex-direction-nav li").fadeOut(200); 
		}
    );
});






/*
=============================================== 04. prettyPhoto Activation  ===============================================
*/
jQuery(document).ready(function(){
		jQuery("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'fast', /* fast/slow/normal */
			slideshow: 5000, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: false, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			default_width: 500,
			default_height: 344,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			horizontal_padding: 20, /* The padding on each side of the picture */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: false, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			deeplinking: false, /* Allow prettyPhoto to update the url to enable deeplinking. */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			ie6_fallback: true,
			social_tools: '' /* html or false to disable  <div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div> */
		});
});


/*
=============================================== 05. FITVIDES RESPONSIVE VIDEOS  ===============================================
*/
jQuery(document).ready(function($) {  
$("#main").fitVids();
$(".flexslider").fitVids();
});


/*
=============================================== 06. MOBILE SELECT MENU  ===============================================
*/
jQuery(document).ready(function($) {
$('.sf-menu').mobileMenu({
    defaultText: 'Navigate to...',
    className: 'select-menu',
    subMenuDash: '&ndash;&ndash;'
});
$('.filter-products .option-filter-prod').mobileMenu({
    defaultText: 'Navigate to...',
    className: 'select-menu',
    subMenuDash: '&ndash;&ndash;'
});


$('.sf-menu2').mobileMenu({
    defaultText: 'Navigate to...',
    className: 'select-menu2',
    subMenuDash: '&ndash;&ndash;'
});
});



/*
=============================================== 07. HOVER FOR ICONS  ===============================================
*/
jQuery(document).ready(function($) {  
    $(".zoom-icon").hide();
    $(".item-container-image").hover( 
        function(){ 
			$(this).children(".zoom-icon").stop(true, true).fadeIn('fast'); 
		},
        function(){ 
			$(this).children(".zoom-icon").fadeOut('fast'); 
		}
    );
});



