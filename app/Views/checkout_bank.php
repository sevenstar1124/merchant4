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
  <link rel="stylesheet" href="<?php echo base_url('assets/client_assets/css/checkout.css'); ?>">

</head>

<body>

  <?php
  $publish_key = $_REQUEST['publish_key'];
  $product = get_row("product", array("publish_key" => $publish_key));
  $member = get_row("member", array("id" => $product['user_id']));
  if ($member['approve_status'] != 2 || $member['status'] == 0) {
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
  if (session()->get("warning") != "") {
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
  if (session()->get("success") != "") {
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
      <div class="navbar-header  mobile-header" style="float: left; margin-top: 10px;">
        <div class="navbar-brand mobile-header">
          <img class="mobile-img" src="<?php echo base_url('assets/client_assets/images/logo.png'); ?>" alt="" style="height: 50px;">
        </div>

        <!-- /logo -->
      </div>
      <div class="mobile-header header-title">
        checkout by echeck or bank account
      </div>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row mobile-row">
        <form id="stripe_form" name="stripe_form" method="post" action="<?php echo site_url("checkout/pay"); ?>">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-12 title">
                Billing Details
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Name <span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="name" required="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Memo <span style="color: red">*</span>(<span style="font-weight: normal;"> Brief description of the purpose of the check.</span>)</label>
                  <input type="text" class="form-control" name="memo" required="">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">Company Name(optional)</label>
                  <input type="text" class="form-control" name="company_name">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">Country<span style="color: red">*</span></label>
                  <select class="form-control" name="country" required="">
                    <option value="US">United States of America</option>
                    <?php
                    $countries = get_rows("countries");
                    foreach ($countries as $key => $country) {
                      if ($country['long_name'] == "United States of America") continue;
                      echo '<option value="' . $country['ios2'] . '">' . $country['long_name'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Street Address<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="address" required="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">&nbsp;</label>
                  <input type="text" class="form-control" name="home_type" placeholder="Apartment, suite, unit etc. (optional)">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">City<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="city" required="">
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <label for="email">State / Province <span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="state" required="">
                </div>
              </div>


              <div class="col-md-5">
                <div class="form-group">
                  <label for="email">Postcode / ZIP <span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="zip" required="">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">Phone Number<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="phone" id="phone_number" required="">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">Email Address<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="email" id="email" required="">
                </div>
              </div>
              <div class="col-md-12" style="font-size: 20px; margin-top: 20px;">
                ADDITIONAL INFORMATION
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">Order notes (optional)</label>
                  <textarea class="form-control" name="add_info" style="resize: none; height: 100px;"></textarea>
                </div>
              </div>

            </div>
          </div>
          <div class="col-md-4">
            <div class="col-md-12 title">
              <div class="pull-left" style="padding-top: 15px;">Bank Info</div>
            </div>
            <div class="col-md-12" style="margin-top:  5px;">
              <div class="form-group">
                <label for="email">Bank Account <span style="color: red">*</span></label>
                <input type="text" class="form-control" name="bank_account" required="" id="bank_account" placeholder="bank account ">
              </div>
            </div>
            <div class="col-md-12" style="margin-top:  5px;">
              <div class="form-group">
                <label for="email">Bank Routing <span style="color: red">*</span></label>
                <input type="text" class="form-control" name="bank_routing" required="" id="bank_routing" placeholder="bank routing">
              </div>
            </div>

            <?php
            $publish_key = $_REQUEST['publish_key'];
            $product = get_row("product", array("publish_key" => $publish_key));
            $payment = get_row("paymentgetway", array("id" => 1));
            $fee = $payment['checkout_fee'];

            ?>
            <div class="col-md-12" style="font-size: 20px; margin-top: 20px;">
              Product Details
              <p style="font-size: 14px; font-weight: 500; margin-top: 10px; margin-bottom: 0px;">
                <b>Product ID :</b> <?php echo $product['id']; ?>
              </p>
              <p style="font-size: 14px; font-weight: 500; margin-bottom: 5px;">
                <b>Title :</b> <?php echo $product['title']; ?>
              </p>

              <p style="font-size: 14px; font-weight: 500; margin-bottom: 5px;">
                <b>Description</b>
              </p>

              <p style="font-size: 14px; font-weight: 400; margin-bottom: 5px; padding-left: 5px;">
                <?php echo nl2br($product['description']); ?>
              </p>

              <p style="font-size: 14px; font-weight: 500; margin-bottom: 5px;">
                <b>Price :</b> $<?php echo $product['price']; ?>
              </p>

              <p style="font-size: 14px; font-weight: 500; margin-bottom: 5px;">
                <b>Fee :</b> $<?php echo $fee; ?>
              </p>

              <p style="font-size: 14px; font-weight: 500; margin-bottom: 5px;">
                <b>Total Price :</b> $<?php echo $product["price"] + $fee; ?>
              </p>

            </div>
            <div class="col-md-12">
              <button type="submit" id="pay_btn" class="btn btn-success" style="width: 100%; margin-top: 20px;">Pay now</button>
              <a href="<?php echo site_url('checkout/?publish_key=' . $publish_key); ?>" class="btn btn-info" style="width: 100%; margin-top: 20px;"><i class="fa fa-plus"></i> Back</a>
            </div>
          </div>

          <input type="hidden" name="checkout_type" value="bank">
          <input type="hidden" name="publish_key" value="<?php echo $_REQUEST["publish_key"]; ?>">
          <input type="hidden" name="price" value="<?php echo ($product["price"] + $fee); ?>">
          <?php
          $stripe_publish_key = $payment['stripe_publish_key'];
          ?>
        </form>
      </div>
    </div>
  </section>


  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <?php
  echo view('templates/footer');
  ?>
  <script type="text/javascript">
    var stripe_publish_key = "<?php echo $stripe_publish_key; ?>";
    $(function() {
      setTimeout(function() {
        $('#alert_error_wrap').hide('fast', function() {
          $('#alert_error_wrap').remove();
        });
      }, 3500);

      $("#stripe_form").submit(function(event) {
        event.preventDefault();
        error_status = "no";
        email_message = "";
        email = $("#email").val();
        if (email != "") {
          var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          if (!emailReg.test(email)) {
            error_status = "yes";
            email_message = "You have to enter correct email!" + "\n";
          }
        }

        phone_number = $("#phone_number").val();
        if (phone_number != "") {
          var phone_number_reg = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
          if (!phone_number_reg.test(phone_number)) {
            error_status = "yes";
            email_message += "You have to enter correct phone number!\n";
          }
        }

        if (error_status != "no") {
          alert(email_message);
          $("#pay_btn").removeAttr("disabled");
          return false;
        } else {
          $("#pay_btn").attr("disabled", "");
          document.stripe_form.submit();
        }
        return false;
      });
    })
  </script>