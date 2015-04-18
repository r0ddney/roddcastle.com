jQuery(document).ready(function($) {

	// Initialise slider
	$('.flexslider').flexslider({
		animation: "slide"
	});

	//Icon hover styles
	$('.icon_hover').hover(function() {
		$(this).animate({opacity: 1}, 400);
		$(this).prev('.icon').animate({opacity: 0}, 400);			
	}, function() {
		$(this).animate({opacity: 0}, 400);
		$(this).prev('.icon').animate({opacity: 1}, 400);	
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

	//Instagram height
	//$( 'ul.cnss-social-icon li img' ).unbind( "hover" );
	
});