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
            <?if(!isset($_SESSION['id'])):?><div class="col"><a href="logIn.php">Log in</a></div><?endif;?>
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
                <?if(!isset($_SESSION['id'])):?><div class="col-12 pb-5 pt-2 mobile-menu-links"><a href="logIn.php"><button class="goSearch">Log in</button></a></div><?endif;?>
            </div>
        </div>
    </div>

</section>



<section class="index_questions">
    <div class="container">
        <div class="row text-center index_question">
            <div class="col-12">
                <span class="index_question_header">Time for charity</span>
            </div>
            <div class="col-12">
                <div class="divider mx-auto"></div>
            </div>
            <div class="col-12">
                <span class="index_answer">
                    The project “Time for Charity”, where every meeting is a chance, is dedicated to the protection of children’s rights and all the funds raised will go to the charity projects of NGO World Children Union.
                </span>
            </div>
        </div>
        <div class="row text-center index_question">
            <div class="col-12">
                <span class="index_question_header">Meet your hero and help children</span>
            </div>
            <div class="col-12">
                <div class="divider mx-auto"></div>
            </div>
            <div class="col-12">
                <span class="index_answer">
                    The team of “Time for charity” each time prepares for you an exceptional opportunity to meet your hero (successful businessmen, developers, politicians, artist, etc.). Take part in the auction and be the one who wins a meeting. Spend great moment with your hero and while you are discovering new opportunities, you give a chance for a better future for children who is in need and deserve it.
                </span>
            </div>
        </div>
        <div class="row text-center index_question">
            <div class="col-12">
                <span class="index_question_header">How to participate ?</span>
            </div>
            <div class="col-12">
                <div class="divider mx-auto"></div>
            </div>
            <div class="col-12">
                <span class="index_answer">
                    Create your profile, then make a bid (please, pay attention that when you make a bid, you are not charge) It`s simple!
                </span>
            </div>
        </div>
        <div class="row text-center index_question">
            <div class="col-12">
                <span class="index_question_header">How to make a donation?</span>
            </div>
            <div class="col-12">
                <div class="divider mx-auto"></div>
            </div>
            <div class="col-12">
                <span class="index_answer">
                    You take part in the auction and if you have done the highest bid, congratulations, you are the winner. Go to your personal profile, where you have got the message with all details. You will have 7 days in order to make your donation to the NGO World Children Union.
                    <br><br>Your donation maybe done by : Paypal, a bank wire, Visa/Mastercard
                    <br>Please, do not hesitate to contact us for any questions.
                </span>
            </div>
        </div>
        <div class="row text-center index_question">
            <div class="col-12">
                <span class="index_question_header">How long the auction lasts?</span>
            </div>
            <div class="col-12">
                <div class="divider mx-auto"></div>
            </div>
            <div class="col-12">
                <span class="index_answer">
                    The auction lasts for 1 month.
                </span>
            </div>
        </div>
        <div class="row text-center index_question">
            <div class="col-12">
                <span class="index_question_header">How do you meet your hero?</span>
            </div>
            <div class="col-12">
                <div class="divider mx-auto"></div>
            </div>
            <div class="col-12">
                <span class="index_answer">
                    After you have done successfully your donation, the team of “Time for charity” will contact you through your personal profile and will design with you the meeting, taking into account your time frames.
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-auto mx-auto">
                <a href="auctions.php"><button class="donate_button mb-150" id="proceed_to_auctions">Proceed to auctions</button></a>
            </div>
        </div>
    </div>
</section>



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
<script src="js/bootstrap.min.js"></script>
</body>
</html>
