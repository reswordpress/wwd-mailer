(function( $ ) {
	'use strict';

	$(function() {

		var data = {};
	  
		/*$('#wwd-mailer-form-list').on('submit', function(e){

		  e.preventDefault();

		  sending_mail();

		  save_list();
	    
	    });*/

	    function save_list() {

	      data = $("#wwd-mailer-form-list").serialize();
	      
	      $.post(
	           '/wp-admin/admin-ajax.php', 
	           data, 
	           function(response){
	              if(response.status === 1){
	              	console.log(response);
	              	$('#wwd-mailer-form-list').show();
	              	$(".mailer-messaging h2").text('List added!');	
	              	$(".mailer-messaging h2").removeClass('page-loader');		
	              	$("#list-name").val('');
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
	    	$(".mailer-messaging h2").text('Saving list...');
	    	$(".mailer-messaging h2").addClass('page-loader');		
		}
		
		function validate_fail(){
			$('#wwd-mailer-form-list').show();
			$('.mailer-errors').show();
			$(".mailer-messaging").hide();
		}

	});


})( jQuery );
