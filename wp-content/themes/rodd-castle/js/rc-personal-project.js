jQuery(document).ready(function($) {

	//Ajax modal post content request
	$('a[rel="ajax:modal"]').click(function(event) {

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
				   $('body').append('<div class="modal"><p>'+response.the_title+'</p></div>');
				   console.log(response.project_images);
				   $('.modal').append(response.project_images[0]['url']);
					$('.modal').modal({
						fadeDuration: 500
					});
				   $('.modal-spinner').removeAttr('style');
					

					$('.modal').on($.modal.BEFORE_CLOSE, function(event, modal) {
					  $('.modal').remove();
					});   
				}
				else {
				   alert("Epic fail");
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