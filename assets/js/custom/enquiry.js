jQuery(document).ready(function ($) {

	/* #input_1_2 - Email field from Enquiry Form */
	$(document).on('blur', 'input#input_1_2', function() {
		var email = $(this).val();

		// var post_id = jQuery(this).data('id');
		$.ajax({
			url : enquiryform.ajax_url,
			type : 'post',
			dataType: 'json',
			data : {
				action : 'enquiry_form_action',
				email : email
			},
			success : function( obj ) {
				if(obj.eemail) {
					/* Encrypted Inputs */
					$("#input_1_5").val(obj.etime); /* time */
					$("#input_1_6").val(obj.eemail);/* email */
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$('body').append('<div class="error-message"><p>status code: '+jqXHR.status+'</p><p>errorThrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p><div>'+jqXHR.responseText + '</div></div>');
			}
		});
	});

});