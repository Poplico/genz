<?php
session_start(); // Starting Session
include('datafetch.php');

$sstock = $_GET['stock'];
$sstock = strtoupper($sstock);
$_SESSION['sstock'] = $sstock; /*Variable stored for the WIDGETS*/

$url = 'http://finance.google.com/finance/info?client=ig&q='.$sstock.'&format=JSON';
$content = file_get_contents($url);
$final = str_replace(["//","[","]"],"",$content);
$json = json_decode($final, true);

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
    $_SESSION['validSymbol'] = true;
    $_SESSION['symbol'] = $json['t'];
    $_SESSION['tradeAmount'] = str_replace( ',', '', $json['l']);;
    $_SESSION['tradeTime'] = $json['lt_dts'];
    $_SESSION['openAmount'] = $json['e'];
    $_SESSION['dayHigh'] = "N/A";
    $_SESSION['dayLow'] = "N/A";
    $_SESSION['company'] = $json['e'];
    if (strtolower($_SESSION['company']) == "cve") {
        $_SESSION['validSymbol'] = false;
    } else if (strtolower($_SESSION['company']) == "lon") {
        $_SESSION['validSymbol'] = false;
    }
    
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
 
header("location: http://www.genzfinancial.com/gen2/searched.php");   
?>

