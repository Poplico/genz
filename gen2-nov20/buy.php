<?php
session_start();

$servername = "www.genzfinancial.com";
$username = "remotegenz";
$password = "password";
$dbname = "genz-info-user";
$buyinguser = $_SESSION['userID'];

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
	echo "error";
}
$info = "SELECT username FROM userlogin WHERE username = 'bestuser'";
$bank = mysqli_query($conn, $info);

$rows = mysqli_num_rows($bank); 

if ($rows == 1) {
    null;
} else {
	die("No user");
} 

/*$amount = (double)$_POST['quantity'];
$price = (double)$_SESSION['tradeamount'];
$name = $_SESSION['sstock'];
$totalprice = $price * $amount;
$made = 0;*/

$amount = (string)$_POST['quantity'];
$price = (string)$_SESSION['tradeAmount'];
$name = (string)$_SESSION['sstock'];
$totalprice = (double)$amount * (double)$price;
$bought = (string)$totalprice;
$made = "0";

$buyinguser = $_SESSION['userID'];

$purchase = "INSERT INTO ".$buyinguser."(symbol, quantity, spent, made)
VALUES ('$name', '$amount', '$totalprice', '$made')";

$doit = mysqli_query($conn, $purchase);


header("Location: http://www.genzfinancial.com/gen2/searched.php");

/*$cost = "INSERT INTO userlogin (bankaccount)
VALUES ('$bank')";*/


?>