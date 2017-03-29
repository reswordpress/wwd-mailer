(function( $ ) {
	'use strict';

	$(function() {

		var success_count = 0;
		var fail_count = 0;
		var _count = 0;

		$('#wwd-mailer-form').on('submit', function(e){

		  e.preventDefault();

		  sending_mail();

		  send_mail_batch();
	      
	    
	    });

	    function send_mail_batch() {

	      data = {};
	  
	      data = $("#wwd-mailer-form").serialize();

	      

	      data = data + '&count='+_count;
	      
	      $.post(
	           '/wp-admin/admin-ajax.php', 
	           data, 
	           function(response){
	              if(response.status === 1){
	              	console.log(response);
	              	success_count = $(".success-count").data('count');
	              	success_count = success_count + response.success_count;
		   	    	$(".success-count").html(success_count);
		   	    	$(".success-count").data('count',success_count);

		   	    	fail_count = $(".fail-count").data('count');
	              	fail_count = fail_count + response.fail_count;
		   	    	$(".fail-count").html(fail_count);
		   	    	$(".fail-count").data('count',fail_count);

		   	    	_count = $("#count-box").val();
			      	_count = Number(_count) + 100;
				    $("#count-box").val(_count);

		   	    	var ul = $('.emailed-list');

		   	    	$.each(response.messages,function(index,value){
					    console.log(value)
					    
					    $('ul.emailed-list').prepend('<li>'+value+'</li>');

					});

		   	    	send_mail_batch();

			      }else if(response.status === 2){

			      	$(".page-loader").html('Mailing finished!');
			      	$(".mailer-messaging h2").removeClass('page-loader');

			      }else{
			      	validate_fail();
			      }
	           },
	           'json'
	        );
	    }

	    function sending_mail(){
	    	$('#wwd-mailer-form').hide();
	    	$('html, body').animate({ scrollTop: 0 }, 'fast');
	    	$(".mailer-messaging").show();
			//$(".signingup").addClass('glyphicon glyphicon-refresh glyphicon-refresh-animate');
			//$(".signingup-text").html('Sending mail...');
		}
		
		function validate_fail(){
			alert
			$('#wwd-mailer-form').show();
		}

	});


})( jQuery );
