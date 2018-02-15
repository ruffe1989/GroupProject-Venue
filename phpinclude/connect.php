<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "utested";

$con=mysqli_connect($server, $user, $password, $db);
$con->set_charset('utf8');
if(!$con) {
    exit('Error: could not establish database connection');
} //else echo "Connected";
// endre denne til noe mer brukervennlig?
?>