(function($) {
$(document).ready( function(){
	$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        450:{
            items:2,
            nav:true
        },
        767:{
            items:3,
            nav:true
        },
        991:{
            items:6,
            nav:true,
            loop:false
        }
    }
	});

	jQuery('#scrollup').click( function(){
		window.scroll(0 ,0); 
		return false;
	});

	jQuery(window).scroll(function(){
		if ( jQuery(document).scrollTop() > 0 ) {
			jQuery('#scrollup').fadeIn('slow');
		} else {
			jQuery('#scrollup').fadeOut('slow');
		}
	});



})
})(jQuery);
