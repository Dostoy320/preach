<?php 
include 'header.php';
?>

<div id='main'>


<?php

if (strlen($content[1]) > 0) {
	echo "<div id='title'><h3>" . $content[1] . "</h3></div>";
}

if (strlen($content[3]) > 0) {
	$converted = date('F j Y, g:i a',strtotime($content[3]));
	echo "<div id='publish_date'>Published: " . $converted . "</div>";
}

echo $content[2];



?>




</div>

<?php
include 'footer.php';