<?php
// Program to display complete URL 

$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']
    === 'on' ? "https" : "http") . "://" .
    $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

// Display the complete URL 
echo $link;
echo "<br>";
echo $_GET['token']; 
?>