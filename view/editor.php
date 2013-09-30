<!DOCTYPE html>
<html lang='en'>
<head>
	<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<script>
	        tinymce.init({
	        	plugins: "save",
	        	toolbar: "save",
	        	save_enablewhendirty: false,
	        	selector:'textarea'});
	</script>
</head>


<body>
	<form action="../index.php" method="post" name="submit">
        <textarea id="blog_text" name="blog_text">Your content here.</textarea>
    </form>
</body>
</html>
