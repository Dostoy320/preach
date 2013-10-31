$(document).ready(function() {



	// Populate recent posts list in sidebar.
	function listRecent(recent) {
		postList = $('#recentPosts');
		postList.empty();
		for (x in recent) {
			// Name post "Untitled" if no title present.
			if (recent[x].title == "") {
				title = "Untitled";
			}
			else {
				title = recent[x].title;
			}
			postList.append("<li value='" + recent[x].id +
				"'><a href='#'>" + title + "</a></li>");
		}
	};

	listRecent(recent_list);


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
	$('#recentPosts').on("click", "li", function() {
		var post_id = $(this).attr('value');
		// Create string to send via POST.
		var dataString = 'action=retrieve_post&post_id=' + post_id;
		$('#popup').fadeIn(100);

		// Get value Yes/No from confirmation
		$('#popup input').click(function() {
			load_choice = $(this).attr('value');
			$('#popup input').unbind('click');
			if (load_choice == "Yes") {
				// Send post_id via ajax to index.php to retrieve selected post.
				$.ajax({
					type: "POST",
					url: "index.php",
					data: dataString,
					dataType: 'json',
					success: function(data) {
						$('#popup').fadeOut(100);
						$('#submit').prop('disabled', true);
						$('#blog_title').val(data.title);
						tinymce.get('blog_text').setContent(data.content);
						retrieved_id = data.id;
						return retrieved_id;
					}
				});
			}
			else {
				$('#popup').fadeOut(100);
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