<?php 
include 'header.php';
?>

<div id='main'>


<?php

if (strlen($content[1]) > 0) {
	echo "<div id='title'><h2>" . $content[1] . "</h2></div>";
}

echo $content[2];

if (strlen($content[3]) > 0) {
	$converted = date('F j Y, g:i a',strtotime($content[3]));
	echo "<br>Published: " . $converted;
}
?>


</div>

<?php
include 'footer.php';