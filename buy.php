<?php
session_start(); // Starting Session
include('datafetch.php');

$amount = $_POST['quantity'];
$price = 
$name = $_SESSION['sstock'];
$totalprice = $price * $amount;
$bank = $bank - $totalprice

$purchase = "INSERT INTO uname (symbol, quantity, spent, made)
VALUES ('$name', '$amount', '$totalprice', '//made')";

$cost = "INSERT INTO userlogin (bankaccount)
VALUES ('$bank');


//header("Location: http://www.genzfinancial.com/gen2/searched.php");


?>