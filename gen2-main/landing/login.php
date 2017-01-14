<?php
session_start();

?> 
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="http://www.genzfinancial.com/gen2/img/favico.ico" type="image/x-icon">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.3.2/velocity.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.3.2/velocity.ui.js"></script>
        <title>GenZ Stock Picker - Play</title>
        <link type="text/css" rel="stylesheet" href="http://www.genzfinancial.com/gen2/main.css">
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
<?php include('../header.php'); ?>
    <?php if($_SESSION["error"] == true): $_SESSION["error"] = false; ?>
        <div class="errorheader">
            <p><?php echo $_SESSION["errormsg"]; ?></p>
        </div>
        <?php elseif ($_SESSION["badlogin"] == true): $_SESSION["badlogin"] = false; ?>
        <div class="errorheader">
            <p>Incorrect username or password.</p>
        </div>
        <?php endif; ?>
        <div class = "container-body">
            <div class ="upper-body">
                <div class= "noselect" id="left-body">
                    <div id="content-left-body"> 
                        <img id="stockimage" src="http://www.genzfinancial.com/gen2/img/graphicstock.png">    
                        <p>Learn the Market<br><br>Play your Friends<br><br>Win it all!</p>
                    </div>
                </div>
                <div id="right-body">
                    <div id="content-right-body">
                        <button class = "hover" id="btnloginopen" onclick="allowLog()">Login</button> 
                        <!--<p>Or make a new account!</p>-->
                        <button class = "hover" id="btnregisteropen" onclick="allowReg()">Register</button> 
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
<?php include('../footer.php'); ?>