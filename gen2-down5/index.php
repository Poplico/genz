<?php
session_start();

?> 
<!DOCTYPE html>
<html>
    <head>
        <title>GenZ Stock Picker - Play</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.3.2/velocity.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.3.2/velocity.ui.js"></script>
        <link type="text/css" rel="stylesheet" href="main.css">
        <script>
            var op = false;
            function myFunction() {
                document.getElementById("linkef").classList.toggle("add");
                if (op === false) {
                    $("#menu-drop-top").velocity("slideDown", { duration: 200 });
                    op = true;
                } else {
                    $("#menu-drop-top").velocity("slideUp", { duration: 200 });
                    op = false;
                }
            }
            // Close the dropdown menu if the user clicks outside of it
            window.onclick = function(event) {
                if (!event.target.matches('.drop-nav-link')) {
                    var button = document.getElementsByClassName("drop-nav-link");
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (op === true) {
                            $("#menu-drop-top").velocity("slideUp", { duration: 200 });
                            op = false;
                        }
                    }
                    for (i = 0; i < button.length; i++) {
                        var openDropdown = button[i];
                        if (openDropdown.classList.contains('add')) {
                            openDropdown.classList.remove('add');
                
                        }
                    }
                }
            }
        </script>
        <script>
           /* $(document).ready(function() {
                window.setTimeout("fadeMyDiv();", 3000); //call fade in 3 seconds
                $('html, body').css({
                    overflow: 'hidden',
                    height: '100%'
                });
            }
                             )

            function fadeMyDiv() {
                $("#loading").fadeOut('fast');
                <? if ($_SESSION['validSymbol'] == true): ?>
                $('html, body').css({
                    overflow: 'initial  ',
                });
                <? endif; ?>
            }*/
        </script>

        <script>
            $(function() {
                $( "#in-search-top" ).autocomplete({
                    source: "http://www.genzfinancial.com/gen2/autocomp.php",
                    delay: 400,
                    select: function(event, ui) {
                        if(ui.item){
                            $('#in-search-top').val(ui.item.value);
                        }
                        $('#submit').submit();
                    }
                });
            });
        </script>
    </head>
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
                    <a href="http://www.genzfinancial.com/gen2/cart.php">Cart</a>
                    <? if ($_SESSION['valid'] == true): ?>
                    <a href="http://genzfinancial.com/gen2/account.php">Account</a>
                    <? endif; ?>
                    <a href="http://www.genzfinancial.com/gen2/logout_page.php">Logout</a>
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
        <div class="container-body">
            <div class = "inside-part">
                <div class="loggedin-body">
                    <?php if($_SESSION["valid"] !== true): ?>
                    <div>
                        <p>You aren't logged in!</p>
                    </div>
                    <?php elseif ($_SESSION["valid"] == true): ?>
                    <div>
                        <p>Welcome <?php echo $_SESSION["userID"];?>!</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="container-footer">
            <div id="left-list">
                <ul>
                    <li><a href="http://www.genzfinancialfinancial.com/user">User</a></li>
                    <li><a href="http://www.genzfinancialfinancial.com/stocks">Stocks</a></li>
                    <li><a href="http://www.genzfinancialfinancial.com/info">Info</a></li>
                </ul>
                <ul id=social-icons-footer>
                    <li><a href="NOTHING">
                        <img src= "https://cdn4.iconfinder.com/data/icons/social-media-icons-the-circle-set/48/instagram_circle-48.png"/></a>
                    </li>
                    <li><a href="NOTHING">
                        <img src= "https://cdn4.iconfinder.com/data/icons/social-media-icons-the-circle-set/48/twitter_circle-48.png"/></a>
                    </li>
                    <li><a href="NOTHING">
                        <img src= "https://cdn4.iconfinder.com/data/icons/social-media-icons-the-circle-set/48/facebook_circle-48.png"/></a>
                    </li>
                </ul>
                <ul id="contact-footer">    
                    <li><a>Email: seanliew@genzfinancial.com</a></li>
                    <li><a>Phone: 647-455-2108</a></li>
                </ul>
            </div>
            <div id="final-footer">
                <p>Sean Liew, Derek Miller, Paul Santilli, Marie Macdonald, Jacob Salach | Bishop Allen 2016</p>
            </div>
        </div>
    </body>
</html>