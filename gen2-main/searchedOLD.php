<?php
session_start(); // Starting Session
include('datafetch.php');
include('set.php');

$servername = "www.genzfinancial.com";
$username = "remotegenz";
$password = "password";
$dbname = "genz-info-user";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="http://www.genzfinancial.com/gen2/img/favico.ico" type="image/x-icon">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.3.2/velocity.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.3.2/velocity.ui.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <title>GenZ Stock Picker - Play</title>
        <link type="text/css" rel="stylesheet" href="main.css">
        <script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
        <script type="text/javascript" src="http://stocktwits.com/addon/widget/2/widget-loader.min.js"></script>
        <script>
            function closeDisplay() {
                // document.getElementById('buyform').style.display='none';
            }
            function allowLog() {

            }
            function allowReg() {
                // document.getElementById('id02').style.display='block';
            }
        </script>
        <script>
            var op = false;
            function myFunction() {
                document.getElementById("linkef").classList.toggle("add");
                if (op === false) {
                    $("#menu-drop-top").velocity("slideDown", { duration: 125 });
                    op = true;
                } else {
                    $("#menu-drop-top").velocity("slideUp", { duration: 125 });
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
            $(document).ready(function () {
                $('html, body').css({
                    overflow: 'hidden',
                    height: '100%'
                });
            });
        </script>
        <script>
            $(window).on('load', function() {
                window.setTimeout("fadeMyDiv();", 1000); //call fade in 1 seconds
            }
                        )
            function fadeMyDiv() {
                $("#loading").velocity("fadeOut", {duration: 1000 });
                <? if ($_SESSION['validSymbol'] == true): ?>
                $('html, body').css({
                    overflow: 'initial  ',
                });
                <? endif; ?>
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
        <script>      
            $(document).ready(function(){
                var buyopen = false;
                var sellopen = false;

                $("#buybtn").click(function(){
                    $(".quant").val(null);
                    $(".coster").text("-  $ 0.00");
                    $(".costerres").text("$ ---.--");
                    if (buyopen === false) {
                        buyopen = true;
                        if (sellopen === true){
                            sellopen = false;
                            $("#sellform").velocity("slideUp", {duration: 200 });
                            $("#buyform").velocity("slideDown", { delay: 250, duration: 200 });
                        } else {
                            $("#buyform").velocity("slideDown", { delay: 0, duration: 200 });
                        }
                    } else if (buyopen === true){
                        $("#buyform").velocity("slideUp", {duration: 200 });
                        buyopen = false;
                    }
                });
                $("#sellbtn").click(function(){
                    $(".quant").val(null);
                    $(".gainer").text("$ 0.00");
                    $(".gainerres").text("$ ---.--");
                    if (sellopen === false) {
                        sellopen = true;

                        if (buyopen === true) {
                            buyopen = false;
                            $("#buyform").velocity("slideUp", {duration: 200 });
                            $("#sellform").velocity("slideDown", { delay: 250, duration: 200 });
                        } else {
                            $("#sellform").velocity("slideDown", { delay: 0, duration: 200 });
                        }
                    } else if (sellopen === true){
                        $("#sellform").velocity("slideUp", {duration: 200 });
                        sellopen = false;
                    }
                });
                $(".cancelbtn").click(function(){
                    $(".modal").stop().slideUp('fast');
                });
                $(".close").click(function(){
                    $(".modal").stop().slideUp('fast');
                });
            })
        </script>
        <script>
            var balance = Number(<?php echo $_SESSION["balance"];?>);
            var owned = Number(<?php echo $stockQuant;?>);

            $(document).ready(function(){
                $(".quant.seller").on("change paste keyup", function() {

                    $(".gainer").text("$ --.--");
                    var quantity = Math.abs(Number($(".seller").val()));
                    //prevent input quantity from being over 12 numbers long
                    var lessstock = parseInt(owned) - parseInt(quantity);
                    var price = Number(<?php echo $_SESSION["tradeAmount"];?>);
                    var total = (quantity * price).toFixed(2);
                    var remain = parseFloat(balance) + parseFloat(total);
                    var sender = String(total);
                    setTimeout(function valUpdate(){
                        $(".gainer").text("$ "+sender);
                        if (quantity == 0){
                            $(".less").text("0");
                            $(".lessres").text(String(lessstock));
                            $(".gainerres").text("$ ---.--");
                        } else {
                            $(".less").text(String(quantity));
                            $(".lessres").text(String(lessstock));
                            $(".gainerres").text("$ "+remain.toFixed(2));
                        }
                    }, 150);


                });
                $(".quant.buyer").on("change paste keyup", function() {

                    //variable declarations
                    var owned = Number(<?php echo $stockQuant;?>);
                    var quantity = Math.abs(Number($(".buyer").val()));
                    var price = Number(<?php echo $_SESSION["tradeAmount"];?>);
                    var total = (quantity * price).toFixed(2);
                    var remain = (balance - total).toFixed(2);
                    var sender = String(total);

                    //reset cost label until timeout complete
                    $(".coster").text("$ --.--");

                    //owned more quantity calculation and display
                    var morestock = parseInt(owned) + parseInt(quantity);

                    setTimeout(function valUpdate(){
                        $(".coster").text("-  $ "+sender);
                        if (quantity == 0){
                            $(".more").text("0");
                            $(".moreres").text(String(<?php echo $stockQuant;?>));
                            $(".costerres").text("$ ---.--");
                        } else {
                            $(".more").text(String(quantity));
                            $(".moreres").text(String(morestock));
                            $(".costerres").text("$ "+remain);
                        }
                    }, 150);

                });
            });
        </script>
    </head>
    <?php include('header.php'); ?>
        <div class = "container-body" id="searched-body">
            <? if ($_SESSION['validSymbol'] == true): ?>
            <div id="loading" class="stretch-page">
                <div class="floater">

                    <? if ($_SESSION['error'] == true): ?>
                    <p><?php echo $_SESSION["error_msg"]; unset($_SESSION['error']);?></p>
                    <? endif; ?>
                    <img src="http://www.genzfinancial.com/gen2/img/Preloader_10.gif">
                    <p>Loading</p>
                </div>
            </div>
            <div class ="upper-body">
                <div class="stock-heading">
                    <div class = "head-left">
                        <? if ($_SESSION['validSymbol'] == true): ?>
                        <p><?php echo $_SESSION["sstock"];?> - $<?php echo $_SESSION["tradeAmount"];?></p>
                        <p id="market-sub"><?php echo $_SESSION["company"]; echo " "; echo $_SESSION['tradeTime'];?></p>
                        <? elseif ($_SESSION['validSymbol'] == false): ?>
                        <p>Invalid Symbol</p>
                        <? endif; ?>
                    </div>
                    <div class = "head-right">
                        <? if ($_SESSION['validSymbol'] == true): ?>
                        <button class="btn-order noselect nohighlight" id="sellbtn">Sell</button>
                        <button class="btn-order noselect nohighlight" id="buybtn" onclick="allowLog()">Buy</button>

                        <? elseif ($_SESSION['validSymbol'] == false): ?>
                        <p>Invalid Symbol</p>
                        <button class="btn-order noselect nohighlight" id="sellbtn" disabled>Sell</button>
                        <button class="btn-order noselect nohighlight" id="buybtn" onclick="allowLog()" disabled>No Stock</button>

                        <? endif; ?>
                    </div>

                </div>
                <!-- Buy ----------------------------------------------------------- Modal -->
                <div id="buyform" class="modal" >
                    <span onclick="closeDisplay()" 
                          class="close" title="Close Modal">&times;</span>
                    <!-- BuyModal Content -->
                    <form class="modal-content border-t" action="http://www.genzfinancial.com/gen2/buy.php" method="post" id="buycontent">
                        <div class="stock-heading green">
                            <p>You Own: <?php echo $stockQuant;?> units</p>
                        </div>
                        <div id="logintitle" class="imgcontainer operhead">
                            Order
                        </div>
                        <div class="container operhead" id="modal-space">
                            <div class="wrap-l ">
                                <div class="left-oper">
                                    <label class="label-login"><p><?php echo $_SESSION["sstock"];?> Quantity</p></label>
                                    <input class = "quant buyer nohighlight" type="number" placeholder="0" name="quantity" min="1" required>
                                    <button class="btnloginform buy-f">Place</button>
                                </div>
                            </div>
                            <div class="wrap-r">
                                <div class="right-oper">
                                    <p class="p-f-l">Current Balance: <span class="span-f-r">$ <?php echo $_SESSION["balance"];?></span></p>
                                    <p class="p-f-l">Total Cost: <span class="span-f-r coster"></span></p>
                                    <hr>
                                    <p class="p-f-l">Remaining Balance: <span class="span-f-r costerres">$ ---.--</span></p>
                                </div>
                                <div class="right-oper">
                                    <p class="p-f-l">Owned Shares: <span class="span-f-r"><?php echo $stockQuant;?></span></p>
                                    <p class="p-f-l">More: <span class="span-f-r more">0</span></p>
                                    <hr>
                                    <p class="p-f-l">Resulting: <span class="span-f-r moreres"><?php echo $stockQuant;?></span></p>
                                </div>
                            </div>

                        </div>
                        <div class="container operhead" style="background-color:#f1f1f1">
                            <button type= "button" class="btnloginform cancelbtn buy-f" onclick="closeDisplay()" id="buyclose">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- End Modal -------------------------------------------------------------------- -->
                <!-- Sell ----------------------------------------------------------- Modal -->
                <div id="sellform" class="modal" >
                    <span onclick="closeDisplay()" 
                          class="close" title="Close Modal">&times;</span>
                    <!-- BuyModal Content -->
                    <form class="modal-content border-t" action="http://www.genzfinancial.com/gen2/sell.php" method="post" id="buycontent">
                        <div class="stock-heading blue">
                            <p>You Own: <?php echo $stockQuant;?> units</p>
                        </div>
                        <div id="logintitle" class="imgcontainer operhead">
                            Sell
                        </div>
                        <div class="container operhead" id="modal-space">
                            <div class="wrap-l">
                                <div class="left-oper">
                                    <label class="label-login"><p><?php echo $_SESSION["sstock"];?> Quantity</p></label>
                                    <input class = "quant seller nohighlight" type="number" placeholder="0" name="quantity" min="1" max="<?php echo $stockQuant;?>"required>
                                    <button class="btnloginform sell-f">Place</button>
                                </div>
                            </div>
                            <div class = "wrap-r">
                                <div class="right-oper">
                                    <p class="p-f-l">Current Balance: <span class="span-f-r"><?php echo $_SESSION["balance"];?></span></p>
                                    <p class="p-f-l">Total Gain: <span class="span-f-r gainer"></span></p>
                                    <hr>
                                    <p class="p-f-l">New Balance: <span class="span-f-r gainerres">$ ---.--</span></p>
                                </div>
                                <div class="right-oper">
                                    <p class="p-f-l">Owned Shares: <span class="span-f-r"><?php echo $stockQuant;?></span></p>
                                    <p class="p-f-l">Less: <span class="span-f-r less">0</span></p>
                                    <hr>
                                    <p class="p-f-l">Resulting: <span class="span-f-r lessres"><?php echo $stockQuant;?></span></p>
                                </div>
                            </div>

                        </div>
                        <div class="container operhead" style="background-color:#f1f1f1">
                            <button type= "button" class="btnloginform cancelbtn sell-f" onclick="closeDisplay()" id="sellclose">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- End Modal -------------------------------------------------------------------- -->
                <div id="widget-top-boxer">
                    <!-- TradingView Widget BEGIN -->
                    <div id="tv-medium-widget-4d772"></div>
                    <script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
                    <script type="text/javascript">
                        new TradingView.MediumWidget({
                            "container_id": "tv-medium-widget-f778f",
                            "symbols": [
                                [
                                    "<?php echo $_SESSION["sstock"];?>",
                                    "<?php echo $_SESSION["sstock"];?>"
                                ]
                            ],
                            "gridLineColor": "rgba(216, 216, 216, 1)",
                            "fontColor": "rgba(242, 242, 242, 1)",
                            "underLineColor": "rgba(153, 0, 0, 0.50)",
                            "trendLineColor": "rgba(102, 0, 0, 1)",
                            "width": "100%",
                            "height": "500px",
                            "locale": "en"
                        });
                    </script>
                    <!-- TradingView Widget END -->
                </div>
                <div id="sidebar-left">
                    <!-- start feedwind code --> 
                    <script type="text/javascript" src="https://feed.mikle.com/js/fw-loader.js" data-fw-param="?widget_parameter=%7B%22sources%22%3A%5B%7B%22source%22%3A%22https%3A%2F%2Fwww.google.ca%2Ffinance%2Fcompany_news%3Fq%3D<?php echo $_SESSION["sstock"];?>%26ei%3Di8cxWKitMtT2jAHT2ZWgAw%26output%3Drss%22%2C%22type%22%3A%22RSS%22%7D%5D%2C%22name%22%3A%22%22%2C%22width%22%3A%22400%22%2C%22height%22%3A0%2C%22height_by_article%22%3A%226%22%2C%22target%22%3A%22_blank%22%2C%22font%22%3A%22Arial%2C%20Helvetica%2C%20sans-serif%22%2C%22title_font_size%22%3A%2216%22%2C%22item_title_font_size%22%3A%2216%22%2C%22item_description_font_size%22%3A%2212%22%2C%22border%22%3A%22off%22%2C%22css_url%22%3A%22%22%2C%22responsive%22%3A%22off%22%2C%22text_direction%22%3A%22left%22%2C%22text_alignment%22%3A%22left%22%2C%22corner%22%3A%22square%22%2C%22scroll%22%3A%22on%22%2C%22auto_scroll%22%3A%22off%22%2C%22auto_scroll_direction%22%3A%22up%22%2C%22auto_scroll_step_speed%22%3A%224%22%2C%22auto_scroll_mc_speed%22%3A%2220%22%2C%22sort%22%3A%22new%22%2C%22title%22%3A%22on%22%2C%22title_sentence%22%3A%22News%22%2C%22title_link%22%3A%22%22%2C%22title_bgcolor%22%3A%22%238b0000%22%2C%22title_color%22%3A%22%23ffffff%22%2C%22title_bgimage%22%3A%22%22%2C%22item_bgcolor%22%3A%22%23ffffff%22%2C%22item_bgimage%22%3A%22%22%2C%22item_title_length%22%3A%2255%22%2C%22item_title_color%22%3A%22%238b0000%22%2C%22item_border_bottom%22%3A%22on%22%2C%22item_description%22%3A%22both%22%2C%22item_link%22%3A%22off%22%2C%22item_description_length%22%3A%22100%22%2C%22item_description_color%22%3A%22%23505659%22%2C%22item_date%22%3A%22on%22%2C%22item_date_format%22%3A%22%25b%20%25e%2C%20%25Y%20%25k%3A%25M%22%2C%22item_date_timezone%22%3A%22%22%2C%22item_description_style%22%3A%22text%22%2C%22item_thumbnail%22%3A%22crop%22%2C%22item_thumbnail_selection%22%3A%22auto%22%2C%22article_num%22%3A%2215%22%2C%22item_player%22%3A%22youtube%22%2C%22keyword_inc%22%3A%22%22%2C%22keyword_exc%22%3A%22%22%7D"></script> 
                    <!-- end feedwind code -->
                    <!-- TradingView Widget BEGIN -->
                    <script type="text/javascript">
                        new TradingView.widget({
                            "width": 600,
                            "height": 400,
                            "symbol": "<?php echo $_SESSION["sstock"];?>",
                            "interval": "D",
                            "timezone": "Etc/UTC",
                            "theme": "Whtie",
                            "style": "3",
                            "locale": "en",
                            "toolbar_bg": "#f1f3f6",
                            "enable_publishing": false,
                            "save_image": false,
                            "hideideas": true
                        });
                    </script>
                    <!-- TradingView Widget END -->
                    <div id="stocktwits-widget-news"></div><a href='http://stocktwits.com' style='font-size: 0px;'>StockTwits</a>
                    <script type="text/javascript">
                        STWT.Widget({container: 'stocktwits-widget-news', avatars: 0, symbol: '<?php echo $_SESSION["sstock"];?>', width: '400', height: '500', limit: '25', scrollbars: 'true', streaming: 'true', title: '<?php echo $_SESSION["sstock"];?> Tweets', style: {link_color: '4871a8', link_hover_color: '4871a8', header_text_color: 'f', border_color: '#800000', divider_color: 'cecece', divider_color: 'cecece', divider_type: 'solid', box_color: 'f5f5f5', stream_color: 'ffffff', text_color: '000000', time_color: '999999'}});
                    </script>
                    <div>
                        <p>
                            <?php 
                            echo "Amount: ".$_SESSION['tradeAmount']."<br>";
                            echo "Symbol: ".$_SESSION['symbol']."<br>";
                            echo "Company: ".$_SESSION['company']."<br>";
                            echo "Last Traded: ".$_SESSION['tradeTime']."<br>";
                            echo "Day High: ".$_SESSION['dayHigh']."<br>";
                            echo "Day Low: ".$_SESSION['dayLow']."<br>";
                            echo $curVal;
                            ?>
                        </p>
                    </div>

                </div>
                <div id="content-right-body">

                </div>
            </div>
            <? elseif ($_SESSION['validSymbol'] == false): ?>
            <div class="stretch-page" id="invalid-resp">
                <div class="floater">
                    <img src="http://www.genzfinancial.com/gen2/img/Preloader_10rev.gif">
                    <p>Oops, Invalid Symbol</p>
                </div>
            </div>
            <? endif; ?>
        </div>
        <?php include('footer.php'); ?>