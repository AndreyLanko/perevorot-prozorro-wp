(function($) {
$(document).ready( function(){

    $('a.registration').bind('click', function(event){
        event.preventDefault();
        $('.startpopup').css('display', 'block');
    });
     $('.close-startpopup').bind('click', function(event){
        event.preventDefault();
        $('.startpopup').css('display', 'none');
    });

    
    function init_event_calendar() {
        $('.ai1ec-month-view td').has('div.ai1ec-event').has('div.ai1ec-date').each(function() {
            var href = $(this).find('a').attr('href').split('~');
            var segments = href[2].split('/');
            var eventdate = Date.parse(segments[0]);
            var _currentday = new Date().toString();
            var currentday = Date.parse(_currentday);
            if (eventdate < currentday)
               $(this).attr('style','background-color:rgba(143, 215, 133, 0.5)  !important');   
            else
               $(this).attr('style','background-color:rgba(143, 215, 133, 1)  !important');        
        });

        var block = $('.ai1ec-event-title');
        $(".ai1ec-event-title").each(function() {
            var after = $(this).nextAll('.ai1ec-event-time:first');
            if(after[0] !== undefined)                
                $(this).before($(after)); 
        });
              
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


})
})(jQuery);
