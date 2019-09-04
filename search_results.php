<?php
session_start();
$original_key = trim($_POST['search']);
$key = mb_strtolower($_POST['search']);
$mysqli = new mysqli("localhost", "root", "", "mybase");
$active = $mysqli->query("SELECT * FROM auctions");
$expired = $mysqli->query("SELECT * FROM participants");
$arr = array();
$arr2 = array();
while($result = $active->fetch_assoc()){
    $temp = array();
    $temp = explode(" ", $key);
    foreach ($temp as $value){
        if($value == mb_strtolower($result['name']) || $value == mb_strtolower($result['surname'])){
            array_push($arr, $result);
            break;
        }
    }
}

while($result = $expired->fetch_assoc()){
    $temp = array();
    $temp = explode(" ", $key);
    foreach ($temp as $value){
        if($value == mb_strtolower($result['name']) || $value == mb_strtolower($result['surname'])){
            array_push($arr2, $result);
            break;
        }
    }
}

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


<?if(empty($arr) && empty($arr2)):?>
<section class="search_no_results_section">
    <div class="container">
        <div class="row align-items-center w-100 text-center no-gutters">
            <div class="col-12 no-results_search_header text-center">Ouuuups... There are no results for "<?=$original_key?>"</div>
            <div class="col-12 tip text-center"><b>Tip:</b> if you can’t find the person you want, try to<br> write another way and try again.</div>
            <div class="col-12"><img alt="" class="no-results_img mx-auto" src="img/search_no_results.svg"></div>
        </div>
    </div>
</section>
<?endif;?>



<?if(!empty($arr) || !empty($arr2)):?>
    <section class="search_no_results_section">
        <div class="container align-items-center">
            <div class="row align-items-center w-100 text-center no-gutters">
                <div class="col-12 no-results_search_header text-center">Search results for "<?=$original_key?>"</div>
                <div class="col-12 tip text-center">If you can’t find the person you want, try to<br> write another way and try again</div>
            </div>
            <div class="row row_with_cards">
                <?foreach($arr as $value):?>
                    <div class="col-md-4 col-9 mb-5 mx-auto">
                        <div class="auction_card text-center">
                            <img alt="" class="img-fluid search_photos" src="<?="img/auctions/" . $value['name'] . "_" . $value['surname'] . ".png"?>">
                            <div class="card_tab_search px-0">
                                <span class="card_name"><?=$value['surname'] . " " . $value['name']?></span><br>
                                <span class="timer">
                                    <?if((($value['exp_time'] - time()) / 86400) > 1):?><?=intval(($value['exp_time'] - time()) / 86400)?> days left<br><?endif;?>
                                    <?if((($value['exp_time'] - time()) / 86400) < 1 && (($value['exp_time'] - time()) / 3600) > 1):?><?=intval(($value['exp_time'] - time()) / 3600)?> hours left<br><?endif;?>
                                    <?if((($value['exp_time'] - time()) / 3600) < 1 && isset($value['exp_time'])):?>less than hour<br><?endif;?>
                                    <?if(isset($value['exp_time'])):?><a href="auction.php?id=<?=$value['id']?>"><button type="submit" class="proceed_button">Proceed</button></a><?endif;?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?endforeach;?>
                <?foreach($arr2 as $value):?>
                    <div class="col-md-4 col-9 mb-5 mx-auto">
                        <div class="auction_card_expired text-center">
                            <img alt="" class="img-fluid w-100 search_photos" src="<?="img/auctions/" . $value['name'] . "_" . $value['surname'] . ".png"?>">
                            <div class="card_tab_search_expired px-0">
                                <span class="card_name_expired"><?=$value['surname'] . " " . $value['name']?></span><br>
                                <span class="timer_expired"><?if(!isset($value['exp_time'])):?>lot expired<br><a href="hero.php?id=<?=$value['id']?>"><button type="submit" class="learn-more_button">Learn more</button></a><?endif;?></span>
                            </div>
                        </div>
                    </div>
                <?endforeach;?>
                <?for ($i = 0; $i < 3 - ((count($arr)+ count($arr2)) % 3); $i++):?>
                    <div class="col-md-4 col-0"></div>
                <?endfor?>
            </div>
        </div>
    </section>
<?endif;?>

<section class="subscribe">
    <div class="container">
        <div class="row align-items-center w-100 no-gutters">
            <div class="col-12 subscribe_header text-center">Be informed about new auctions</div>

            <div class="col-12 subscribe_preHeader text-center">Subscribe. Your idol can be next!</div>
            <div class="col-12 px-0 text-center">
                <form id="subscribe_form">
                    <fieldset class="fieldset_subscribe mx-auto">
                        <legend class="legend_subscribe">Your email</legend>
                        <input type="text" name="email" class="email_subscribe mr-md-5 mr-0">
                        <input type="submit" class="submit_btn_subscribe" value="Subscribe">
                    </fieldset>
               </form>
                <div id="error_subscribe"></div>
            </div>
        </div>
    </div>
</section>


<section class="donate">
    <div class="container">
        <div class="row align-items-center w-100 no-gutters">
            <div class="col-12 donate_header text-center">Do you feel like helping a child?</div>
            <div class="col-12 px-0 text-center">
                <form>
                    <button type="submit" class="donate_button">Make donation</button>
                </form>
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
