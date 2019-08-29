<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'mybase');
if(isset($_GET['id']))$id = $_GET['id'];
$row = $mysqli->prepare("SELECT * FROM auctions WHERE id=?");
$row->bind_param('i', $id);
$row->execute();
$row = $row->get_result();
$result = $row->fetch_assoc();

$bid = $mysqli->prepare("SELECT * FROM bets WHERE auction_id=? ORDER BY value DESC");
$bid->bind_param("i", $id);
$bid->execute();
$bid = $bid->get_result();
$bids = array();
$size = 0;
while($temp = $bid->fetch_assoc()) {
    array_push($bids, $temp);
    $size++;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="js/jquery-3-3-1-min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="media.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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


<section class="bid_info">

    <div class="container">
        <div class="row">
            <div class="col go_back_col">
                <a href="auctions.php">
                    <img src="img/arrow_back_to_list.png" class="back_to_list_arrow">
                    <span class="go_back_text">Go back to list</span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md col-12"><img class="img-fluid photo_auction_profile" src="<?='img/auctions/' . $result['name'] . '_' . $result['surname'] . '.png'?>"></div>
            <div class="col">
                <p class="name_auction"><?=$result['name'] . ' ' . $result['surname']?></p>
                <p class="text_bid"><span class="bid_categ">Time left:</span>
                    <?if((($result['exp_time'] - time()) / 86400) > 1):?><?=intval(($result['exp_time'] - time()) / 86400)?> day(s)<?endif;?>
                    <?if((($result['exp_time'] - time()) / 86400) < 1 && (($result['exp_time'] - time()) / 3600) > 1):?><?=intval(($result['exp_time'] - time()) / 3600)?> hour(s)<?endif;?><br>
                    <?if((($result['exp_time'] - time()) / 3600) < 1 && isset($result['exp_time'])):?>less than hour<?endif;?>
                    <span class="term">until <?=date('M. j, G:i', $result['exp_time'])?>(GMT+2)</span>
                </p>
                <p class="text_bid">
                    <span class="bid_categ">Current bid:</span> <span class="text_bid"><?=$bids[0]['value']?>F</span>
                </p>
                <?if($size > 0):?>
                    <p>
                        <?if($size > 1):?><span class="dop_bids_but">2 bids<img src="img/arrow_bids.png" class="dop_bids_arrow"></span><?endif;?>
                        <?if($size == 1):?><span class="dop_bids_but">1 bid<img src="img/arrow_bids.png" class="dop_bids_arrow"></span><?endif;?>
                    </p>
                    <div class="dop_bids">
                        <?if($size > 1):?>
                            <table>
                                <tr>
                                    <td><?=$bids[0]['value']?>F</td>
                                    <td><?=$bids[0]['user_name']?></td>
                                </tr>
                                <tr>
                                    <td><?=$bids[1]['value']?>F</td>
                                    <td><?=$bids[1]['user_name']?></td>
                                </tr>
                            </table>
                        <?endif;?>

                        <?if($size == 1):?>
                            <table>
                                <tr>
                                    <td><?=$bids[0]['value']?>F</td>
                                    <td><?=$bids[0]['user_name']?></td>
                                </tr>
                            </table>
                        <?endif;?>
                    </div>
                <?endif;?>
                <form id="bets_form" action="bets.php" method="post">
                    <label class="label_bid_input">
                        <input name="value" class="bid_input make_bid_button">
                        <span class="minimum_bid_notice">minimum bid: <?=$bids[0]['value'] + 50?></span>
                    </label><br>
                    <button class="donate_button make_bid_button">Place my bid</button>
                    <span class="bid_result"></span>
                </form>
<<<<<<< HEAD
                <p class="question_lot">Questions about the lot?<a href="support.php"><span class="askUs">Ask us</span></a></p>
=======
                <p class="question_lot">Questions about the lot?<span class="askUs">Ask us</span></p>
>>>>>>> d5f9862bd5b55e47676910a9b0244d454f54191f
            </div>
        </div>
        <div class="all_text_auction">
        <div class="paragraph">
            <p class="lot_description">Description</p>
            <p class="lot_text"><?=$result['description']?></p>
        </div>
        <div class="paragraph">
            <p class="lot_description">Meeting details</p>
            <p class="lot_text">Languages ​​spoken by the lot? How many people can attend a meeting at the same time?
                What is deadline for the meeting? Duration of a meeting? Length of meet and greet? May winner take a photo?
                Can winner take something small to be signed? Is meal a part of the event? Is winner responsible for the cost
                of the meal? Are alcoholic everages included? and other details...</p>
        </div>
        <div class="paragraph">
            <p class="lot_description">Rules & regulations</p>
            <p class="lot_text">Experience cannot be resold or re-auctioned. Cannot be transferred. Blackout dates may apply.
                Travel and accommodations are not included. We expect all winning bidders and their guests
                to conduct themselves appropriately when attending an experience won. Polite manners and
                respect for the generous donor and adherence to any rules or parameters are a must. To be
                scheduled at a mutually agreed upon date, based on the donor's availability. <span class="terms-of-use">Terms of use<img src="img/terms_of_use_arrow.png"></span></p>
        </div>
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

<script>
    $("#bets_form").submit(function(e){
        e.preventDefault();
        make_bet(<?=$id?>);
    })
</script>
<script src="script.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
