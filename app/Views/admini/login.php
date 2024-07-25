<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />
  <link rel="icon" href="<?php echo base_url('assets/client_assets/images/favicon.png'); ?>">

    <title>Virsympay Admin Portal</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>assets/css/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
      .form-group{
        height: 50px;
      }
    </style>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <div style="color:red">
              <?php if(isset($error)) echo $error; ?>
            </div>
            <form action="<?php echo base_url()?>admini/login/login" method="POST">
              <h1>Login Form</h1>
              <div>
                <input type="email" name="email" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" href="index.html">Log in</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form" style="min-width: 700px; ">
          <section class="login_content" style="min-width: 700px; margin-left: -300px;" >
              <h1 style="margin: -24px 0 30px">Create Account</h1>

              <form class="form-horizontal form-label-left" novalidate="" action="<?php echo base_url(); ?>admini/login/signup" method="post" id="signup_form">

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="first_name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="first_name" placeholder="" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="last_name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="last_name" placeholder="" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                          
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password1" type="password" name="password1" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password2" type="password" name="password2" data-validate-linked="password1" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                       
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="button" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                </div>
              </div>

          </section>
        </div>
      </div>
    </div>
  </body>

  <script type="text/javascript" src="<?php echo base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/vendors/validator/validator.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/vendors/fastclick/lib/fastclick.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/vendors/nprogress/nprogress.js"></script>

  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/custom.min.js"></script>
  <script type="text/javascript">
    var url = "<?php echo base_url(); ?>";
    $(function(){

      $("body").on("click","#send",function (){
        error_msg = "";
        if($("#password1").val()!=$("#password2").val()) error_msg = "Password don't match. Please try again";
        $("#signup_form input").each(function(){
          if($(this).val() == "") error_msg = "You have to enter all fields.";
        })

        if(error_msg!=""){
          alert(error_msg);
          return; 
        }
        $.ajax({
          url: url + "admini/login/signup",
          data:{
            first_name: $("#first_name").val(),
            last_name: $("#last_name").val(),
            email: $("#email").val(),
            password: $("#password1").val()
          },
          type:"post",
          dataType:"json",
          success: function (res){
            alert(res.error_msg);
            if(res.status =="ok") document.location.reload();
          }
        })
      })
    })
  </script>
</html>
