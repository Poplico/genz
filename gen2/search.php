<?php
session_start(); // Starting Session
include('datafetch.php');

$sstock = $_GET['stock'];
$sstock = strtoupper($sstock);
$_SESSION['sstock'] = $sstock; /*Variable stored for the WIDGETS*/

$url = 'https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol='.$sstock.'&interval=1min&apikey=GGLPDK2Y3VI8ARPF';
$content = file_get_contents($url);
$json = json_decode($content, true);

if ($content === false){
    $_SESSION['validSymbol'] = false;
    $_SESSION['symbol'] = "N/A";
    $_SESSION['tradeAmount'] = "N/A";
    $_SESSION['tradeTime'] = "N/A";
    $_SESSION['openAmount'] = "N/A";
    $_SESSION['dayHigh'] = "N/A";
    $_SESSION['dayLow'] = "N/A";
    $_SESSION['company'] = "N/A";
} else {
    $time = $json['Meta Data']['3. Last Refreshed'];
    $_SESSION['validSymbol'] = true;
    $_SESSION['symbol'] = $json['Meta Data']['2. Symbol'];
    $_SESSION['tradeAmount'] = $json['Time Series (1min)'][$time]['4. close'];
    $_SESSION['tradeTime'] = $time;
    $_SESSION['openAmount'] = "N/A";
    $_SESSION['dayHigh'] = "N/A";
    $_SESSION['dayLow'] = "N/A";
    $_SESSION['company'] = $sstock;
}

/*$apicall = file_get_contents('https://ws.cdyne.com/delayedstockquote/delayedstockquote.asmx/GetQuote?StockSymbol='.$sstock.'&LicenseKey=0');
$xml = simplexml_load_string($apicall);
if ($xml === false){
    $_SESSION['validSymbol'] = false;
    $_SESSION['symbol'] = "N/A";
    $_SESSION['tradeAmount'] = "N/A";
    $_SESSION['tradeTime'] = "N/A";
    $_SESSION['openAmount'] = "N/A";
    $_SESSION['dayHigh'] = "N/A";
    $_SESSION['dayLow'] = "N/A";
    $_SESSION['company'] = "N/A";
} else {
    $_SESSION['validSymbol'] = true;
    $_SESSION['symbol'] = (string)$xml->StockSymbol;
    $_SESSION['tradeAmount'] = (string)$xml->LastTradeAmount;
    $_SESSION['tradeTime'] = (string)$xml->LastTradeDateTime;
    $_SESSION['openAmount'] = (string)$xml->OpenAmount;
    $_SESSION['dayHigh'] = (string)$xml->DayHigh;
    $_SESSION['dayLow'] = (string)$xml->DayLow;
    $_SESSION['company'] = (string)$xml->CompanyName;
}*/



/*$apicall = file_get_contents('https://ws.cdyne.com/delayedstockquote/delayedstockquote.asmx/GetQuote?StockSymbol='.$sstock.'&LicenseKey=0');
$xml = simplexml_load_string($apicall);
if ($xml === false){
    $_SESSION['validSymbol'] = false;
    $_SESSION['symbol'] = "N/A";
    $_SESSION['tradeAmount'] = "N/A";
    $_SESSION['tradeTime'] = "N/A";
    $_SESSION['openAmount'] = "N/A";
    $_SESSION['dayHigh'] = "N/A";
    $_SESSION['dayLow'] = "N/A";
    $_SESSION['company'] = "N/A";
} else {
    $_SESSION['validSymbol'] = true;
    $_SESSION['symbol'] = (string)$xml->StockSymbol;
    $_SESSION['tradeAmount'] = (string)$xml->LastTradeAmount;
    $_SESSION['tradeTime'] = (string)$xml->LastTradeDateTime;
    $_SESSION['openAmount'] = (string)$xml->OpenAmount;
    $_SESSION['dayHigh'] = (string)$xml->DayHigh;
    $_SESSION['dayLow'] = (string)$xml->DayLow;
    $_SESSION['company'] = (string)$xml->CompanyName;
}*/
 
header("location: http://www.genzfinancial.com/gen2/searched.php");   
?>

