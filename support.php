<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="js/jquery-3-3-1-min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="media.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
<section class="header">
    <div class="container h-100 d-none d-md-block pt-3 pb-3">
        <div class="row h-100 align-items-center no-gutters">
            <div class="col-auto pr-3 logo d-lg-block d-none"><a href="index.php"><img src="img/logo-small.png" class="logo-img img-fluid">Time for charity</a></div>
            <div class="col-auto d-lg-none d-block"><a href="index.php"><img src="img/logo-small.png"></a></div>
            <?if(isset($_SESSION['id'])):?><div class="col-auto pl-3 pr-3">My profile</div><?endif;?>
            <div class="col-auto <?if(!isset($_SESSION['id'])):?>pl-3<?endif;?> pr-3"><a href="index.php">About us</a></div>
            <div class="col-auto pr-3"><a href="auctions.php">Auctions</a></div>
            <div class="col-auto pr-3"><a href="heroes.php">Heroes</a></div>
            <?if(!isset($_SESSION['id'])):?><div class="col-auto pr-3"><a href="support.php">Contact us</a></div><?endif;?>
            <?if(isset($_SESSION['id'])):?><div class="col"><a href="support.php">Contact us</a></div><?endif;?>
            <?if(!isset($_SESSION['id'])):?><div class="col">Log in</div><?endif;?>
            <div class="col-auto">
                <form action="search_results.php" method="post">
                    <input type="search" placeholder="Search" name="search" class="header-search">
                    <button type="submit" class="search"></button>
                </form>
            </div>
        </div>
    </div>
</section>


<section class="position-fixed header edge">
    <div class="container-fluid h-100 d-block d-md-none pt-2 pb-2">
        <div class="row h-100 align-items-center no-gutters">
            <div class="col-auto"><a href="index.php"><img alt="" src="img/logo-small.png"></a></div>
            <div class="col logo-mobile"><a href="index.php">Time for charity</a></div>
            <div class="col-auto">
                <div class="main">
                    <div id="first"></div>
                    <div id="second"></div>
                </div>
            </div>
        </div>
    </div>


    <div id="menu-mobile">
        <div class="container-fluid h-100 d-block d-md-none">
            <div class="row h-100 align-items-center no-gutters">
                <div class="col-12 mt-5 pb-2">
                    <form action="search_results.php" method="post">
                        <input type="search" placeholder="Search" name="search" class="header-search-mobile">
                        <input type="submit" class="goSearch" value="Go">
                    </form>
                </div>
                <?if(isset($_SESSION['id'])):?><div class="col-12 pb-2 mb-2 border-bottom-menu mobile-menu-links"><img alt="" src="img/lightning-icon.png" class="icons-menu-mobile">My profile</div><?endif;?>
                <div class="col-12 pb-2 mobile-menu-links"><img alt="" src="img/overview-icon.png" class="icons-menu-mobile"><a href="index.php">About us</a></div>
                <div class="col-12 pb-2 mobile-menu-links"><img alt="" src="img/auction-icon.png" class="icons-menu-mobile"><a href="auctions.php">Active auctions</a></div>
                <div class="col-12 pb-2 mobile-menu-links"><img alt="" src="img/expired-icon.png" class="icons-menu-mobile"><a href="heroes.php">Heroes</a></div>
                <div class="col-12 pb-2 mobile-menu-links"><img alt="" src="img/support-icon.png" class="icons-menu-mobile"><a href="support.php">Contact us</a></div>
                <?if(!isset($_SESSION['id'])):?><div class="col-12 pb-5 pt-2 mobile-menu-links"><button class="goSearch">Log in</button></div><?endif;?>
            </div>
        </div>
    </div>

</section>


<section class="supp_form">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-auto text-center">
                <span class="supp_h">Have a question?</span><br>
                <div class="supp_h_small text-center">We will answer as soon as we<br> receive your request</div>
                <form id="form_send_msg">
                    <fieldset class="mx-auto fieldset_supp">
                        <legend>Your email</legend>
                        <input type="text" id="supp_email" name="email" class="email_supp">
                    </fieldset>
                    <fieldset class="mx-auto fieldset_supp">
                        <legend>Question</legend>
                        <textarea name="msg" id="supp_msg" class="msg_supp"></textarea>
                    </fieldset>
                    <input type="submit" class="supp_form_btn mx-auto" value="Ask question">
                </form>
                <div class="data_share text-center">We won`t share your data</div>
            </div>
            <div class="col"><img src="img/support_bg.png" class="mx-auto w-100 d-lg-block d-none"></div>
        </div>
    </div>
</section>

<section class="questions">
    <div class="container">
        <div class="row">
            <div class="col-lg col-12">
                <p id="question-category">General</p>
                <section>
                    <p><span onclick="open_answer(1)" id="question">Some text of question</span></p>
                    <p id="1" class="question-text">
                        This is an answer to</p>
                </section>
                <section>
                    <p><span onclick="open_answer(2)" id="question">Some text of question</span></p>
                    <p id="2" class="question-text">
                        This is an answer to the question listened
                        above to the question listened above to
                        the question listened aboveto the question
                        listened aboveto the question listened
                        aboveto the question listened above.</p>
                </section>
            </div>
            <div class="col-lg col-12">
                <p id="question-category">Payment</p>
                <section>
                    <p><span onclick="open_answer(3)" id="question">Can not pay via Paypal</span></p>
                    <p id="3" class="question-text">
                        This is an answer to the question listened
                        above to the question listened above to
                        the question listened aboveto the question
                        listened aboveto the question listened
                        aboveto the question listened above.</p>
                </section>
            </div>
            <div class="col-lg col-12">
                <p id="question-category">Other</p>
                <section>
                    <p><span onclick="open_answer(4)" id="question">How to log out from my account</span></p>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mx-lg-0 mx-auto px-0">
                <div class="contacts">
                    <span id="contact-h1">Contact us</span><br>
                    <span id="contact-worktime"><b>Mn-Fr </b> from 9:00 to 18:00</span><br><br><br>
                    <span id="contacts-h2">+41(43)321-54-76</span><br>
                    <span id="contacts-h2">time4charity@gmail.com</span><br><br>
                    <span id="contacts-h2">Grossmunster street, 55</span><br>
                    <span id="contacts-h2">Zurich, Switzerland</span>
                </div>
            </div>
        </div>
    </div>
</section>



<div id="map"></div>


<section class="footer">
    <div class="container">
        <div class="row h-100 align-items-center">
            <div class="col-md-auto col-12 footer_links">Privacy policy</div>
            <div class="col-md-auto col-12 footer_links">Privacy policy</div>
            <div class="col-md-auto col-12 footer_links">Privacy policy</div>
            <div class="col-md-auto col-12 footer_links">Privacy policy</div>
            <div class="col-md d-none d-lg-block"></div>
            <div class="col-md-auto col-12"><img src="img/facebook.png" class="facebook"><img src="img/instagram.png" class="inst"></div>
        </div>
    </div>
</section>


<script src="script.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBldKRKTa7TD8iAWXPf2m1aWJwnzJKE-sk&callback=initMap"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
