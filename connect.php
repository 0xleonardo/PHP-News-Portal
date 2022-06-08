<?php
header('Content-Type: text/html; charset=utf-8');

$servername = "localhost:3307";
$username = "root";
$password = "";
$basename = "franceinfo";

$dbc = mysqli_connect($servername, $username, $password, $basename) or 
    die('Error connecting to database.'.mysqli_error());
mysqli_set_charset($dbc, "utf8");

?>