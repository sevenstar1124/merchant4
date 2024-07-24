<!DOCTYPE html>
<html class="no-js">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" href="<?php echo base_url('assets/client_assets/images/favicon.png'); ?>">
        <title>Merchant virsympay</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        <!-- Template CSS Files
        ================================================== -->
        <!-- Twitter Bootstrs CSS -->
        <link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/bootstrap/bootstrap.min.css'); ?>">
        
        <link rel="stylesheet" href="<?php echo base_url('assets/client_assets/css/style.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/client_assets/css/checkout.css'); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <style type="text/css">


        </style>
    </head>
    <body>

<?php
    $publish_key = $_REQUEST['publish_key'];
    $product = get_row("product",array("publish_key"=>$publish_key));
    $member = get_row("member",array("id"=>$product['user_id']));
    if($member['approve_status']!=2 || $member['status']==0){ 
?> 
<div style="position: fixed; width: 100%; height: 100%; background: white; opacity: 0.5; z-index: 10000; ">
    <p style="width: 1024px;padding: 30px;font-size: 30px;margin: 200px auto;background: black;color: white;text-align: center;">
        Merchant's account is pending to live mode. Please try later!
    </p>
</div>
<?php 
    }
?>

<?php
    if(session()->get("warning")!=""){
?>
    <div id="alert_error_wrap" class="float-alert animated fadeInRight col-xs-11 col-sm-4 alert alert-danger" style="z-index: 10000;float: right;margin-top: 10px;position: fixed;right: 0px;top: 0px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <span class="fa fa-bell-o" data-notify="icon"></span><span class="alert-title"><?php echo session()->get("warning"); ?></span>
    </div>

<?php     
    session()->remove("warning");
    }
?>

<?php
    if(session()->get("success")!=""){
?>
    <div id="alert_error_wrap" class="float-alert animated fadeInRight col-xs-11 col-sm-4 alert alert-success" style="z-index: 10000;float: right;margin-top: 10px;position: fixed;right: 0px;top: 0px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <span class="fa fa-bell-o" data-notify="icon"></span><span class="alert-title"><?php echo session()->get("success"); ?></span>
    </div>

<?php     
    session()->remove("success");
    }
?>


<!--
==================================================
Header Section Start
================================================== -->
<header id="top-bar" class="navbar-fixed-top animated-header">
    <div class="container">
        <div class="navbar-header  mobile-header" style="float: left; margin-top: 10px;" >
            <div class="navbar-brand mobile-header">
                <img class="mobile-img" src="<?php echo base_url('assets/client_assets/images/logo.png'); ?>" alt="" style="height: 50px;">
            </div>
            
        </div>
        <div class="mobile-header header-title">
            Please Select your mode of checkout
        </div>
    </div>
</header>

<section id="about">
    <div class="container">
        <div class="checkout-item-wrap">
            <div class="checkout-label">how would you like to proceed?</div>
            <a class="checkout-item" href="">
                <div class="checkout-item-logo">
                    <img src="<?php echo base_url('assets/client_assets/images/logo-wallet.png'); ?>">
                </div>
                <div class="checkout-item-text">
                    checkout by virsympay wallet express
                </div>
            </a>
            <a class="checkout-item" href="<?php echo site_url('checkout/cardCheckout/?publish_key='.$publish_key); ?>">
                <div class="checkout-item-logo">
                    <img src="<?php echo base_url('assets/client_assets/images/logo-card.png'); ?>">
                </div>
                <div class="checkout-item-text">
                    checkout by credit card
                </div>
            </a>
            <a class="checkout-item" href="<?php echo site_url('checkout/bankCheckout/?publish_key='.$publish_key); ?>">
                <div class="checkout-item-logo">
                    <img src="<?php echo base_url('assets/client_assets/images/logo-bank.png'); ?>">
                </div>
                <div class="checkout-item-text">
                    checkout by echeck or bank account
                </div>
            </a>
            <a class="checkout-item" href="">
                <div class="checkout-item-logo">
                    <img src="<?php echo base_url('assets/client_assets/images/logo-coin.png'); ?>">
                </div>
                <div class="checkout-item-text">
                    checkout by cryptocurrency
                </div>
            </a>
        </div>
    </div>
</section> 

