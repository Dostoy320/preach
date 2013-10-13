$(document).ready(function() {

	var used = 1;
	$('input#save').click(function() {
	var blog_title = $('#blog_title').val();
	var blog_text = tinymce.get('blog_text').getContent();

	var dataString = 'action=save post&blog_text=' + blog_text + '&blog_title=' + blog_title + '&used=' + used;
	//alert (dataString); return false;

		$.ajax({
			type: "POST",
			url: "index.php",
			data: dataString,
			success: function() {
				$('input#save').after("<div id='conf_save'>Saved</div>");
				$("#conf_save").fadeOut(2000, function() {
					$(this).remove();
				});
			}
		});
	});
});