<?php
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


<img src="img/reg_bg.png" class="reg_img d-xl-block d-none">


<section class="register">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5 text-xl-left text-center">
                <span class="register_header">Register an account</span><br>
                <span class="register_preHeader">All data will be hidden and secured,<br>only your name and surname will be showed.</span>
            </div>
        </div>
        <div class="row">
           <form id="regForm" class="mx-auto mx-xl-0">
                <div class="col-12 mb-4">
                    <span class="reg_input_name">Name</span><br>
                    <input class="reg_input" type="text" name="name" placeholder="Ivan" id="name">
                    <div id="error_name" class="errors_reg"></div>
                </div>
                <div class="col-12 mb-4">
                    <span class="reg_input_name">Surname</span><br>
                    <input class="reg_input mx-auto" type="text" name="surname" placeholder="Ivanov" id="surname">
                    <div id="error_surname" class="errors_reg"></div>
                </div>
                <div class="col-12 mb-4">
                    <span class="reg_input_name">Email<span id="email_reg_note">(will be your login)</span></span><br>
                    <input class="reg_input" type="text" name="email" placeholder="example@gmail.com" id="email">
                    <div id="error_email" class="errors_reg"></div>
                </div>
                <div class="col-12 mb-4">
                    <span class="reg_input_name">Phone<span id="phone_reg_note">(country code required)</span></span><br>
                    <input class="reg_input" type="text" name="phone" placeholder="+41(43)321-34-67" id="phone">
                    <div id="error_phone" class="errors_reg"></div>
                </div>
                <div class="col-12 mb-4">
                    <span class="reg_input_name">Password</span><br>
                    <input class="reg_input reg_password_input" type="password" name="password" id="password" placeholder="********">
                    <div id="error_password" class="errors_reg"></div>
                </div>
                <div class="col-auto mb-150 reg_button_div">
                    <button class="donate_button reg_button">Register account</button>
                    <span class="reg_term_of_use"><br>By pressing the button above, you confirm that you agree with the Offer and Terms of use</span>
                </div>
            </form>
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
