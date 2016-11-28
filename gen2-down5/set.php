<?php
session_start();

$servername = "www.genzfinancial.com";
$username = "remotegenz";
$password = "password";
$dbname = "genz-info-user";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
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

$subuser = $_SESSION['userID'];

$balance = "SELECT balance FROM userlogin WHERE username = '$subuser'";
    $result = mysqli_query($conn, $balance);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $remaining = $row['balance'];
    $fbal = number_format((float)$remaining, 2, '.', '');
    $_SESSION['balance'] = $fbal;
    }  

?>