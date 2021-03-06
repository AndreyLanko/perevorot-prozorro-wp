(function($) {
	$(document).ready( function(){
		function share(){ 
		   var link = '';
		   var title ='Prozorro';
		   var current_url = window.location.href;
		   var sc_type='fb';
		   $('ul.share a').click(function(){
			 sc_type = $(this).attr('data-type');
			 title  = ($(this).attr('data-title'))?$(this).attr('data-title'):title;
			 current_url = ($(this).attr('data-href'))?$(this).attr('data-href'):current_url;
			 $.ajax({
			 	url: window.location.href,
			 	type: "post",
			 	data: {
			 		actionSocial: 'updateCount',
			 		type: sc_type,
			 		post_id: $(this).attr('data-item'),
			 		current_url: current_url
			 	},
			 	success: function(json_response) {
			 		var response = $.parseJSON(json_response);
			 		if (response.success) {
			 			if (sc_type=='fb'){
						  link = 'http://www.facebook.com/sharer.php?u='+current_url+'&t='+title+'&src=sp';
						 }
						else if (sc_type=='tw'){
						  link = 'http://twitter.com/share?'+current_url+'&text='+title;
						 }
						else if (sc_type=='in'){
						  link = 'https://www.linkedin.com/shareArticle?url='+current_url+'&title='+title;
						 }	
						else if (sc_type=='vk'){
						  link = 'http://vkontakte.ru/share.php?url='+current_url+'&title='+title;
						 }	
						else if (sc_type=='gp'){
						  link = 'https://plus.google.com/share?url='+current_url+'&title='+title;
						 }
						 window.open(link,'displayWindow', 'width=600,height=400,left=300,top=150,location=no, directories=no,status=no,toolbar=no,menubar=no');
			 		}
			 	}
			 });
			
			return false;
		   });
		  }

		  share();
	});
})(jQuery);