<style type="text/css">
    .country-modal-wrap{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        background: #00000085;
        z-index: 100000;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .country-modal{
        width: 100%;
        max-width: 1024px;
        padding: 40px;
        border-radius: 5px;
        background-color: white;
        max-height: calc(100VH - 150px);
        overflow: auto;
        position: relative;
    }
    .country-title{
        font-size: 20px;
        margin-bottom: 10px;
    }
    .country-list-wrap{
        border: 1px solid #f1f1f1;
        padding: 10px 40px;
    }
    .country-list{
        /*border-bottom: 1px solid #f1f1f1;*/
    }
    .country-list div[class*='col-md']{
        padding: 10px 5px;
        border-bottom: 1px solid #f1f1f1;
    }
    .country-list:last-child {
        border-bottom: none;
    }
    @media(max-width: 768px){
        .country-modal{
            padding: 20px;
        }
    }
    .close-modal{
        position: absolute;
        right: 10px;
        top: 10px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        width: 36px;
        height: 36px;
        background-color: #ccc;
        color: white;
        cursor: pointer;
    }

</style>
<div class="country-modal-wrap" style="display: none;">
    <div class="country-modal">
        <div class="close-modal">
            <i class="fa fa-times"></i>
        </div>
        <div class="country-title">Payments can be collected from customers located in the following countries.</div>
        <div class="country-list-wrap">
            <div class="country-list">
                <div class="row">
                    <div class="col-md-4">
                        Australia
                    </div>
                    <div class="col-md-4">
                        Austria
                    </div>
                    <div class="col-md-4">
                        Belgium
                    </div>
                </div>
            </div>
            <div class="country-list">
                <div class="row">
                    <div class="col-md-4">
                        Canada
                    </div>
                    <div class="col-md-4">
                        Cyprus
                    </div>
                    <div class="col-md-4">
                        Denmark
                    </div>
                </div>
            </div>
            <div class="country-list">
                <div class="row">
                    <div class="col-md-4">
                        Estonia
                    </div>
                    <div class="col-md-4">
                        Finland
                    </div>
                    <div class="col-md-4">
                        France
                    </div>
                </div>
            </div>
            <div class="country-list">
                <div class="row">
                    <div class="col-md-4">
                        Germany
                    </div>
                    <div class="col-md-4">
                        Greece
                    </div>
                    <div class="col-md-4">
                        Ireland
                    </div>
                </div>
            </div>
            <div class="country-list">
                <div class="row">
                    <div class="col-md-4">
                        Italy
                    </div>
                    <div class="col-md-4">
                        Latvia
                    </div>
                    <div class="col-md-4">
                        Lithuania
                    </div>
                </div>
            </div>
            <div class="country-list">
                <div class="row">
                    <div class="col-md-4">
                        Luxembourg
                    </div>
                    <div class="col-md-4">
                        Malta
                    </div>
                    <div class="col-md-4">
                        Monaco
                    </div>
                </div>
            </div>
            <div class="country-list">
                <div class="row">
                    <div class="col-md-4">
                        Netherlands
                    </div>
                    <div class="col-md-4">
                        New Zealand
                    </div>
                    <div class="col-md-4">
                        Portugal
                    </div>
                </div>
            </div>
            <div class="country-list">
                <div class="row">
                    <div class="col-md-4">
                        San Marino
                    </div>
                    <div class="col-md-4">
                        Slovakia
                    </div>
                    <div class="col-md-4">
                        Slovenia
                    </div>
                </div>
            </div>
            <div class="country-list">
                <div class="row">
                    <div class="col-md-4">
                        Spain
                    </div>
                    <div class="col-md-4">
                        Sweden
                    </div>
                    <div class="col-md-4">
                        United Kingdom
                    </div>
                </div>
            </div>
            <div class="country-list">
                <div class="row">
                    <div class="col-md-12">
                        United States
                    </div>
                </div>
            </div>
        </div>

        <div class="country-title" style="margin-top: 40px;">Payments can be collected from customers in the following countries providing they have a Euro-denominated bank account.</div>
        <div class="country-list-wrap">
            <div class="country-list">
                <div class="row">
                    <div class="col-md-4">
                        Bulgaria
                    </div>
                    <div class="col-md-4">
                        Coratia
                    </div>
                    <div class="col-md-4">
                        Czech Republic
                    </div>
                </div>
            </div>
            <div class="country-list">
                <div class="row">
                    <div class="col-md-4">
                        Hungary
                    </div>
                    <div class="col-md-4">
                        Iceland
                    </div>
                    <div class="col-md-4">
                        Liechtenstein
                    </div>
                </div>
            </div>
            <div class="country-list">
                <div class="row">
                    <div class="col-md-4">
                        Norway
                    </div>
                    <div class="col-md-4">
                        Poland
                    </div>
                    <div class="col-md-4">
                        Romania
                    </div>
                </div>
            </div>
            <div class="country-list">
                <div class="row">
                    <div class="col-md-12">
                        Switzerland
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:20px; text-align:right;">
            <div class="col-md-12">
                <button class="btn btn-defalut close-modal-btn">Cancel</button>
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-success" id="continue_btn">Continue Process</button>
            </div>
        </div>
        <input type="hidden" name="" id="payment_url">
    </div>
</div> 

<?php 
    echo view('templates/footer');;
?> 
<script type="text/javascript">
    $(function(){
        $("body").on("click",".checkout-item", function(e){
            e.preventDefault();
            $(".country-modal-wrap").fadeIn();
            $("#payment_url").val($(this).attr('href'));
        })
        $("body").on("click",'#continue_btn', function(){
            document.location.replace($("#payment_url").val());
        })
        $("body").on("click", "[class*='close-modal']", function(){
            $(".country-modal-wrap").hide();
        })
    })
</script>
