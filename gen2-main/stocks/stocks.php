<?php
session_start();
include('../set.php');
include('../owned.php');
?> 

<!DOCTYPE html>
<html>
    <head>
        <title>GenZ Stock Picker - Play</title>
        <link rel="shortcut icon" href="http://www.genzfinancial.com/gen2/img/favico.ico" type="image/x-icon">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.3.2/velocity.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.3.2/velocity.ui.js"></script>
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
        <script>
            $(document).ready(function () {
                var listState = false;
                var openList;
                /*$('body').bind('click', function(e) {
                        if($(e.target).closest('.hist-pop').length == 0 && listState == true) {
                            // click happened outside of menu, hide any visible menu items
                            listState = false;
                            openList = "";
                            $(".hist-pop").slideUp("fast");
                        }
                    });*/
                var histAr = <?php echo json_encode($hi)?>;
                $(".moret").click(function () {
                    $('.hist-pop').text('');
                    //code for datascraping history for the symbol
                    var list = new Array;
                    var sym = $(this).attr("name");
                    var y = -1;
                    for(var i = 0; i < histAr.length; i++)
                    {
                        if(histAr[i].symbol == sym)
                        {
                            y++;
                            list[y] = histAr[i];
                        }
                    };
                    list.reverse();
                    console.log(list);
                    //code for animating div
                    $("[id='"+sym+"']").append("<p id='ga'>"+sym.toUpperCase()+" History</p>");
                    for (var i = 0; i < list.length; i++){
                        if (list[i]['quantity'] > 0){
                            $("[id='"+sym+"']").append("<li class='hist-item bu'>"+list[i]['at']+" <span style = 'float:right;' class='b'>"+list[i]['quantity']+"</span></li>");
                        } else{
                            $("[id='"+sym+"']").append("<li class='hist-item se'>"+list[i]['at']+" <span style = 'float:right;' class='s'>"+list[i]['quantity']+"</span></li>");
                        }
                    };

                    if (listState == false){
                        $(".hist-pop").slideUp("fast");
                        $("[id='"+sym+"']").slideDown("fast");
                        listState = true;
                        openList = sym;

                    } else {
                        $(".hist-pop").slideUp("fast");
                        if (openList != sym){
                            $("[id='"+sym+"']").slideDown("fast");
                            listState = true;
                            openList = sym;
                        }
                        listState = false;
                        openList = "";
                    };
                });



            });
        </script>
        <script>
            $(document).ready(function(){
                $('.int-btn').click(function() {
                    window.location = "http://www.genzfinancial.com/gen2/searched.php?stock="+this.name;
                });

            });
        </script>
        <script>
            $(document).ready(function(){
                $('.select-info-item').click(function(){
                    $('.select-info-item').removeClass('selected');
                    $(this).addClass('selected');
                }); 
            });
        </script>
    </head>
    <?php include('../header.php'); ?>
    <div class="container-body" id='stock-body'>
        <div class="upper-body" id='prof-font'>
            <div class="stock-heading">
                <ul class="select-info">
                    <li class="select-info-item selected noselect">Current Portfolio</li>
                    <li class="select-info-item noselect">Transaction History</li>
                </ul>
            </div>
            <? if ($_SESSION['valid'] == true): ?>
            <div class="list-header">
                <p class="head-it" id="sym">Symbol</p>
                <p class="head-it" id="quant">Quantity</p>
                <p class="head-it" id="stock-total">Total (USD)</p>
                <p class="head-it" id="stock-total">Current</p>
                <p class="head-it" id="stock-total">Last</p>
            </div>
            <div class="port-list">
                <ul id="port-stock">
                    <?php foreach($port as $key => $row): ?>
                    <li class="port-item">
                        <a href="http://www.genzfinancial.com/gen2/search.php?stock=<?php echo $row['symbol']; ?>">
                            <? if ($row['at'] == $p[$key]['at']): ?>
                            <span class="y">=</span>
                            <? elseif ($row['at'] > $p[$key]['at']): ?>
                            <span class="g">+</span>
                            <? else: ?>
                            <span class="r">-</span>
                            <? endif; ?>
                            <?php echo $row['symbol']; ?>
                        </a>
                        <p class="qua"><?php echo $row['totalQuant']; ?></p>
                        <p id="stock-total"><?php echo number_format($row['totalPrice'] , 2); ?></p>
                        <p id="stock-total"><?php echo $row['at']; ?></p>
                        <p id="stock-total"><?php echo $p[$key]['at']; ?> <button class="moret noselect" name="<?php echo $row['symbol']; ?>">></button></p>
                        <div class = "hist-pop" id="<?php echo $row['symbol'];?>">

                        </div>
                        <span></span>
                        <div class="port-int">
                            <button name="<?php echo $row['symbol']; ?>" class="int-btn green hover">Buy</button>
                            <button name="<?php echo $row['symbol']; ?>" class="int-btn blue hover">Sell</button>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    <li class="port-item" id="cash-item">
                        <p>Shares Total:</p>
                        <p class="qua">-</p>
                        <p id="stock-total"><?php echo number_format($total,2); ?></p>
                    </li>
                    <li class="port-item" id="cash-item">
                        <p>Cash</p>
                        <p class="qua">-</p>
                        <p id="stock-total"><?php echo number_format($_SESSION['balance'],2); ?></p>
                    </li>
                    <li class="port-item" id="cash-item">
                        <p>Total:</p>
                        <p class="qua">-</p>
                        <p id="stock-total"><?php $tota = $total + $_SESSION['balance']; echo number_format($tota,2); ?></p>
                    </li>
                </ul>
            </div>
            <? else: ?>
            <div class="nolog">
                <p>
                    You are not logged in!
                    <br/>
                    <br/>
                    <a class="hover" href="http://www.genzfinancial.com/gen2/landing/login.php">Login/Register</a>
                    <br/>
                    <br/>
                    Get started.
                </p>
            </div>
            <? endif; ?>
        </div>
    </div>

    <?php include('../footer.php'); ?>
