<?php
session_start();
include_once('auction_class.php');
$auctions = $mysqli->query("SELECT * FROM auctions");
$arr = array();
$i = 0;
while($result = $auctions->fetch_assoc())
{
    $e = new auction($result['id'], $result['name'], $result['surname'],$result['description'], 'img/auctions/'.$result['name'].'_'.$result['surname'].'.png', $result['exp_time']);
    $e = $e->json_type();
    array_push($arr, $e);
}

$values = $mysqli->query("SELECT value ,auction_id FROM bets ORDER BY value DESC");
$values_mass = array();
while($result = $values->fetch_assoc())
{
    array_push($values_mass, $result);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="js/jquery-3-3-1-min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="media.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
<section class="header">
    <div class="container h-100 d-none d-md-block pt-3 pb-3">
        <div class="row h-100 align-items-center no-gutters">
            <div class="col-auto pr-3 logo d-lg-block d-none"><a href="index.php"><img alt="Time for charity" src="img/logo-small.png" class="logo-img img-fluid">Time for charity</a></div>
            <div class="col-auto d-lg-none d-block"><a href="index.php"><img alt="Time for charity" src="img/logo-small.png"></a></div>
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

<section class="auctions">
<div class="container align-items-center">
    <div class="row">
        <?foreach($arr as $value):?>
        <div class="col-md-4 col-9 mb-5 mx-auto">
            <a href="auction.php?id=<?=$value['id']?>">
                <div class="auction_card">
                    <img class="img-fluid w-100" src="<?=$value['src']?>">
                    <div class="card_tab">
                        <span class="card_name"><?=$value['name'] . " " . $value['surname']?></span><br>
                        <span class="timer">
                            <div class="sand_clock"></div>
                            <?if((($value['exp_time'] - time()) / 86400) > 1):?><?=intval(($value['exp_time'] - time()) / 86400)?> day(s) left<br><?endif;?>
                            <?if((($value['exp_time'] - time()) / 86400) < 1 && (($value['exp_time'] - time()) / 3600) > 1):?><?=intval(($value['exp_time'] - time()) / 3600)?> hour(s) left<br><?endif;?>
                            <?if((($value['exp_time'] - time()) / 3600) < 1 && isset($value['exp_time'])):?>less than hour<br><?endif;?>
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <?endforeach;?>
        <?for ($i = 0; $i < 3 - (count($arr) % 3); $i++):?>
            <div class="col-md-4 col-0"></div>
        <?endfor?>
    </div>
</div>
</section>


<section class="subscribe">
    <div class="container">
        <div class="row align-items-center w-100 no-gutters">
            <div class="col-12 subscribe_header text-center">New arrivals directly to your inbox</div>

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
            <div class="col-12 donate_header text-center">Feel free to donate. Any size.</div>
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