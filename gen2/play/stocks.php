<?php
session_start();
include('../set.php');
include('../owned.php');
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
                var histAr = <?php echo json_encode($hi)?>;
                $(".more").click(function () {
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
                    console.log(list);
                    //code for animating div
                    for (var i = 0; i < list.length; i++){
                        $("#"+sym).append("<li>"+list[i]['at']+" "+['quantity']+"</li>");
                    };
                });
                
                
                
            });
        </script>
    </head>
    <?php include('../header.php'); ?>
    <div class="container-body" id='stock-body'>
        <div class="upper-body" id='prof-font'>
            <div class="stock-heading">
                <p>Current Portfolio</p>
            </div>
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
                        <p><?php echo $row['totalQuant']; ?></p>
                        <p id="stock-total"><?php echo number_format($row['totalPrice'], 2); ?></p>
                        <p id="stock-total"><?php echo $row['at']; ?></p>
                        <p id="stock-total"><?php echo $p[$key]['at']; ?> <button class="more" name="<?php echo $row['symbol']; ?>">></button></p>
                        <div class = "hist-pop" id="<?php echo $row['symbol']; ?>">

                        </div>
                        <span></span>
                        <div class="port-int">
                            <button class="int-btn green hover">Buy</button>
                            <button class="int-btn blue hover">Sell</button>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    <li class="port-item" id="cash-item">
                        <p>Shares Total:</p>
                        <p>-</p>
                        <p id="stock-total"><?php echo number_format($total,2); ?></p>
                    </li>
                    <li class="port-item" id="cash-item">
                        <p>Cash</p>
                        <p>-</p>
                        <p id="stock-total"><?php echo number_format($_SESSION['balance'],2); ?></p>
                    </li>
                    <li class="port-item" id="cash-item">
                        <p>Total:</p>
                        <p>-</p>
                        <p id="stock-total"><?php $tota = $total + $_SESSION['balance']; echo number_format($tota,2); ?></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <?php include('../footer.php'); ?>
