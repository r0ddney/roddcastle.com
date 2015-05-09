jQuery(document).ready(function($) {

	//Ajax modal post content request
	$('a[rel="ajax:modal"]').click(function(event) {

		console.log($(window).width());
		if( $(window).width() > 1006 ) {

			var post_id = $(this).attr("data-post_id");
			console.log(post_id);

			$('body').append('<div class="modal-spinner" style="display: block;"></div>');

			jQuery.ajax({
				type : "post",
				dataType : "json",
				url : rcAjax.ajaxurl,
				data : {action: "rc_personal_project", post_id : post_id},
				success: function(response) {
					if(response.type == "success") {
					   //jQuery("#vote_counter").html(response.vote_count)
					   var $modal = $('<div class="modal"></div>');
					   var $two_thirds = $('<div class="two-thirds"></div>');
					   var $flexslider = $('<div id="project_slider" class="flexslider"></div>');
					   var $slides = $('<ul class="slides"></ul>');
					   var $one_third = $('<div class="one-third"></div>');

					   $('body').append($modal);

					   console.log(response);

						for (var i = 0; i < response.project_images.length; i++) {
							var orientation;
							if(response.project_images[i]['height'] > response.project_images[i]['width'] || response.project_images[i]['height'] == response.project_images[i]['width']) {
								orientation = "portrait";
							} else {
								orientation = "landscape";
							}
							$slides.append('<li><img class="'+orientation+'" src="'+response.project_images[i]['sizes']['project-image']+'" alt="'+response.project_images[i]['title']+'"></li>');
						};
					   $flexslider.append($slides);
					   $two_thirds.append($flexslider);

					   $one_third.append('<h4 class="widget-title">'+response.the_title+'</h4>');
					   $one_third.append('<p>'+response.project_info+'</p>');
					   $one_third.append('<p class="project-meta icon-date">'+response.project_date+'</p>');
					   $one_third.append('<p class="project-meta icon-tools">'+response.project_tools+'</p>');

					   $modal.append($two_thirds);
					   $modal.append($one_third);

						$modal.modal({
							fadeDuration: 500
						});
						$('.modal').height($(window).height()/1.1);
					   $('.modal-spinner').removeAttr('style');
						
						$('#project_slider').flexslider({
							slideshow: false,
							animationSpeed: 1000
						});
						$('#project_slider, .modal .two-thirds').height($('.modal').height());
						$('.modal .one-third').height($('.modal').height()-30);

						function slowAlert() {
							$('#project_slider .slides li').load().each( function() {
							    var height = $('#project_slider').height();
							    console.log(height);
							    var imageHeight = $(this).find('img').load().height();
							    var imageWidth = $(this).find('img').load().width();
							    console.log(imageHeight);

							    if (imageHeight > $('#project_slider').height()) {
							    	$(this).find('img').load().height($('#project_slider').height());
							    	$(this).find('img').load().css('width', 'auto');
							    } else {
							    	var offset = (height - imageHeight) / 2;

							    	$(this).load().css('margin-top', offset + 'px');
							    }

							});
						}

						//var timeoutID = window.setTimeout(slowAlert, 500);

						$('.modal').on($.modal.BEFORE_CLOSE, function(event, modal) {
						  $('.modal').remove();
						  //window.clearTimeout(timeoutID);
						});   
					}
					else {
					   console.log("fail");
					}
				}
			});

			// $.ajax({

			// 	url: $(this).attr('href'),

			// 	success: function(newHTML, textStatus, jqXHR) {
			// 	  $(newHTML).appendTo('body').modal();
			// 	},

			// 	error: function(jqXHR, textStatus, errorThrown) {
			// 	  // Handle AJAX errors
			// 	}

			// 	// More AJAX customization goes here.

			// });

			return false;

		} //if( $(window).width() > 768 )

	});


	// jQuery(".user_vote").click( function() {
 //      post_id = jQuery(this).attr("data-post_id")
 //      nonce = jQuery(this).attr("data-nonce")

 //      jQuery.ajax({
 //         type : "post",
 //         dataType : "json",
 //         url : myAjax.ajaxurl,
 //         data : {action: "my_user_vote", post_id : post_id, nonce: nonce},
 //         success: function(response) {
 //            if(response.type == "success") {
 //               jQuery("#vote_counter").html(response.vote_count)
 //            }
 //            else {
 //               alert("Your vote could not be added")
 //            }
 //         }
 //      })   

 //   })

});