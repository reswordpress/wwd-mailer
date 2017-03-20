(function( $ ) {
	'use strict';

	$(function() {

		$('#wwd-mailer-form').on('submit', function(e){

		  e.preventDefault();

		  data = {};
	  
	      //signingup();
	      data = $("#wwd-mailer-form").serialize();
	      
	      $.post(
	           '/wp-admin/admin-ajax.php', 
	           data, 
	           function(response){
	              console.log(response);
	           },
	           'json'
	        );
	      
	    
	    });

	});


})( jQuery );
