<?php
// Funksjon  for anti-sql injection
function mPostCleaner($tag) {
    $clean = trim($_POST["$tag"]);
    $clean = strip_tags($clean);
    $clean = htmlspecialchars($clean);
    return $clean;
} 


?>

