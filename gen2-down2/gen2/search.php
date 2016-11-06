<?php
session_start(); // Starting Session
include('datafetch.php');

$sstock = $_GET['stock'];
$sstock = strtoupper($sstock);
$_SESSION['sstock'] = $sstock;

header("location: http://www.genzfinancial.com/gen2/searched.php");   
?>

