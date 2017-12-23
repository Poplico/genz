<?php
session_start();
include('datafetch.php');

$sql = "SELECT quantity from ".$_SESSION['userID']." 
                  WHERE symbol
                  LIKE '".$_SESSION['sstock']."%'
                  LIMIT 30";
$sp = "SELECT spent from ".$_SESSION['userID'];
$ma = "SELECT made from ".$_SESSION['userID'];

/* Total the quantity*/
$val = mysqli_query($conn, $sql);
$tab = array();
while($row = mysqli_fetch_array($val)){
    array_push($tab, $row['quantity']);
}
$stockQuant = array_Sum($tab);

/* Total the spent*/
$spa = mysqli_query($conn, $sp);
$spTab = array();
while($row = mysqli_fetch_array($spa)){
    array_push($spTab, $row['spent']);
}
$totalSpend = array_Sum($spTab);

/* Total the made*/
$mad = mysqli_query($conn, $ma);
$maTab = array();
while($row = mysqli_fetch_array($mad)){
    array_push($maTab, $row['made']);
}
$totalMade = array_Sum($maTab);

/* Total the value of current stocks*/

$curVal = $totalSpend - $totalMade;

$subuser = $_SESSION['userID'];

$balance = "SELECT balance FROM userlogin WHERE username = '$subuser'";
    $result = mysqli_query($conn, $balance);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $remaining = $row['balance'];
    $fbal = number_format((float)$remaining, 2, '.', '');
    $_SESSION['balance'] = $fbal;
    }  


?>