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

     $('a.reg-in-body').bind('click', function(event){
        event.preventDefault();
        $('.startpopup').css('display', 'block');
    });	
	    
    function init_event_calendar() {
        var _currentday = new Date().toString();
        var currentday = Date.parse(_currentday);
        $('.ai1ec-month-view td').has('div.ai1ec-date').each(function() {
            var href = $(this).find('.ai1ec-load-view').attr('href').split('~');
            var segments = href[2].split('/');
            var strdate = segments[0].split('.');

            if (strdate[0].length < 2) {strdate[0]='0'+strdate[0]}
            if (strdate[1].length < 2) {strdate[1]='0'+strdate[1]}

            var eventdate = Date.parse(strdate[0]+'/'+strdate[1]+'/'+strdate[2]);
            
            if (currentday > eventdate) {                
                $(this).closest('td').addClass('pastday');
            }
        });        
        $(".ai1ec-event-title").each(function() {
            var after = $(this).nextAll('.ai1ec-event-time:first');
            if(after[0] !== undefined)                
                $(this).before($(after)); 
        });   
    }
  
    views_correct_oneday_calendar();   
    views_correct_week_calendar();
    init_event_calendar();
    
    $("#ai1ec-calendar-view-loading").attrchange({
        trackValues: true, /* Default to false, if set to true the event object is 
                    updated with old and new value.*/
        callback: function (event) {
            if(event.newValue == "display: none;") {                  
                init_event_calendar();    
                views_correct_oneday_calendar();     
                views_correct_week_calendar(); 
                views_correct_week_calendar();       
            } 
            //event               - event object
            //event.attributeName - Name of the attribute modified
            //event.oldValue      - Previous value of the modified attribute
            //event.newValue      - New value of the modified attribute
            //Triggered when the selected elements attribute is added/updated/removed
        }        
    });
    function views_correct_oneday_calendar(){
        var conteiner = $('.ai1ec-oneday-view');
        var colorset = new Array('#8fd785','#6dc8eb','#f1febd','#fee3bd','#d2d4fd','#a3f5fc');
        var i = 0;
        conteiner.find('a.ai1ec-event-container.ai1ec-popup-trigger').each(function() {
           $(this).css('background',colorset[i]).css('margin-left',i*15+'px');
           i++;
        });
    }
    function views_correct_week_calendar(){
        var conteiner = $('.ai1ec-week-view');
        var colorset = new Array('#8fd785','#6dc8eb','#f1febd','#fee3bd','#d2d4fd','#a3f5fc');
        var conteinerwidth = conteiner.width();
        var tdwidth = Math.floor(conteinerwidth/7);

        conteiner.find('.tablescroll_head').css('width',conteinerwidth-45+'px');
        conteiner.find('td').each(function(){
            var j = 0;
            $(this).find('a.ai1ec-event-container.ai1ec-popup-trigger').each(function() {
               $(this).css('background',colorset[j]).css('margin-left',j*10+'px');
               j++;
               if (j>5) {
                    j=0
                };
            });
        });        
    }

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
