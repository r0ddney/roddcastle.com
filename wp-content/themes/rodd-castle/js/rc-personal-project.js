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

					   console.log(response.project_images);

						for (var i = 0; i < response.project_images.length; i++) {
							$slides.append('<li><img src="'+response.project_images[i]['sizes']['project-image']+'" alt="'+response.project_images[i]['title']+'"></li>');
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
						
						$('#project_slider').flexslider();
						$('#project_slider').height($('.modal').height());

						function slowAlert() {
							$('.slides li').each( function() {
							    var height = $('#project_slider').height();
							    console.log(height);
							    var imageHeight = $(this).find('img').height();
							    var imageWidth = $(this).find('img').width();
							    console.log(imageHeight);

							    if (imageHeight > $('#project_slider').height()) {
							    	$(this).find('img').height($('#project_slider').height());
							    	$(this).find('img').css('width', 'auto');
							    } else {
							    	var offset = (height - imageHeight) / 2;

							    	$(this).css('margin-top', offset + 'px');
							    }

							});
						}

						var timeoutID = window.setTimeout(slowAlert, 500);

						$('.modal').on($.modal.BEFORE_CLOSE, function(event, modal) {
						  $('.modal').remove();
						  window.clearTimeout(timeoutID);
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