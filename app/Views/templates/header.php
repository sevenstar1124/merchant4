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
  <!-- Ionicons Fonts Css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/ionicons/ionicons.min.css'); ?>">
  <!-- animate css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/animate-css/animate.css'); ?>">
  <!-- Hero area slider css-->
  <link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/slider/slider.css'); ?>">
  <!-- owl craousel css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/owl-carousel/owl.carousel.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/owl-carousel/owl.theme.css'); ?>">
  <!-- Fancybox -->
  <link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/facncybox/jquery.fancybox.css'); ?>">
  <!-- template main css file -->
  <link rel="stylesheet" href="<?php echo base_url('assets/client_assets/css/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/client_assets/css/jquery.dataTables.css'); ?>">
  <style type="text/css">
    .navbar-nav li {
      cursor: pointer;
    }

    .modal a {
      cursor: pointer;
    }

    .alert-warning {
      color: red;
    }

    @-webkit-keyframes fadeInRight {
      from {
        opacity: 0;
        -webkit-transform: translate3d(100%, 0, 0);
        transform: translate3d(100%, 0, 0);
      }

      to {
        opacity: 1;
        -webkit-transform: none;
        transform: none;
      }
    }

    @keyframes fadeInRight {
      from {
        opacity: 0;
        -webkit-transform: translate3d(100%, 0, 0);
        transform: translate3d(100%, 0, 0);
      }

      to {
        opacity: 1;
        -webkit-transform: none;
        transform: none;
      }
    }

    .fadeInRight {
      -webkit-animation-name: fadeInRight;
      animation-name: fadeInRight;
    }

    .animated {
      -webkit-animation-duration: 1s;
      animation-duration: 1s;
      -webkit-animation-fill-mode: both;
      animation-fill-mode: both;
    }

    .table .alert-danger {
      color: #a94442 !important;
      background-color: #f2dede !important;
      border-color: #ebccd1 !important;
    }

    .alert {
      padding: 10px 15px;
      font-size: 14px;
    }

    .alert:not(.float-alert) span[data-notify="icon"] {
      float: left;
      font-size: 18px;
      margin-top: 0;
    }

    .float-alert.alert span[data-notify="icon"] {
      font-size: 20px;
      display: block;
      left: 13px;
      position: absolute;
      top: 50%;
      margin-top: -11px;
    }

    .alert.float-alert .alert-title {
      margin-left: 30px;
      font-weight: 500;
    }

    body.rtl .alert.float-alert .alert-title {
      float: left;
    }

    .alert:not(.float-alert) .alert-title {
      margin-left: 10px;
    }

    .alert.float-alert button.close {
      position: absolute;
      right: 10px;
      top: 50%;
      margin-top: -13px;
      z-index: 1033;
      background-color: #FFFFFF;
      display: block;
      border-radius: 50%;
      opacity: .4;
      line-height: 11px;
      width: 25px;
      height: 25px;
      outline: 0 !important;
      text-align: center;
      padding: 3px;
      font-weight: 400;
    }

    .alert.float-alert button.close:hover {
      opacity: .55;
    }

    .alert.float-alert .close~span {
      display: block;
      max-width: 89%;
    }

    .alert.alert-dismissible button.close {
      right: -2px;
    }

    .announcement .alert-dismissible .close {
      top: -4px;
    }

    .account-siderbar {
      border: 1px solid #dedede;
      min-height: 500px;
    }

    .account-siderbar li {
      margin: 20px;
    }

    .account-siderbar li i {
      font-size: 15px;
    }

    .account-siderbar li.active a {
      color: #d87206;
    }

    .account-panel {
      border: 1px solid #dedede;
      min-height: 500px;
      padding: 20px;
    }

    .inactive-panel {
      position: relative;
    }

    .inactive-panel:after {
      content: 'Inactive Status';
      background-color: #ffffff5c;
      position: absolute;
      top: 0px;
      left: 0px;
      bottom: 0px;
      right: 0px;
      z-index: 10000;
      padding: 20px;
      font-size: 32px;
      display: flex;
      align-content: flex-start;
      justify-content: flex-end;
      color: red;
    }

    .fr-wrapper>div:first-child {
      display: none;
    }

    .fr-view {
      display: block !important;
    }

    p[data-f-id="pbf"] {
      display: none;
    }

    .message-count-box {
      display: inline-block;
      border-radius: 10px;
      text-align: center;
      font-size: 10px;
      padding-top: 4px;
      width: 20px;
      height: 20px;
      background: blue;
      color: white;
    }
  </style>
</head>

