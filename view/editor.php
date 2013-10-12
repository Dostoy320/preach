<?php 
$general->logged_out_protect();
include 'header.php'; 
?>


<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({
        autosave_interval: "30s",
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        height: 400,
        width: 800,
        resize: "both",
       	save_enablewhendirty: false,
       	selector:'textarea'});
</script>
<script src="scripts/save.js"></script>

<body>
<div id='main'>
  <form action="index.php" method="post" id="submit_post">
  <input type="text" id='blog_title' name="blog_title" placeholder="Title (optional)" 
         value="<?php 
                if (strlen($content[1]) > 0)
                {
                  echo $content[1];
                }
                ?>">
  <input type="submit" name="action" value="submit post">
  <input type="button" name="save" id="save" value="save post">
  <textarea id="blog_text" name="blog_text"><?php echo $content[2]; ?></textarea>
  </form>
</div>
<div class="test"></div>



<?php include 'footer.php'; ?>