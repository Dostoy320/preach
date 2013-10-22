<?php
$general->logged_out_protect();
include 'header.php';
?>

<body>

<!-- Confirmation popup for recent posts on sidebar -->
<div id='popup'>
  <p>Edit post?</p>
  <input type="submit" class="popup" value="Yes">
  <input type="submit" class="popup" value="No">
</div>

<div id='main'>
  <form action="index.php" method="post" id="submit_post">
    <input type="text" id='blog_title' name="blog_title"
          placeholder="Title (optional)"
          value="<?php
                  if (strlen($saves[1]) > 0)
                  {
                    echo $saves[1];
                  }
                  ?>">
    <input type="submit" name="action" id="submit" value="submit post">
    <input type="button" name="save" id="save" value="save post">
    <input type="button" name="new_post" id="new_post" value="new post">
    <textarea id="blog_text" name="blog_text"><?php echo $saves[2]; ?></textarea>
  </form>

  <div id='sidebar'>
  <h4>Recent Posts</h4>
    <ul id="recentPosts">
      <?php
      foreach($recent as $ordered) {
        if ($ordered[title] == "") {
          $title = "Untitled";
        }
        else {
          $title = $ordered[title];
        }
        echo "<li value='".$ordered[id]."'><a href='#'>" . $title . "</a></li>";
      }
      ?>
  </div>
</div>

<?php print_r($post); ?>

<script type="text/javascript" src="//tinymce.cachefly.net/4.0/tinymce.min.js">
</script>
<script type="text/javascript" src="scripts/tinymce.config.js"></script>
<script type="text/javascript" src="scripts/save.js"></script>



<?php include 'footer.php'; ?>