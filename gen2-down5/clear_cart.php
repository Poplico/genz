<?php
    session_start(); // Starting Session
    unset($_SESSION['cart']);
    header("Location: http://www.genzfinancial.com/gen2/cart.php");
?>