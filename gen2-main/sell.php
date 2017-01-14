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
$price = (string)$_SESSION['tradeAmount'];
$name = (string)$_SESSION['sstock'];
$totalprice = (double)$amount * (double)$price;
$bought = (string)$totalprice;
$made = "0";
$sold = -1 * abs($_POST['quantity']);

$buyinguser = $_SESSION['userID'];

$purchase = "INSERT INTO ".$buyinguser."(symbol, quantity, at, spent, made)
VALUES ('$name', '$sold', '$price', '$made', '$totalprice')";

$balance = "SELECT balance FROM userlogin WHERE username = '$buyinguser'";
$result = mysqli_query($conn, $balance);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $remaining = $row['balance'];
}
$newbal = $remaining + $totalprice;
$fbal = number_format((float)$newbal, 2, '.', '');

$update = "UPDATE userlogin 
SET balance='$fbal'
WHERE username='$buyinguser'";
$sql = "SELECT quantity from ".$_SESSION['userID']." 
                  WHERE symbol
                  LIKE '".$_SESSION['sstock']."%'
                  LIMIT 30";
$val = mysqli_query($conn, $sql);
$tab = array();

while($row = mysqli_fetch_array($val)){
    array_push($tab, $row['quantity']);
}
$stockQuant = array_Sum($tab);

if ($stockQuant - $absAmount < 0) {
    header("location: http://www.genzfinancial.com/gen2/searched.php"); 
    $_SESSION['error'] = true;
    $_SESSION['error_msg'] = "Insufficent shares to SELL";
	die("Insufficient stock units");
}

$again = mysqli_query($conn, $update);
$_SESSION['balance'] = $fbal;
$doit = mysqli_query($conn, $purchase);

header("location: http://www.genzfinancial.com/gen2/searched.php"); 
/*$cost = "INSERT INTO userlogin (bankaccount)
VALUES ('$bank')";*/


?>