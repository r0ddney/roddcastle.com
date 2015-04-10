jQuery(document).ready(function($) {

	// Initialise slider
	$('.flexslider').flexslider({
		animation: "slide"
	});

	$('.icon').hover(function() {
		$(this).fadeOut('400', function() {
			
		});
		$(this).next('.icon_hover').fadeIn('400', function() {
			
		});
	}, function() {
		/* Stuff to do when the mouse leaves the element */
	});

});