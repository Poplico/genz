<?php
session_start();

?> 
<!DOCTYPE html>
<html>
    <head>
        <title>GenZ Stock Picker - Play</title>

        <link type="text/css" rel="stylesheet" href="main.css">
        <script>/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
            function myFunction() {
                document.getElementById("menu-drop-top").classList.toggle("show");
                document.getElementById("linkef").classList.toggle("add");
            }

            // Close the dropdown menu if the user clicks outside of it
            window.onclick = function(event) {
                if (!event.target.matches('.drop-nav-link')) {
                    var button = document.getElementsByClassName("drop-nav-link");
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
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
    </head>
    <body>
        <div class = "container" id="container-top">
            <div class="logo-top">
                <a href="http://www.genzfinancial.com/gen2/index.php">GenZ Stock Picker</a>
            </div>
            <form style="border:none" class="search-top" action="search.php">
                <input id="in-search-top" type="text" name="stock" placeholder="Search stocks...">
                <button id="btn-search-top" type="submit">Go</button>
            </form>
            <div class="drop-top">
                <!--<a class="drop-nav-link" href="http://www.genzfinancial.com/gen2/logout_page.php">=</a>-->
                <a class="drop-nav-link" onclick="myFunction()" id="linkef">=</a>
                <div id = "menu-drop-top" class="dropdown-content">
                    <a href="http://www.genzfinancial.com/gen2/cart.php">Cart</a>
                    <a href="http://www.genzfinancial.com/gen2/logout_page.php">Logout</a>
                </div>
            </div>
            <div class="links-top">
                <ul>
                    <li><a id="user-nav-link" href="http://www.genzfinancial.com/gen2/landing/login.php">User</a></li>
                    <li><a id="stocks-nav-link" href="http://www.genzfinancial.com/gen2/stocks">Stocks</a></li>
                    <li><a id="info-nav-link" href="http://www.genzfinancial.com/contact">Info</a></li>
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