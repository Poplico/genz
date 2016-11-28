<?php
session_start(); // Starting Session
include('datafetch.php');

$_SESSION['q'] = $_POST['quantity'];
$ordered = array('1' => $_SESSION['sstock'], '2' => $_SESSION['q']);

if (isset($_SESSION['cart'])) {
    array_push($_SESSION['cart'], $ordered);
} else {
    $_SESSION['cart']=array();
    array_push($_SESSION['cart'], $ordered);
}
   
    
header("Location: http://www.genzfinancial.com/gen2/cart.php");
?>