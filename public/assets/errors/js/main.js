(function($) {
	/* ======= Clear Default ====== */
	$.fn.clearDefault = function() {
		"use strict";
		return this.each(function() {
			var default_value = $(this).val();
			$(this).focus(function() {
				if ($(this).val() == default_value)
					$(this).val("");
			});
			$(this).blur(function() {
				if ($(this).val() == "")
					$(this).val(default_value);
			});
		});
	};

	/* ======= Height Fix ====== */
	function vertCenter(item) {
		"use strict";
		item.css({
			'margin-top' : '-' + parseInt((item.height() / 2), 0) + 'px'
		})
	}


	jQuery(document).ready(function($) {
		"use strict";
		var $subscr_form = jQuery('#subscribe');
		$subscr_form.submit(function() {
			$subscr_form.find('.error').remove();
			var hasError = false;
			var $form_field = $subscr_form.find('.requiredField');

			if (jQuery.trim($form_field.val()) == '') {
				$form_field.parent().append('<span class="error">You forgot to enter your email</span>');
				hasError = true;
			} else if ($form_field.hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if (!emailReg.test(jQuery.trim($form_field.val()))) {
					var labelText = $form_field.prev('label').text();
					$form_field.parent().append('<span class="error">You entered an invalid email</span>');
					$form_field.addClass('inputError');
					hasError = true;
				}
			}

			if (!hasError) {
				$subscr_form.fadeOut();
				var formInput = $(this).serialize();
				$subscr_form.slideUp("fast", function() {
					$(this).before('<div class="success">Thank you. Your email was sent successfully.</div>');
				});
				$.post($(this).attr('action'), formInput, function(data) {
					$subscr_form.slideUp("fast", function() {
						if($(this).parent().find('.success').length == 0)
							$(this).before('<div class="success">Thank you. Your email was sent successfully.</div>');
					});
				});
			}
			return false;
		});
		
		var $contList = $('.contact-list');
		$contList.submit(function() {
			$contList.find('.error').remove();
			var hasError = false;
			$contList.find('.requiredField').each(function() {
				if (jQuery.trim($(this).val()) == '') {
					$(this).parent().append('<span class="error">You forgot to enter your ' + label + '</span>');
					$(this).addClass('inputError');
					hasError = true;
				} else if ($(this).hasClass('email')) {
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if (!emailReg.test(jQuery.trim($(this).val()))) {
						var labelText = $(this).prev('label').text();
						$(this).parent().append('<span class="error">You entered an invalid email</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				}
			});
			if (!hasError) {
				$subscr_form.fadeOut();
				var formInput = $(this).serialize();
				$subscr_form.slideUp("fast", function() {
					$(this).before('<div class="success">Thank you. Your email was sent successfully.</div>');
				});
				$.post($(this).attr('action'), formInput, function(data) {
					$subscr_form.slideUp("fast", function() {
						$(this).before('<div class="success">Thank you. Your email was sent successfully.</div>');
					});
				});
			}
			return false;
		});

		$('.side-page').click(function() {
			var curPage = $(this).attr('id');
			$('.main-menu li').removeClass('active');
			$('.main-menu li a[data-page="' + curPage + '"]').parent().addClass('active');
			$('.side-page').removeClass('active').removeClass('went-left').removeClass('went-right');
			$(this).prev().addClass('side-left').addClass('went-left');
			$(this).next().addClass('side-right').addClass('went-right');
			$(this).addClass('active');
		});

		$('.main-menu a:not(.home-link)').click(function() {
			$('#clock').removeClass('active');
			$('.mainarea-content').addClass('active');
			$('.close').addClass('active');
			var curPage = $(this).attr('data-page');
			$('.main-menu li').removeClass('active');
			$(this).parent().addClass('active');
			$('.mainarea-content > div').removeClass('active').removeClass('went-left').removeClass('went-right');
			$('#' + curPage + '').prev().addClass('side-left').addClass('went-left');
			$('#' + curPage + '').next().addClass('side-right').addClass('went-right');
			$('#' + curPage + '').addClass('active');
		});

		$('.close').click(function(e) {
			e.preventDefault();
			$('#clock').addClass('active');
			$('.main-menu li').removeClass('active');
			$('.close').removeClass('active');
			$('.mainarea-content').removeClass('active');
		});

		$('.home-link').click(function(e) {
			e.preventDefault();
			$('#clock').addClass('active');
			$('.main-menu li').removeClass('active');
			$('.close').removeClass('active');
			$('.mainarea-content').removeClass('active');
			$('.home-link').parent().addClass('active');
		});

		$('input[type="text"]').clearDefault();

		vertCenter($('.itemwrap > li > div'));
		vertCenter($('#thumbs'));
		vertCenter($('#clock'));

		$('#tweet_list').cycle({
			fx : 'custom',
			cssBefore : {
				top : 50,
				height : 100,
				opacity : 0,
				display : 'block'
			},
			animIn : {
				top : 0,
				opacity : 1
			},
			animOut : {
				opacity : 0,
				top : -50
			},
			cssAfter : {
				zIndex : 0,
				display : 'none'
			},
			speed : 1750,
			sync : false,
			easeIn : 'easeOutBack',
			easeOut : 'easeInBack'
		});
	});
	
	function resizeStuff() {
		vertCenter($('.itemwrap > li > div'));
		vertCenter($('#thumbs'));
		vertCenter($('#clock'));
	}
	var onSmartResize = false;

	$(window).resize(function(){
		if(onSmartResize !== false)
			clearTimeout(onSmartResize);
		onSmartResize = setTimeout( function(){resizeStuff() }, 200); //200 is time in miliseconds
	});

})(jQuery);
