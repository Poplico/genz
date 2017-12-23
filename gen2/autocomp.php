<?php
session_start();
include('datafetch.php');


$query= $_REQUEST['term'];
$sql = "SELECT symbol from stocklist 
                  WHERE symbol
                  LIKE '".$query."%'
                  LIMIT 50";

$json = array();
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)){
      array_push($json, $row['symbol']);
    }

echo json_encode($json);

?>