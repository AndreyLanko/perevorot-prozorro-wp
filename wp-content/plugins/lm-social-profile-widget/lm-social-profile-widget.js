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
			 if (sc_type=='fb'){
			  link = 'http://www.facebook.com/sharer.php?s=100'+current_url+'&t=&src=sp';
			 } else if (sc_type=='tw'){
			  link = 'http://twitter.com/share?'+current_url+'&text='+title;
			 }
			else if (sc_type=='in'){
			  link = 'https://www.linkedin.com/shareArticle?url='+current_url+'&title='+title;
			 }	
			 else if (sc_type=='gp'){
			  link = 'https://plus.google.com/share?url='+current_url;
			 }
			 window.open(link,'displayWindow', 'width=600,height=400,left=300,top=200,location=no, directories=no,status=no,toolbar=no,menubar=no');
			return false;
		   });
		  }

		  share();
	});
})(jQuery);
