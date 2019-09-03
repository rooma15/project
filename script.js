
var alpha = 360;

jQuery(function ($) {
    $("#regForm").submit(function (e) {
        e.preventDefault();
        register();
    });
    $("#signInForm").submit(function (e) {
        e.preventDefault();
        sign_in();
    });
    $("#signOutForm").submit(function (e) {
        e.preventDefault();
        sign_out();
    });
    $("#form_send_msg").submit(function (e) {
        e.preventDefault();
        send_msg();
    });

    $("#subscribe_form").submit(function(e){
        e.preventDefault();
        subscribe();
    });


     $(".dop_bids_arrow").click = $(".dop_bids_but").click(function() {
         $(".dop_bids_arrow").css({'transform':'rotate('+ alpha +'deg)'});
         alpha += 180;
        if((alpha / 180)%2 !== 0)$(".dop_bids").css({'display':'block'});
        else $(".dop_bids").css({'display':'none'});
     })
});


function close_form()
{
    $(".blur").css("display", "none");
    $(".main_popup_out").css("display", "none");
    $("body").css("overflow", "visible");
    $(".input_popup").val('');
    $("#error").html('f');
    $("#error").css("visibility", "hidden");
    $("input[type='text']").css("border", "none");
    $("input[type='password']").css("border", "none");
}

function open_form()
{
    var height = window.innerHeight * 0.15 + window.pageYOffset;
    $(".blur").css("display", "block");
    $(".blur").css("margin-top", window.pageYOffset + "px");
    $(".main_popup_out").css("margin-top", height + "px");
    $(".main_popup_out").css("display", "block");
    $("body").css("overflow", "hidden");
}


window.onresize = function ()
{
    $(".blur").css("margin-top", window.pageYOffset + "px");
}


function sign_in()
{
    var isOkay = 1;
    var postdata = $("#signInForm").serialize();
    var mass = $(".logIn_input");
    for(let i=0;i<mass.length;i++){
        if(mass[i].value === ""){
            $(mass[i]).css({'border':'1px red solid'});
            isOkay = 0;
        }else{
            $(mass[i]).css({'border':'1px #cccccc solid'});
        }
    }
    if(isOkay === 1){
        $.ajax(
            {
                url: "sign.php",
                type: "post",
                data:postdata,
                success:function(){
                    location.href = "index.php";
                },
                error:function(xhr, status, error){
                    $(".logIn_errors").text(xhr.responseText);
                }
            }
        )
    }
}



function make_bet(id)
{
    var value = $("#bets_form").serialize();
    $.ajax
    (
        {
            url: "bets.php",
            type: "post",
            data:value + "&id=" + id,
            dataType: "text",
            success:function(data)
            {
                $(".bid_result").text("Successfully placed");
            },
            error:function(xhr, status, error)
            {
               $(".bid_result").text(xhr.responseText);
            }
        }
    )
}

function sign_out()
{
    $.ajax
    (
        {
            url: "sign_out.php",
            type: "post",
            success:function(data)
            {
                location.reload();
            },
            error:function(data)
            {
                console.log(data);
            }
        }
    )
}

function register() {
    $(".reg_input").css("border", "#cccccc 1px solid");
    $(".errors").html('');
    var Postdata = $("#regForm").serialize();
    $.ajax
    (
        {
            url: "reg.php",
            type: "POST",
            data: Postdata,
            dataType: "json",
            success: function (data) {
                if (data.status === "OK") {
                    location.href = "index.php";
                } else {
                    this.error(data);
                }
            },
            error: function (data) {
                console.log(data);
                for (let i = 0; i < data.size - 1; i++) {
                    $(".errors_reg").text("");
                }
                for (let i = 0; i < data.size - 1; i++) {
                    $("#" + data[i].error_code).css("border", "1px red solid");
                    $("#error_" + data[i].error_code).text(data[i].error_msg);
                }
            }
        }
    )
}



    $(".main").click(function()
    {
        if($("#menu-mobile").height() != 0){
            $("#menu-mobile").animate(
                {
                    height: "0px"
                }, 400,
                function(){}
            )
        }else{
            $("#menu-mobile").animate(
                {
                    height: "344px"
                }, 400,
                function(){}
            )
        }
    });

if (document.documentMode || /Edge/.test(navigator.userAgent)) {
    $(".edge").width(window.innerWidth);
    window.onresize = function(){
        $(".edge").width(window.innerWidth);
    };
}

$(".main").click(function(){
    var checker = 0;
    if($("#first").hasClass("first")){$("#first").attr("class", "firstRev");checker++;}
    if($("#second").hasClass("second"))$("#second").attr("class", "secondRev");
   if(checker === 0)$("#first").attr("class", "first");
   if(checker === 0)$("#second").attr("class", "second");
});

function initMap() {
    var coordinates = {lat: 47.377876, lng: 8.538775},

       map = new google.maps.Map(document.getElementById('map'), {
            center: coordinates,
            disableDefaultUI: true,
           zoom:13
        }),
        marker = new google.maps.Marker({
            position: coordinates,
            map: map
        });
}

function open_answer(id){
    if($("#" + id).css("display") === 'block'){
       $("#" + id).css("display", "none");
    }else{
        $("#" + id).css("display", "block");
    }

}

function send_msg()
{
    var postData = $("#form_send_msg").serialize();
    $.ajax(
        {
            url: "send_msg.php",
            type: "post",
            data:postData,
            dataType:"json",
            success: function(data){
                $("#supp_email").css("border-color", "#a6a6a6");
                $("#supp_msg").css("border-color", "#a6a6a6");
                if(data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        if (data[i].error_code === "email") $("#supp_email").css("border-color", "red");
                        if (data[i].error_code === "msg") $("#supp_msg").css("border-color", "red");
                    }
                }else{
                    $(".data_share").text("message sent!");
                    $(".data_share").css("color", "#a6a6a6");
                    $("#supp_email").val("");
                    $("#supp_msg").val("");
                }
            }, error: function(){
                $(".data_share").text("message not sent!");
            }
        }
    )
}

function subscribe(){
    var postData = $("#subscribe_form").serialize();
    $.ajax(
        {
            url: "subscribe.php",
            data: postData,
            type: "post",
            dataType: "json",
            success: function(data){
                    if(data.error_code === "wrong_email")$("#error_subscribe").text("Email is invalid");
                    if(data.error_code === "same_email")$("#error_subscribe").text("This email is already registered");
                    if(data.error_code === "no_email")$("#error_subscribe").text("Please write your email");
                    if(data.error_code === "ok")$("#error_subscribe").text("You are subscriber now!");
            },
            error: function(){
                $("#error_subscribe").text("an error occurred");
            }
        }
    )
}


