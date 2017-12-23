<?php
session_start(); // Starting Session

$servername = "www.genzfinancial.com";
$username = "s3liew";
$password = "admin";
$dbname = "genzaccess";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>