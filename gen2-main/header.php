<?php
session_start(); // Starting Session
include('datafetch.php');
include('set.php');
?>

<body>
    <div class = "container" id="container-top">
        <div class="logo-top">
            <a class = "red" href="http://www.genzfinancial.com/gen2/index.php"><img class = "red" src="http://www.genzfinancial.com/gen2/img/header.svg"></a>
        </div>
        <form style="border:none" class="search-top" action="http://www.genzfinancial.com/gen2/search.php" id="submit">
            <input id="in-search-top" type="text" name="stock" placeholder="Search stocks...">
            <button id="btn-search-top" type="submit">Go</button>
        </form>
        <div class="drop-top">
            <!--<a class="drop-nav-link" href="http://www.genzfinancial.com/gen2/logout_page.php">=</a>-->
            <a class="drop-nav-link hov" onclick="myFunction()" id="linkef">=</a>
            <div id = "menu-drop-top" class="dropdown-content">
                
                <? if ($_SESSION['valid'] == true): ?>
                <a class="hov" href="http://genzfinancial.com/gen2/account.php">Account</a>
                <a class="hov" href="http://www.genzfinancial.com/gen2/logout_page.php">Logout</a>
                <? elseif ($_SESSION['valid'] == false): ?>
                <a class="hov" href="http://www.genzfinancial.com/gen2/landing/login.php">Login</a>
                <? endif; ?>
            </div>
        </div>
        <div class="links-top">
            <ul>
                <li><a id="user-nav-link" href="http://www.genzfinancial.com/gen2/landing/login.php">User</a></li>
                <li><a id="stocks-nav-link" href="http://www.genzfinancial.com/gen2/stocks/stocks.php">Stocks</a></li>
                <li><a id="info-nav-link" href="http://www.genzfinancial.com/extra">Info</a></li>
                <li><a id="lb-nav-link" href="http://www.genzfinancial.com/leaderboard">Ranks</a></li>
                <li><a id="play-nav-link" href="http://www.genzfinancial.com/gen2/index.php">Play</a></li>
            </ul>
        </div>
    </div>