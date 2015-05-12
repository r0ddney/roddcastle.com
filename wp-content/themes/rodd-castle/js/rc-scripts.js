jQuery(document).ready(function($) {

	
	if( !$('body').hasClass('single') ) {
		var scrolled = false;
		if ($(window).scrollTop() > 135 && $(window).width() > 1006){  
			console.log($(window).width());
			console.log($(window).scrollTop());
			if (scrolled == false) {
				$('.site-header').animate({backgroundColor: '#333333'}, 400);
			}			
			scrolled = true;
		}
		else{
			//console.log($(this).scrollTop());
			if (scrolled == true) {
				$('.site-header').animate({backgroundColor: "transparent"}, 400);
				scrolled = false;
			}
		}

		//Invisible navbar
		$(window).scroll(function() {
			if ($(this).scrollTop() > 135 && $(window).width() > 1006){  
				console.log($(window).width());
				if (scrolled == false) {
					$('.site-header').animate({backgroundColor: '#333333'}, 400);
				}			
				scrolled = true;
			}
			else{
				//console.log($(this).scrollTop());
				if (scrolled == true) {
					$('.site-header').animate({backgroundColor: "transparent"}, 400);
					scrolled = false;
				}
			}
		});
	}

	//Navbar mobile color
	if ($(window).width() <= 1006) {
		$('.site-header').css('background-color', '#333333');
	}
	$(window).resize(function(event) {
		//if ($(window).width() <= 1006) {
			$('.site-header').css('background-color', '#333333');
		//}
	});

	// Initialise slider
	$('#main_slider').flexslider({
		animation:"slide",
		easing: "easeInOutCubic",
		animationSpeed: 1000,
		pauseOnHover: true
	});

	//Icon hover styles
	$('.button').hover(function() {
		$(this).parent().prevAll('.icons').children('.icon_hover').animate({opacity: 1}, 400);
		$(this).parent().prevAll('.icons').children('.icon').animate({opacity: 0}, 400);
		$(this).parent().prevAll('h2').animate({color: '#FECC17'}, 400);			
	}, function() {
		$(this).parent().prevAll('.icons').children('.icon_hover').animate({opacity: 0}, 400);
		$(this).parent().prevAll('.icons').children('.icon').animate({opacity: 1}, 400);
		$(this).parent().prevAll('h2').animate({color: '#333333'}, 400);
	});

	//Project hover styles
	var black = '#333333';
	var grey_lighter = '#F2F2F2';
	var yellow = '#FECC17';
	var modalVisible = $('.jquery-modal').length;

	console.log($('.jquery-modal').length);
	if ( $('.jquery-modal').length == 0 ) {

	}

	$('[rel="ajax:modal"]').hover(function() {

		modalVisible = $('.jquery-modal').length;

		if (modalVisible == 0) {
			$(this).parents('.entry-header').css('background-color', black);
			$(this).parents('.entry-header').prev('.alignnone').children('.expand-container').animate({opacity: 1}, 400);
		}

	}, function() {
		$(this).parents('.entry-header').css('background-color', grey_lighter);
		$(this).parents('.entry-header').prev('.alignnone').children('.expand-container').animate({opacity: 0}, 400);
	});

	function cssObject(property, value) {
		var cssObjectString = '{' + property + ': ' + value + '}';
		return cssObjectString;
	}

	$('.expand-container').hover(function() {

		modalVisible = $('.jquery-modal').length;

		if (modalVisible == 0) {
			$(this).animate({opacity: 1}, 400);
			$(this).parent().next('.entry-header').animate({backgroundColor: "#333333"}, 400);
			$(this).parent().next('.entry-header').children('.entry-title').children('a').css('color', yellow);
		}

	}, function() {
		$(this).animate({opacity: 0}, 400);
		$(this).parent().next('.entry-header').animate({backgroundColor: "#F2F2F2"}, 400);
		$(this).parent().next('.entry-header').children('.entry-title').children('a').removeAttr('style');
	});

	//Project prevent categories click
	$('.entry-categories a').click(function(event) {
		event.preventDefault();
	});

	//Social icons
	$( 'ul.cnss-social-icon li img' ).unbind( "hover" );
	$( 'ul.cnss-social-icon li img' ).hover(function() {
		$(this).animate({backgroundColor: "#FECC17", borderColor: "#FECC17"}, 400);
	}, function() {
		$(this).animate({backgroundColor: "transparent", borderColor: "white"}, 400);
	});
	
});