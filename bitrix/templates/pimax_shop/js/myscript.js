window.jQuery = window.$ = jQuery;



/*-----------------------------------------------------------------------------------*/
/*	MENU
 /*-----------------------------------------------------------------------------------*/

var stickyMenu = false;
function fixTopMenu()
{
	if (jQuery(window).width() >= 768 && !stickyMenu){
		jQuery(".menu_block").sticky({ topSpacing: 0 });
		stickyMenu = true;
	}

	if ($(window).width() < 1024 && $('.menu_toggler').length <= 0){
		jQuery('.menu_block .container').prepend('<a href="javascript:void(0)" class="menu_toggler"><i class="fa fa-align-justify"></i></a>');
		jQuery('header .navmenu').hide();
		jQuery('.menu_toggler, .navmenu ul li a').click(function(){
			jQuery('header .navmenu').slideToggle(300);
		});

		jQuery(".navmenu").before('<div class="clear"></div>');
	} else if ($(window).width() >= 1024) {
		$('.menu_toggler').remove();
		jQuery('header .navmenu').show();
		jQuery(".navmenu").prev('.clear').remove();
	}
}

//MobileMenu
jQuery(document).ready(function() {


	fixTopMenu();

	$( window ).resize(function() {
		fixTopMenu();
	});
});






/*-----------------------------------------------------------------------------------*/
/*	SHOPPING BAG
 /*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	jQuery('.shopping_bag .cart').slideUp(1);
	jQuery('.shopping_bag_btn').click(function(){
		jQuery('.shopping_bag .cart').slideToggle();
		jQuery('.shopping_bag .cart').parent().toggleClass('cart_active');
	});
});





/*-----------------------------------------------------------------------------------*/
/*	TOP SEARCH FORM
 /*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	jQuery('.top_search_form form').slideUp(1);
	jQuery('.top_search_btn').click(function(){
		jQuery('.top_search_form form').slideToggle();
		jQuery('.top_search_form form').parent().toggleClass('form_active');
	});
});







/*-----------------------------------------------------------------------------------*/
/*	FLEXSLIDER
 /*-----------------------------------------------------------------------------------*/
jQuery(window).load(function(){
	//Top Slider
	$('.flexslider.top_slider').flexslider({
		animation: "fade",
		controlNav: true,
		directionNav: true,
		prevText: "",
		nextText: ""
	});

	//Top Slider BG
	jQuery('.flexslider.top_slider li img.slide_bg').each(function(){
		jQuery(this).parent().attr('style', 'background-image:url('+$(this).attr('src')+');');
	});


	//Tovar View Carousel
	/*$('#carousel2').flexslider({
		animation: "slide",
        animationLoop: true,
		controlNav: false,
		directionNav: true,
		prevText: "",
		nextText: "",
		animationLoop: false,
		slideshow: false,
		direction: "vertical",
		asNavFor: '#slider2'
	});
	$('#slider2').flexslider({
		animation: "slide",
        animationLoop: true,
		controlNav: false,
		directionNav: true,
		prevText: "",
		nextText: "",
		animationLoop: false,
		slideshow: false,
		sync: "#carousel2",
		after:function(slider) {
			$('.slider1 .flex-active-slide .elevatezoom').myElevateZoom();
		}
	});
	jQuery('#carousel2 .slides li').click(function(){
		$('#carousel2 .slides li').removeClass('flex-active-slide');
		$(this).addClass('flex-active-slide');


		return false;
	});

	setTimeout(function () {

		$('.slider1 .flex-active-slide .elevatezoom').myElevateZoom();

	}, 1000);*/



	//Article Slider
	$('.flexslider.article_slider').flexslider({
		animation: "fade",
		controlNav: true,
		directionNav: false,
		prevText: "",
		nextText: ""
	});


});









/*-----------------------------------------------------------------------------------*/
/*	IFRAME TRANSPARENT
 /*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	$("iframe").each(function(){
		var ifr_source = $(this).attr('src');
		var wmode = "wmode=transparent";
		if(ifr_source.indexOf('?') != -1) {
			var getQString = ifr_source.split('?');
			var oldString = getQString[1];
			var newString = getQString[0];
			$(this).attr('src',newString+'?'+wmode+'&'+oldString);
		}
		else $(this).attr('src',ifr_source+'?'+wmode);
	});
});









/*-----------------------------------------------------------------------------------*/
/*	MODAL TOVAR VIEW
 /*-----------------------------------------------------------------------------------*/
