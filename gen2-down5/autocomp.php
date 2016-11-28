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
$query= $_REQUEST['term'];
$sql = "SELECT symbol from stocklist 
                  WHERE symbol
                  LIKE '".$query."%'
                  LIMIT 30";

$json = array();
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)){
      array_push($json, $row['symbol']);
    }

echo json_encode($json);

?>