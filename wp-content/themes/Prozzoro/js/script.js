(function($) {
$(document).ready( function(){
    
    function init_event_calendar() {
         $('.ai1ec-month-view td').has('div.ai1ec-event').attr("style","background-color:#8fd785 !important");
        var block = $('.ai1ec-event-title');
        var after = block.nextAll('.ai1ec-event-time:first');
        if(after[0] == undefined)
            return;
        $(block).before($(after));       
    }

    init_event_calendar();
    
    $("#ai1ec-calendar-view-loading").attrchange({
        trackValues: true, /* Default to false, if set to true the event object is 
                    updated with old and new value.*/
        callback: function (event) {
            if(event.newValue == "display: none;") {
                init_event_calendar();
            } 
            //event               - event object
            //event.attributeName - Name of the attribute modified
            //event.oldValue      - Previous value of the modified attribute
            //event.newValue      - New value of the modified attribute
            //Triggered when the selected elements attribute is added/updated/removed
        }        
    });

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

    var offset = 220;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });
    
    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    });

     var topset = $(document).height()- 2*($(window).height());
     jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() < (topset+200)) {
            jQuery('.go-down').fadeIn(duration);
        } else {
            jQuery('.go-down').fadeOut(duration);
        }
    });
     var do_action = false;
    jQuery('.go-down').click(function(event) {
        if(do_action)return;
        do_action=true;
        event.preventDefault();
        jQuery('html, body').animate({scrollTop:(jQuery(document).scrollTop() + $(window).height())}, duration, function(){do_action=false;});
        return false;
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