$(window).load(function() {
	(function(){
		var container = $( "#modal-body" );
		var $items = $('.open-project-link');
		index = $items.length;
		$('.open-project-link').click(function(){
			$('#modal-body').addClass('modal-active');
			if ($(this).hasClass('active')){
			}
			else {
				lastIndex = index;
				index = $(this).index();
				$items.removeClass('active');
				$(this).addClass('active');

				var time = new Date();


				var myUrl = $(this).find('.open-project').attr("href") + '&clear_cache=Y&time=' + time.getTime();// + " .tover_view_page";

				$('#tovar_content').html('');

				$('#tovar_content').animate({opacity:0},function(){

					$.ajax({
						url: myUrl
					}).done(function(data){


						$('#tovar_content').append('<div class="tover_view_page">' + data + '</div>');

						//Tovar View Carousel
						/*$('#carousel1').flexslider({
							animation: "slide",
							controlNav: false,
							directionNav: false,
							animationLoop: false,
							slideshow: false,
							direction: "vertical",
							asNavFor: '#slider1'
						});
						$('#slider1').flexslider({
							animation: "fade",
							controlNav: false,
							directionNav: false,
							animationLoop: false,
							slideshow: false,
							sync: "#carousel1"
						});

						jQuery('#carousel1 .slides li').click(function(){
							$('#carousel1 .slides li').removeClass('flex-active-slide');
							$(this).addClass('flex-active-slide');
							return false;
						});*/

						//fancySelect
						$('.basic').fancySelect();
						
						


					});



					$('#tovar_content').animate({opacity:1});
				});


				//Project Page Open
				$('#modal-body').show(function(){
					$('#tovar_content');}).show(2000,function(){
					$('.element_fade_in').each(function (){
						$(this).appear(function(){
							$(this).delay(100).animate({opacity:1,right:"0px"},1000);
						});
					});
				});
			} return false;
		});

		//Project Page Close
		$(document).on('click', '#tover_view_page_close, .close_block', function(event) {
			$('#tovar_content').animate({opacity:0}, 400,function(){
				$('#modal-body').removeClass('modal-active').hide(400);
			});

			$items.removeClass('active');
			return false;
		});
		
			// Escape close
		$('body').keyup(function(e){	
			
		    if(e.keyCode == 27){
		        // Close my modal window
		        
		        $('#tovar_content').animate({opacity:0}, 400,function(){
					$('#modal-body').removeClass('modal-active').hide(400);
				});
	
				$items.removeClass('active');
		    }
		});

	})();
});




/*-----------------------------------------------------------------------------------*/
/*	FANCYSELECT
 /*-----------------------------------------------------------------------------------*/
$(document).ready(function() {
	$('.basic').fancySelect();
});




/*-----------------------------------------------------------------------------------*/
/*	PARRALAX
 /*-----------------------------------------------------------------------------------*/
$(window).load(function() {
	if ($(window).width() > 1025){
		jQuery('.flexslider.top_slider .slides li').parallax("50%", -0.5);
		jQuery('.parallax').parallax("50%", -0.5);
	}

});



/*-----------------------------------------------------------------------------------*/
/*	SCROLL TOP
 /*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	$("a.back_top").click(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});
});



/*-----------------------------------------------------------------------------------*/
/*	TOVAR FOTO HEIGHT
 /*-----------------------------------------------------------------------------------*/
jQuery(window).load(function(){
	tovarfotoHeight();

});

jQuery(window).resize(function(){
	tovarfotoHeight();

});

function tovarfotoHeight()
{
	var maxHeight = 0;
	$('.tovar_img_wrapper img').each(function (index, val) {

		if ($(this).height() > maxHeight) {
			maxHeight = $(this).height();
		}
	});

	$('.tovar_img_wrapper').css('height', maxHeight);
}


/*-----------------------------------------------------------------------------------*/
/*	Tovar Sizes
 /*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	// toggle variable sizes of all elements
	$('#toggle-sizes').find('a.view_full').click(function(){
		$('a.view_box').removeClass('active');
		$(this).addClass('active');
		$('.shop_block').addClass('variable-sizes').isotope('reLayout');
		return false;
	});
	$('#toggle-sizes').find('a.view_box').click(function(){
		$('a.view_full').removeClass('active');
		$(this).addClass('active');
		$('.shop_block').removeClass('variable-sizes').isotope('reLayout');
		return false;
	});
});





/*-----------------------------------------------------------------------------------*/
/*	Tovar Sizes
 /*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	$('ul.tabs').on('click', 'li:not(.current)', function() {
		$(this).addClass('current').siblings().removeClass('current')
				.parents('div.tovar_information').find('div.box').eq($(this).index()).fadeIn(150).siblings('div.box').hide();
	})
});






/*-----------------------------------------------------------------------------------*/
/*	404 PAGE
 /*-----------------------------------------------------------------------------------*/
jQuery(window).load(function(){
	errorpageHeight();

});

jQuery(window).resize(function(){
	errorpageHeight();

});

