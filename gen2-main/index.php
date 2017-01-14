<?php
session_start();
include('set.php');

?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to - GenZ Financial</title>
        <link rel="shortcut icon" href="http://www.genzfinancial.com/gen2/img/favico.ico" type="image/x-icon">
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
        <link rel='shortcut icon' href='http://www.genzfinancial.com/gen2/img/favico.ico' type='image/x-icon'/ >
    </head>
    <?php include('header.php'); ?>
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
        <div class="index-stats">
            <div class="stat-wrap">
                <div class="stat-cont">
                    Balance
                </div>
                <div class="stat-cont">
                    Profit
                </div>
                <div class="stat-cont">
                    Total Spent
                </div>
                <div class="stat-cont">
                    Total Made
                </div>
                <div class="stat-cont">
                    Shares Purchased
                </div>
                <div class="stat-cont">
                    Shares Sold
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>