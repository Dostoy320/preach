<?php 
$general->logged_out_protect();
include 'header.php'; 
?>

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

<script type="text/javascript" src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script type="text/javascript" src="scripts/tinymce.config.js"></script>
<script type="text/javascript" src="scripts/save.js"></script>



<?php include 'footer.php'; ?>