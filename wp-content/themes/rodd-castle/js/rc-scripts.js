jQuery(document).ready(function($) {

	// Initialise slider
	$('.flexslider').flexslider({
		animation: "slide"
	});

	$('.icon_hover').hover(function() {
		$(this).animate({opacity: 1}, 400);
		$(this).prev('.icon').animate({opacity: 0}, 400);			
	}, function() {
		$(this).animate({opacity: 0}, 400);
		$(this).prev('.icon').animate({opacity: 1}, 400);	
	});

});