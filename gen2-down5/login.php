<?php
session_start();

?> 
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <title>GenZ Stock Picker - Play</title>
        <link type="text/css" rel="stylesheet" href="http://www.genzfinancial.com/gen2/main.css">
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
        <script>
            function closeDisplay() {
                document.getElementById('id01').style.display='none';
                document.getElementById('id02').style.display='none';
            }
            function allowLog() {
                document.getElementById('id01').style.display='block';
            }
            function allowReg() {
                document.getElementById('id02').style.display='block';
            }
            document.getElementById('invisibleDiv').onclick = function()
            {
                document.getElementById('popup').style.display = 'none'; 
            }
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
        <?php if($_SESSION["error"] == true): $_SESSION["error"] = false; ?>
        <div class="errorheader">
            <p><?php echo $_SESSION["errormsg"]; ?></p>
        </div>
        <?php elseif ($_SESSION["badlogin"] == true): $_SESSION["badlogin"] = false; ?>
        <div class="errorheader">
            <p>Incorrect username or password.</p>
        </div>
        <?php endif; ?>

        <div class = "container" id="container-top">
            <div class="logo-top">
                <a href="http://www.genzfinancial.com/gen2/index.php"><img src="http://www.genzfinancial.com/gen2/img/headerSm.png"></a>
            </div>
            <form style="border:none" class="search-top" action="http://www.genzfinancial.com/gen2/search.php" id="submit">
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
                    <li><a id="stocks-nav-link" href="http://www.genzfinancial.com/gen2/stocks/stocks.php">Stocks</a></li>
                    <li><a id="info-nav-link" href="http://www.genzfinancial.com/contact">Info</a></li>
                    <li><a id="lb-nav-link" href="http://www.genzfinancial.com/leaderboard">Ranks</a></li>
                    <li><a id="play-nav-link" href="http://www.genzfinancial.com/gen2/index.php">Play</a></li>
                </ul>
            </div>
        </div>
        <div class = "container-body">
            <div class ="upper-body">
                <div id="left-body">
                    <div id="content-left-body"> 
                        <img id="stockimage" src="http://www.genzfinancial.com/gen2/img/graphicstock.png">    
                        <p>Learn the Market<br><br>Play your Friends<br><br>Win it all!</p>
                    </div>
                </div>
                <div id="right-body">
                    <div id="content-right-body">
                        <button id="btnloginopen" onclick="allowLog()">Login</button> 
                        <!--<p>Or make a new account!</p>-->
                        <button id="btnregisteropen" onclick="allowReg()">Register</button> 
                    </div>

                </div>
            </div>

            <!-- Login Modal ----------------------------------------------------------- Modal -->
            <div id="id01" class="modal" >
                <span onclick="closeDisplay()" 
                      class="close" title="Close Modal">&times;</span>
                <!-- Login Modal Content -->
                <form class="modal-content animate" action="login_page.php" method="post">
                    <div id="logintitle" class="imgcontainer">
                        GenZ Login
                    </div>
                    <div class="container" id="modal-space">
                        <label class="label-login"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="uname" required>

                        <label class="label-login"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required>

                        <button class="btnloginform">Login</button>

                    </div>
                    <div class="container" style="background-color:#f1f1f1">
                        <button type= "button" class="btnloginform cancelbtn" onclick="closeDisplay()" >Cancel</button>
                    </div>
                </form>
            </div>
            <!-- End Modal -------------------------------------------------------------------- -->

            <!-- Register Modal -------------------------------------------------------------------- -->
            <div id="id02" class="modal">
                <span onclick="closeDisplay()" 
                      class="close" title="Close Modal">&times;</span>
                <!-- Modal Content -->
                <form class="modal-content animate" action="http://www.genzfinancial.com/gen2/landing/reg_page.php" method="post">
                    <div id="logintitle" class="imgcontainer">
                        Register
                    </div>
                    <div class="container" id="modal-space">
                        <label class="label-login"><b>First name</b></label>
                        <input type="text" placeholder="Enter First Name" name="first" required>

                        <label class="label-login"><b>Last name</b></label>
                        <input type="text" placeholder="Enter Last Name" name="last" required>

                        <label class="label-login"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="uname" required>

                        <label class="label-login"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required>

                        <label class="label-login"><b>Email</b></label>
                        <input type="text" placeholder="Enter Email" name="email" required>

                        <button class="btnloginform">Register</button>
                    </div>
                    <div class="container" style="background-color:#f1f1f1">
                        <button type= "button" class="btnloginform cancelbtn" onclick="closeDisplay()" >Cancel</button>
                    </div>
                </form>
            </div>
            <!-- End Modal -------------------------------------------------------------------- -->
        </div>

        <div class="container-footer">
            <div id="left-list">
                <ul>
                    <li><a href="http://www.genzfinancialfinancial.com/user">User</a></li>
                    <li><a href="http://www.genzfinancialfinancial.com/stocks">Stocks</a></li>
                    <li><a href="http://www.genzfinancialfinancial.com/info">Info</a></li>
                </ul>
                <ul id="social-icons-footer">
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