<?php
session_start(); // Starting Session
include('datafetch.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>GenZ Stock Picker - Play</title>
        <link type="text/css" rel="stylesheet" href="main.css">
        <script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
        <script type="text/javascript" src="http://stocktwits.com/addon/widget/2/widget-loader.min.js"></script>
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
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function() {
                window.setTimeout("fadeMyDiv();", 3000); //call fade in 3 seconds
            }
                             )

            function fadeMyDiv() {
                $("#loading").fadeOut('fast');
            }
        </script>
    </head>
    <body>
        <div class = "container" id="container-top">
            <div class="logo-top">
                <a href="http://www.genzfinancial.com/gen2/index.php">GenZ Stock Picker</a>
            </div>
            <form style="border:none" class="search-top" action="search.php" id="submit">
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
        
        <div class = "container-body" id="searched-body">
            <? if ($_SESSION['validSymbol'] == true): ?>
            <div id="loading" class="stretch-page">
                <p>Loading</p>
            </div>
            <div class ="upper-body">
                <div class="stock-heading">
                    <? if ($_SESSION['validSymbol'] == true): ?>
                    <p><?php echo $_SESSION["sstock"];?> - <?php echo $_SESSION["tradeAmount"];?></p>
                    <p id="market-sub"><?php echo $_SESSION["company"];?></p>
                    <? elseif ($_SESSION['validSymbol'] == false): ?>
                    <p>Invalid Symbol</p>
                    <? endif; ?>
                </div>
                <div id="sidebar-left">
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
                    <? if ($_SESSION['validSymbol'] == true): ?>
                    <button id="btn-order" onclick="allowLog()">Order</button>
                    <? elseif ($_SESSION['validSymbol'] == false): ?>
                    <p>Invalid Symbol</p>
                    <button id="btn-order" onclick="allowLog()" disabled>Order</button>
                    <? endif; ?>
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
                            echo "Day Low: ".$_SESSION['dayLow'];
                            ?>
                        </p>
                    </div>

                </div>

                <div id="content-right-body">
                    <!-- start feedwind code --> 
                    <script type="text/javascript" src="https://feed.mikle.com/js/fw-loader.js" data-fw-param="?widget_parameter=%7B%22sources%22%3A%5B%7B%22source%22%3A%22https%3A%2F%2Fwww.google.ca%2Ffinance%2Fcompany_news%3Fq%3D<?php echo $_SESSION["sstock"];?>%26ei%3Di8cxWKitMtT2jAHT2ZWgAw%26output%3Drss%22%2C%22type%22%3A%22RSS%22%7D%5D%2C%22name%22%3A%22%22%2C%22width%22%3A%22400%22%2C%22height%22%3A0%2C%22height_by_article%22%3A%226%22%2C%22target%22%3A%22_blank%22%2C%22font%22%3A%22Arial%2C%20Helvetica%2C%20sans-serif%22%2C%22title_font_size%22%3A%2216%22%2C%22item_title_font_size%22%3A%2216%22%2C%22item_description_font_size%22%3A%2212%22%2C%22border%22%3A%22off%22%2C%22css_url%22%3A%22%22%2C%22responsive%22%3A%22off%22%2C%22text_direction%22%3A%22left%22%2C%22text_alignment%22%3A%22left%22%2C%22corner%22%3A%22square%22%2C%22scroll%22%3A%22on%22%2C%22auto_scroll%22%3A%22off%22%2C%22auto_scroll_direction%22%3A%22up%22%2C%22auto_scroll_step_speed%22%3A%224%22%2C%22auto_scroll_mc_speed%22%3A%2220%22%2C%22sort%22%3A%22new%22%2C%22title%22%3A%22on%22%2C%22title_sentence%22%3A%22News%22%2C%22title_link%22%3A%22%22%2C%22title_bgcolor%22%3A%22%238b0000%22%2C%22title_color%22%3A%22%23ffffff%22%2C%22title_bgimage%22%3A%22%22%2C%22item_bgcolor%22%3A%22%23ffffff%22%2C%22item_bgimage%22%3A%22%22%2C%22item_title_length%22%3A%2255%22%2C%22item_title_color%22%3A%22%238b0000%22%2C%22item_border_bottom%22%3A%22on%22%2C%22item_description%22%3A%22both%22%2C%22item_link%22%3A%22off%22%2C%22item_description_length%22%3A%22100%22%2C%22item_description_color%22%3A%22%23505659%22%2C%22item_date%22%3A%22on%22%2C%22item_date_format%22%3A%22%25b%20%25e%2C%20%25Y%20%25k%3A%25M%22%2C%22item_date_timezone%22%3A%22%22%2C%22item_description_style%22%3A%22text%22%2C%22item_thumbnail%22%3A%22crop%22%2C%22item_thumbnail_selection%22%3A%22auto%22%2C%22article_num%22%3A%2215%22%2C%22item_player%22%3A%22youtube%22%2C%22keyword_inc%22%3A%22%22%2C%22keyword_exc%22%3A%22%22%7D"></script> 
                    <!-- end feedwind code -->
                </div>
            </div>
            <? elseif ($_SESSION['validSymbol'] == false): ?>
            <div class="stretch-page" id="invalid-resp">
                <p>Oops, Invalid Symbol</p>
            </div>
            <? endif; ?>
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
        <!-- Buy ----------------------------------------------------------- Modal -->
        <div id="id01" class="modal" >
            <span onclick="closeDisplay()" 
                  class="close" title="Close Modal">&times;</span>
            <!-- BuyModal Content -->
            <form class="modal-content animate" action="http://www.genzfinancial.com/gen2/buy.php" method="post">
                <div id="logintitle" class="imgcontainer">
                    Order "<?php echo $_SESSION["sstock"];?>"
                </div>
                <div class="container" id="modal-space">
                    <label class="label-login"><b><?php echo $_SESSION["sstock"];?></b></label>
                    <label class="label-login"><b>Quantity</b></label>
                    <input type="number" placeholder="0" name="quantity" required>
                    <button class="btnloginform">Cart</button>
                </div>
                <div class="container" style="background-color:#f1f1f1">
                    <button type= "button" class="btnloginform" onclick="closeDisplay()" id="cancelbtn">Cancel</button>
                </div>
            </form>
        </div>
        <!-- End Modal -------------------------------------------------------------------- -->
    </body>
</html>