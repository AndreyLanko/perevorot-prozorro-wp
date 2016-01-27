(function($) {
$(document).ready( function(){
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
