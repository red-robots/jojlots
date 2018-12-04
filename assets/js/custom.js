/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {


	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	var $all_oembed_videos = $("iframe[src*='youtube']");
	
	$all_oembed_videos.each(function() {
	
		$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 	});
	
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});

	$(document).on("click",".gallery-thumbnail",function(e){
		e.preventDefault();
		var parent = $(this).parents('li');
		$("ul.galleries li").removeClass("current");
		parent.addClass('current');
		var imgSrc = $(this).attr('href');
		$("img.loader").fadeIn();
		setTimeout(function(){
			$("img.loader").fadeOut("fast");
		},620);
		setTimeout(function(){
			$(".bigpic").attr('style','background-image:url("'+imgSrc+'")');
		},600);
		$('.mainpic').attr('src',imgSrc);
	});
	

	/*
	*
	*	Smooth Scroll to Anchor
	*
	------------------------------------*/
	$('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
	    if (
	      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
	      && 
	      location.hostname == this.hostname
	    ) {
	      // Figure out element to scroll to
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	      // Does a scroll target exist?
	      if (target.length) {
	        // Only prevent default if animation is actually gonna happen
	        event.preventDefault();
	        $('html, body').animate({
	          scrollTop: target.offset().top
	        }, 1000, function() {
	          // Callback after animation
	          // Must change focus!
	          var $target = $(target);
	          $target.focus();
	          if ($target.is(":focus")) { // Checking if the target was focused
	            return false;
	          } else {
	            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
	            $target.focus(); // Set focus again
	          };
	        });
	      }
	    }
	});


	/*
	*
	*	Nice Page Scroll
	*
	------------------------------------*/
	$(function(){	
		$("html").niceScroll();
	});
	
	
	/*
	*
	*	Equal Heights Divs
	*
	------------------------------------*/
	$('.js-blocks').matchHeight();

	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();

});// END #####################################    END
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