function errorpageHeight() {
	if ($(window).width() > 1025){
		var body_h = $(window).height();
		var footer_h = $('footer').height() + 34;
		var errorpage_h = Math.abs(body_h - footer_h);
		$('.page404').css('min-height', errorpage_h);

		var wrapper404_h = $('.wrapper404').height() - 100;
		var padding_top = Math.abs((errorpage_h - wrapper404_h)/2);

		$('.wrapper404').css('padding-top', padding_top);
	}
}






/*-----------------------------------------------------------------------------------*/
/*	PRICE HOVER EFFECT
 /*-----------------------------------------------------------------------------------*/
$(document).ready(function() {
	$(".price_item").hover(
			function () {
				$(this).addClass("price_active");
			}
	);
	$(".price_item").hover(
			function () {
				$('.price_item').removeClass("price_active");
				$(this).addClass("price_active");
			}
	);
});



/*-----------------------------------------------------------------------------------*/
/*	ACCORDION TOGGLES
 /*-----------------------------------------------------------------------------------*/
$(document).ready(function(){

	$("#accordion h4").eq(2).addClass("active");
	$("#accordion .accordion_content").eq(2).show();

	$("#accordion h4").click(function(){
		$(this).next(".accordion_content").slideToggle("slow")
				.siblings(".accordion_content:visible").slideUp("slow");
		$(this).toggleClass("active");
		$(this).siblings("h4").removeClass("active");
	});

});



/*-----------------------------------------------------------------------------------*/
/*	VIDEO PLAYER
 /*-----------------------------------------------------------------------------------*/
$(document).ready(function(){
	$('.video_container').click(function(){
		var video = '<iframe src="'+ $(this).attr('data-video') +'"></iframe>';
		$(this).replaceWith(video); });
});



/*-----------------------------------------------------------------------------------*/
/*	OTHER SCRIPTS
 /*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {

	$('.product_sort .fancy-select li').click(function () {

		$(this).parent().parent().find('select').val($(this).data('raw-value'));
		$(this).parent().parent().parent().submit();

	});

	// elevate zoom

	$.fn.myElevateZoom = function () {
		$('.elevatezoom').removeData('elevateZoom');
		$('.zoomWrapper img.zoomed').unwrap();
		$('.zoomContainer').remove();

		$(this).elevateZoom({
			cursor: 'pointer',
			borderColour: '#000',
			imageCrossfade: false
		});
	};

	//$('.elevatezoom').myElevateZoom();


	// dropdown show

	$('.header__nav--menu-b').on('click', function() {
		$('.header__nav-center').toggle();
	});

	$('.icon-mobile-menu-collapse').on('click', function () {

		if ($(this).hasClass('icon-ld_accoridion_expand')) {
			$(this).parent().find('.menu-dropdown').slideDown();
			$(this).removeClass('icon-ld_accoridion_expand').addClass('icon-ld_accoridion_collapse');
			$(this).html('-');
		} else {
			$(this).parent().find('.menu-dropdown').slideUp();
			$(this).removeClass('icon-ld_accoridion_collapse').addClass('icon-ld_accoridion_expand');
			$(this).html('+');
		}

	});

	// Composite
	BX.addCustomEvent("onFrameDataReceived", BX.delegate(function(json) {

		// Fix shopping bag
		jQuery('.shopping_bag .cart').slideUp(1);
		jQuery('.shopping_bag_btn').click(function(){
			jQuery('.shopping_bag .cart').slideToggle();
			jQuery('.shopping_bag .cart').parent().toggleClass('cart_active');
		});


	}, this));
	
	
	$('#order-delivery-next').click(function () {
		
		if ($('#ID_DELIVERY_ID_23').is(':checked') || $('#ID_DELIVERY_ID_1').is(':checked')) 
		{
			
			$('#myModal').modal();
			
			
			
			$.post('/ajax/sendPhoneVerification/', {
				  phone: $('#data-phone-number').val()
			}).done(function( data ) {
				//alert( "Data Loaded: " + data );
				
				$('#phone-verification-get-new-code').show();
			});
						
			return false;
			
		}
		
		
		return true;
		
	});
	
	$('#phone-verification-get-new-code').click(function () {
		
		$('#phone-verification-get-new-code').hide();
		$.post('/ajax/sendPhoneVerification/', {
				  phone: $('#data-phone-number').val()
			})  .done(function( data ) {
				
				$('#phone-verification-alert').fadeOut("normal", function () {
				  
				  $('#phone-verification-get-new-code').show();
				  $('#phone-verification-alert').fadeIn("normal");
			  });
		});		
	});
	
	$('#btn-verification-phone').click(function () {
		
		$.post('/ajax/checkPhoneVerification/', {
				  code: $('#phone-verification-code').val()
			})  .done(function( data ) {
				
				if (data.status == 'success') {
					
					$('form[name="order_form"]').submit();
					
				} else {
					$('#phone-verification-error').show();
				}
		});	
		
	});
	
	
	$("#soa-property-3").mask("+7 (999) 999-9999");


});



