<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo base_url('assets/client_assets/images/favicon.png'); ?>">
  <title>Welcome to Admin</title>

  <!-- Bootstrap -->
  <!-- <link href="<?php echo base_url(); ?>assets/css/tb-complete-styles.css" rel="stylesheet"> -->

  <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <!-- iCheck -->

  <!-- bootstrap-progressbar -->
  <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <!-- bootstrap-daterangepicker -->

  <!-- swith -->
  <!-- Custom Theme Style -->
  <link href="<?php echo base_url(); ?>assets/css/custom.min.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>assets/css/mycustom.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <!-- <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/css/editor.dataTables.min.css" rel="stylesheet"> -->
  <link href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css" rel="stylesheet">


  <!--  <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
     <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet"> -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <style type="text/css">
    .tr-active {
      background-color: #dcf9dc !important;
    }
  </style>
  <script type="text/javascript">
    var BASE_URL = "<?php echo base_url(); ?>";
  </script>
  <style type="text/css">
    .sidebar-footer a {
      width: 33% !important;
    }

    .stepContainer {
      height: 0px;
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

    .left_col {
      background: #ffffff;
    }

    .nav_title {
      background: #02bdd5;
    }

    .nav.child_menu>li>a,
    .nav.side-menu>li>a {
      color: #1f2d3c;
      font-weight: 500;
    }

    .nav.side-menu>li>a:hover {
      color: #02bdd5 !important;
    }

    .nav.side-menu>li.active>a {
      background: #e3e3e3;
    }

    .menu_section h3 {
      text-shadow: none;
      font-size: 16px;
      color: #02bdd5;
    }

    html,
    body {
      background: white;
    }

    .nav li li.current-page a,
    .nav.child_menu li li a.active,
    .nav.child_menu li li a:hover {
      color: #02bdd5;
    }
  </style>

</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a class="site_title"> <span>Admin Portal</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic" style="margin-top: 20px; width:45%;">
              <img style="height: 70px;" src='<?php echo base_url("/assets/client_assets/images/logo.png"); ?>' alt="..." class="profile_img">
            </div>
            <div class="profile_info" style="width:55%;">
              <span>Welcome</span>
              <h2>
                <?php
                echo $user['firstname'] . " " . $user['lastname'];
                ?>
              </h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <!--  <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url("admini/dashboard"); ?>"><i class="fa fa-home"></i> Dashboard <span class="fa "></span></a>
                    
                  </li>
              </ul>
             </div> -->
            <div class="menu_section">
              <h3>Managements</h3>
              <ul class="nav side-menu">
                <li><a href="<?php echo base_url("admini/dashboard"); ?>"><i class="fa fa-list"></i> Reports</a></li>

                <li><a><i class="fa fa-dollar"></i> Finance <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?php echo base_url("admini/payment"); ?>">Paid Payment History</a></li>
                    <li><a href="<?php echo base_url("admini/payment/withdraw"); ?>">Requested Withdraw</a></li>
                    <li><a href="<?php echo base_url("admini/payment/request_refund"); ?>">Requested Refund</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-user"></i> Users <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>admini/user">User List</a></li>
                    <li><a href="<?php echo base_url() ?>admini/user/Add">Add new User</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-users"></i> Merchants <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>admini/customer/active">Activated Merchants</a></li>
                    <li><a href="<?php echo base_url() ?>admini/customer/inactive">Inactivated Merchants</a></li>
                    <li><a href="<?php echo base_url() ?>admini/customer/pending">Merchants in Pending</a></li>
                    <li><a href="<?php echo base_url() ?>admini/customer/suspended">Suspended Merchants</a></li>
                    <li><a href="<?php echo base_url() ?>admini/customer/Add">Add new Merchants</a></li>
                  </ul>
                </li>

                <li><a><i class="fa fa-question-circle"></i> Help <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>admini/help/get_support">Get Support</a></li>
                    <li><a href="<?php echo base_url() ?>admini/help/faq">Merchant Ticket Support</a></li>
                  </ul>
                </li>

                <li><a><i class="fa fa-envelope-o"></i> Email <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?php echo base_url("admini/setting/email_template"); ?>">Email Templates</a>
                    <li><a href="<?php echo base_url("admini/message"); ?>">Inbox <span class="message-count-box" style="display: none ;">100</span></a>
                    <li><a href="<?php echo base_url("admini/message/sent"); ?>">Sent</a>
                    <li><a href="<?php echo base_url("admini/message/compose"); ?>">Compose</a>

                  </ul>
                </li>



                </li>

                <li><a href="<?php echo base_url("admini/payment/paymentSetting"); ?>"><i class="fa fa-cog"></i> Site Setting</a></li>


                <!--  <li><a  href="<?php echo base_url() ?>admini/setting"><i class="fa fa-gear"></i> Site Setting </a>
                  </li> -->

              </ul>
            </div>


          </div>
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo base_url('assets/uploads/' . $user['photo']); ?>" alt="">
                  <?php echo $user['firstname'] . " " . $user['lastname']; ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="<?php echo base_url() ?>admini/user/profile"> Profile</a></li>
                  <li><a href="<?php echo base_url() ?>admini/login"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul>
              </li>

              <!-- li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> -->
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->