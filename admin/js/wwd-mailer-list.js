(function( $ ) {
	'use strict';

	$(function() {

		var data = {};
	  
		$('#wwd-mailer-form-list').on('submit', function(e){

		  e.preventDefault();

		  sending_mail();

		  save_list();
	    
	    });

	    function save_list() {

	      data = $("#wwd-mailer-form-list").serialize();
	      
	      $.post(
	           '/wp-admin/admin-ajax.php', 
	           data, 
	           function(response){
	              if(response.status === 1){
	              	console.log(response);
	              	

			      }else{
			      	validate_fail(response);
			      }
	           },
	           'json'
	        );
	    }

	    function sending_mail(){
	    	$('#wwd-mailer-form-list').hide();
	    	$('html, body').animate({ scrollTop: 0 }, 'fast');
	    	$(".mailer-messaging").show();			
		}
		
		function validate_fail(){
			$('#wwd-mailer-form-list').show();
			$('.mailer-errors').show();
			$(".mailer-messaging").hide();
		}

	});


})( jQuery );
