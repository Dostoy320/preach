<?php include 'header.php'; ?>


<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({
       	plugins: "preview",
        toolbar: "preview",
        autosave_interval: "30s",
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        height: 400,
        width: 800,
        resize: "both",
       	plugins: "save",
       	toolbar: "save",
       	save_enablewhendirty: false,
       	selector:'textarea'});
</script>

<body>
<div id='main'>
	<form action="index.php" method="post" id="submit_post">
	<input type="hidden" name="action" value="submit_post">
        <textarea id="blog_text" name="blog_text">Your content here.</textarea>
    </form>
</div>
</body>
</html>

<?php include 'footer.php'; ?>