<?php
session_start();
include('datafetch.php');

$total = 0;
$buyinguser = $_SESSION['userID'];

$hist = "SELECT symbol, quantity, at
FROM $buyinguser
WHERE symbol IN 
	(SELECT symbol
    FROM $buyinguser
    GROUP BY symbol)";

$retval = "SELECT symbol , SUM(quantity) as 'totalQuant'
FROM $buyinguser
GROUP BY symbol";

$la = "SELECT symbol, at
FROM $buyinguser 
WHERE id IN (SELECT MAX(id) FROM $buyinguser WHERE NOT spent = '0' GROUP BY symbol) 
GROUP BY symbol
ORDER BY symbol";

$a = mysqli_query($conn, $la);
$q = mysqli_query($conn, $retval);
$h = mysqli_query($conn, $hist);

$hi = array();

while($row = mysqli_fetch_assoc($h)){
	$hi[] = $row;
}

$p = array();
while($row = mysqli_fetch_assoc($a)){
	$p[] = $row;
}

$port = array();
while($row = mysqli_fetch_assoc($q)){
    $port[] = $row;
}

foreach($port as $key => $value){
    if($value['totalQuant'] == 0) {
        unset($port[$key]);
    }
};

foreach($port as $key => $val){
    $url = 'http://finance.google.com/finance/info?client=ig&q='.$val['symbol'].'&format=JSON';
    $content = file_get_contents($url);
    $final = str_replace(["//","[","]"],"",$content);
    $json = json_decode($final, true);
	$port[$key]['at']=str_replace( ',', '', $json['l']);
    $port[$key]['totalPrice'] = $port[$key]['totalQuant'] * $port[$key]['at'];
}

$total = array_sum(array_column($port,'totalPrice'));
?>
