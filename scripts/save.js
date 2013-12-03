$(document).ready(function() {



	// Populate recent posts list in sidebar.
	function listRecent(recent) {
		postList = $('#recentPosts');
		postList.empty();
		for (x in recent) {
			// Name post "Untitled" if no title present.
			if (recent[x].title == "") {
				title = recent[x].datetime;
			}
			else {
				title = recent[x].title;
			}
			postList.append("<li><div class='list_link' value='" + recent[x].id + 
				"'><a href='#'><div id='post_type'>" + recent[x].type + "</div>" + title + "</a></div><div id='post_delete' value='" +
				recent[x].id + "'>X</div></li>");
		}
	};

	listRecent(recent_list);

	/******
	Clicking the "submit post" button gives the choice of destination,
	then sends the current title and text to a new row	in the table.
	******/

	// On click show popup with destination choices.
	$('input#submit').click(function() {
		$('#submit_choice').fadeIn(200);
		});

		// Remove choice popup on submit and send via ajax
		$('#submit_choice input[type=button]').click(function() {
			var confirm = $(this).val();
			if (confirm == 'Cancel') {
				$('#submit_choice').fadeOut(200);
			} else {
			$('#submit_choice').fadeOut(200);
			var destination = $('#submit_choice select').val();
			var blog_title = $('#blog_title').val();
		  // encodeURIComponent() handles special characters passed via $_POST.
		  var blog_text = encodeURIComponent(tinymce.get('blog_text').getContent());

		  var dataString = 'action=submit post&blog_text=' + blog_text + '&blog_title='
		  				+ blog_title + '&blog_type=' + destination;

		  $.ajax({
		  	type: "POST",
		  	url: "index.php",
		  	contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		  	data: dataString,
		  	dataType: "json",
		  	success: function(data) {
		  		$('#submit_complete').fadeIn(200).delay(1000).fadeOut(400);
					listRecent(data); // Populate post lists with title changes.
					$('#blog_title').val("");
					tinymce.get('blog_text').setContent("");
		  	}
		 });
		}
	});


	/******
	Clicking the "save post" button assigns title and text fields to variables.
	These variables are sent via ajax to save to the database.
	*******/


	var retrieved_id = 0;

	$('input#save').click(function() {
		// Display "Saved" alert
		$('input#save').after("<div id='conf_save'>Saved</div>");

		if (retrieved_id != 0) {
			var blog_id = retrieved_id;
		}
		else {
			var blog_id = 1;
		}

	    var blog_title = $('#blog_title').val();
	    // encodeURIComponent() handles special characters passed via $_POST.
	    var blog_text = encodeURIComponent(tinymce.get('blog_text')
	    				.getContent());

	    var dataString = 'action=save post&blog_id=' + blog_id + '&blog_text='
	    				 + blog_text + '&blog_title=' + blog_title;

		    $.ajax({
			    type: "POST",
			    url: "index.php",
			    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			    data: dataString,
			    dataType: 'json',
			    success: function(data) {
			    	recent = data;
				    listRecent(data); // Populate post lists with title changes.
				    // Remove "Saved" alert.
				    $("#conf_save").fadeOut(2000, function() {
					    $(this).remove();
				    });
			    }
		    });
	    });


	/******
	Clicking recently saved posts fires a confirmation popup.
	On confimation, the clicked post's id is sent via ajax.
	Title and Content are returned via json and used to fill the editor.
	******/

	// Get post ID and load confirmation popup when post is clicked in sidebar.
	
	var runner = function() {
		var post_id = $(this).attr('value');
		// Create string to send via POST.
		var dataString = 'action=retrieve_post&post_id=' + post_id;
		// Create edit options for clicked post
		$(this).parent().animate({height: '+=30px'});
		$(this).parent().append(
										"<div class='conf'>Edit Post</div>" +
										 "<div class='cancel'>Cancel</div>"
										);
		$('.conf').slideDown(200);
		$('.cancel').slideDown(200);
		$('#recentPosts').off("click");

		// Remove edit options and retrieve post via ajax
		$('.conf').click(function() {
			$('#recentPosts').on("click", ".list_link", runner);
			$('#recentPosts').bind('click');
			$('.conf').slideUp(200);
			$('.cancel').slideUp(200);
			$(this).parent().animate({height: '-=30px'});
			$('.conf').remove();
			$('.cancel').remove();
				// Send post_id via ajax to index.php to retrieve selected post.
				$.ajax({
					type: "POST",
					url: "index.php",
					data: dataString,
					dataType: 'json',
					success: function(data) {
						$('#submit').prop('disabled', true);
						$('#blog_title').val(data.title);
						tinymce.get('blog_text').setContent(data.content);
						retrieved_id = data.id;
						return retrieved_id;
					}
				});
			});
		// Remove edit options on Cancel
		$('.cancel').click(function() {
			$('#recentPosts').on("click", ".list_link", runner);
			$('.conf').slideUp(200);
			$('.cancel').slideUp(200);
			$(this).parent().animate({height: '-=30px'});
			$('.conf').remove();
			$('.cancel').remove();
		});
	}

	$('#recentPosts').on("click", ".list_link", runner);



	/******
	Clicking "del" fires a confirmation popup.
	On confirmation, the post is deleted.
	******/
		// Get post ID when delete icon is clicked
		$('#recentPosts').on("click", "#post_delete", function() {
		var post_id = $(this).attr('value');
		// Create string to send via POST.
		var dataString = 'action=delete_post&post_id=' + post_id;
		$('#del_popup').fadeIn(100);

		// Get value Yes/No from confirmation
		$('#del_popup input').click(function() {
			load_choice = $(this).attr('value');
			$('#del_popup input').unbind('click');
			if (load_choice == "Yes") {
				// Send post_id via ajax to index.php.
				$.ajax({
					type: "POST",
					url: "index.php",
					data: dataString,
					dataType: 'json',
					success: function(data) {
						$('#del_popup').fadeOut(100);
				    listRecent(data); // Populate post lists with title changes.
					}
				});
			}
			else {
				$('#del_popup').fadeOut(100);
			}
		})
	});

	// New post button clears title and editor fields and enables submit.
	$('input#new_post').click(function() {
		$('#blog_title').val("");
		tinymce.get('blog_text').setContent("");
		$('#submit').prop('disabled', false);
	})

});