<body>

  <?php
  if (session()->get('warning') !== "") {
    // if(session()->get("warning")!=""){
  ?>
    <div id="alert_error_wrap" class="float-alert animated fadeInRight col-xs-11 col-sm-4 alert alert-danger" style="z-index: 10000; float: right; margin-top: 10px;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <span class="fa fa-bell-o" data-notify="icon"></span><span class="alert-title"><?php echo session()->get('warning'); ?></span>
    </div>

  <?php
    session()->remove('warning');
  }
  ?>

  <?php

  if (session()->get("success") != "") {
  ?>
    <div id="alert_error_wrap" class="float-alert animated fadeInRight col-xs-11 col-sm-4 alert alert-success" style="z-index: 10000; float: right; margin-top: 10px;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <span class="fa fa-bell-o" data-notify="icon"></span><span class="alert-title"><?php echo session()->get("success"); ?></span>
    </div>

  <?php
    session()->remove("success");
  }
  ?>

  <style type="text/css">
    @media(max-width: 600px) {
      .account-siderbar {
        display: none;
      }

    }
  </style>
  <!--
==================================================
Header Section Start
================================================== -->
  <header id="top-bar" class="navbar-fixed-top animated-header">
    <div class="container">
      <div class="navbar-header">
        <!-- responsive nav button -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- /responsive nav button -->

        <!-- logo -->
        <div class="navbar-brand">
          <a href="<?php echo base_url(''); ?>">
            <img src="<?php echo base_url('assets/client_assets/images/logo.png'); ?>" alt="" style="height: 50px;">
          </a>
        </div>
        <!-- /logo -->
      </div>
      <!-- main menu -->
      <nav class="collapse navbar-collapse navbar-right" role="navigation">
        <div class="main-menu">
          <ul class="nav navbar-nav navbar-right">


            <li><a href="<?php echo site_url(''); ?>">Reports</a></li>


            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <span class="caret"></span></a>
              <div class="dropdown-menu">
                <ul>
                  <li><a href="<?php echo site_url("/account/dashboard"); ?>">My Profile</a></li>
                  <li><a href="<?php echo site_url("/account/businessInfo"); ?>">Business Info</a></li>
                  <li><a href="<?php echo site_url("/account/uploadCenter"); ?>">Upload Center</a></li>
                  <li><a href="<?php echo site_url("/account/card_info"); ?>">Card Info</a></li>
                  <li><a href="<?php echo site_url("/account/register_product"); ?>">Products</a></li>
                  <li><a href="<?php echo site_url("/account/transaction_history"); ?>">Transaction History</a></li>
                  <li><a href="<?php echo site_url("/account/withdraw_money"); ?>">Withdraw Money</a></li>
                  <li><a href="<?php echo site_url("/account/inbox"); ?>">Inbox</a></li>

                </ul>
              </div>
            </li>
            <li><a href="<?php echo site_url("contact"); ?>">Contact Us</a></li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Help <span class="caret"></span></a>
              <div class="dropdown-menu">
                <ul>
                  <li><a href="<?php echo site_url("help/get_support"); ?>">Get Support</a></li>
                  <li><a href="<?php echo site_url("help/faq"); ?>">Merchant Ticket Support</a></li>
                </ul>
              </div>
            </li>
            <li><a href="<?php echo site_url("/login/logout"); ?>">Log Out</a></li>
            <li><a style="color: <?php if (session()->get("active_status") == "Pending") echo "red";
                                  else if (session()->get("active_status") == "Under Review") echo "green";
                                  else echo "blue"; ?>">Live mode : <?php echo session()->get("active_status"); ?></a></li>

          </ul>
        </div>
      </nav>
      <!-- /main nav -->
    </div>
  </header>

  <style type="text/css">
    .notification_wrap {
      position: fixed;
      z-index: 1032;
      width: 600px;
      border: 3px double #ccc;
      background: rgba(250, 255, 225, 0.9);
      right: 20px;
      top: 20px;
      padding: 20px;

    }

    .error-note {
      font-size: 14px;
      font-style: italic;
      padding-left: 10px;
      color: #8c8b8b;
      margin-bottom: 20px;
    }

    .error-title {
      margin: 0px;
      font-weight: 500;
    }
  </style>
  <?php

  if (session()->get("show_box") == "yes") {
  ?>
    <div class="notification_wrap">
      <?php
      if (session()->get("approve_status") != 2) {
      ?>
        <p class="error-title">Your account is pending to live mode.</p>
        <p class="error-note">You can't do anything on this portal before accept it. Please Accept Merchant Processing Terms To Continue.</p>
        <p class="error-title"><a href="<?php echo base_url("AcceptTerms"); ?>">View Merchant Processing Agreement</a></p>
      <?php }
      ?>
    </div>
  <?php } ?>