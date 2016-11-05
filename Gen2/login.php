<?php
session_start();

?> 
<!DOCTYPE html>
<html>
    <head>
        <title>GenZ Stock Picker - Play</title>
        <link type="text/css" rel="stylesheet" href="http://www.genzfinancial.com/gen2/main.css">
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
                GenZ Stock Picker
            </div>
            <form style="border:none" class="search-top" action="search.php">
                <input id="in-search-top" type="text" name="stock" placeholder="Search stocks...">
                <button id="btn-search-top" type="submit">Go</button>
            </form>
            <div class="drop-top">
                <a class="drop-nav-link">=</a>
                <!--<div id="menu-drop-top" class="drop">
AAA
</div>-->
            </div>
            <div class="links-top">
                <ul>
                    <li><a id="user-nav-link" href="http://www.genzfinancial.com/user">User</a></li>
                    <li><a id="stocks-nav-link" href="http://www.genzfinancial.com/stocks">Stocks</a></li>
                    <li><a id="info-nav-link" href="http://www.genzfinancial.com/contact">Info</a></li>
                    <li><a id="lb-nav-link" href="http://www.genzfinancial.com/leaderboard">Ranks</a></li>
                    <li><a id="play-nav-link" href="http://www.genzfinancial.com/play">Play</a></li>
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
                        <button type= "button" class="btnloginform" onclick="closeDisplay()" id="cancelbtn">Cancel</button>
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
                        <button type= "button" class="btnloginform" onclick="closeDisplay()" id="cancelbtn">Cancel</button>
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
                    <li><a><p>Email: seanliew@genzfinancial.com</p></a></li>
                    <li><a><p>Phone: 647-455-2108</p></a></li>
                </ul>
            </div>
            <div id="final-footer">
                <p>Sean Liew, Derek Miller, Paul Santilli, Marie Macdonald, Jacob Salach | Bishop Allen 2016</p>
            </div>
        </div>
    </body>
</html>