<?php
session_start();
$buyinguser = $_SESSION['userID'];
include('datafetch.php');

$info = "SELECT username FROM userlogin WHERE username = '$buyinguser'";
$bank = mysqli_query($conn, $info);

$rows = mysqli_num_rows($bank); 

if ($rows == 1) {
    null;

} else {
    header("location: http://www.genzfinancial.com/gen2/landing/login.php"); 
    die("No user");
} 

/*$amount = (double)$_POST['quantity'];
$price = (double)$_SESSION['tradeamount'];
$name = $_SESSION['sstock'];
$totalprice = $price * $amount;
$made = 0;*/
$absAmount = abs($_POST['quantity']);
$amount = $absAmount;
$price = $_SESSION['tradeAmount'];
$name = (string)$_SESSION['sstock'];
$totalprice = abs((double)$amount) * $price;
$bought = (string)$totalprice;
$made = "0";

$balance = "SELECT balance FROM userlogin WHERE username = '$buyinguser'";
$result = mysqli_query($conn, $balance);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $remaining = $row['balance'];
}
$newbal = $remaining - $totalprice;

if ($newbal < 0) {
    header("location: http://www.genzfinancial.com/gen2/searched.php"); 
    $_SESSION['error'] = true;
    $_SESSION['error_msg'] = "Insufficent funds to BUY";
    die("No money");
} else {
    null;
}

$purchase = "INSERT INTO ".$buyinguser."(symbol, quantity, at, spent, made)
VALUES ('$name', '$amount', '$price', '$totalprice', '$made')";

$doit = mysqli_query($conn, $purchase);


$fbal = number_format((float)$newbal, 2, '.', '');

$another = "UPDATE userlogin 
SET balance='$fbal'
WHERE username='$buyinguser'";

$again = mysqli_query($conn, $another);
$_SESSION['balance'] = $fbal;

header("location: http://www.genzfinancial.com/gen2/searched.php"); 
/*$cost = "INSERT INTO userlogin (bankaccount)
VALUES ('$bank')";*/


?>