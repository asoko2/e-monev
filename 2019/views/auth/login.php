<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>e-Monev Bojonegoro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <!-- Open Sans font from Google CDN -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

  <!-- Pixel Admin's stylesheets -->
  <link href="<?php echo base_url() ?>stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>stylesheets/pages.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>stylesheets/themes.min.css" rel="stylesheet" type="text/css">

  <!--[if lt IE 9]>
    <script src="<?php echo base_url() ?>javascripts/ie.min.js"></script>
  <![endif]-->


<!-- $DEMO =========================================================================================

  Remove this section on production
-->
  <style>
    #signin-demo {
      position: fixed;
      right: 0;
      bottom: 0;
      z-index: 10000;
      background: rgba(0,0,0,.6);
      padding: 6px;
      border-radius: 3px;
    }
    #signin-demo img { cursor: pointer; height: 40px; }
    #signin-demo img:hover { opacity: .5; }
    #signin-demo div {
      color: #fff;
      font-size: 10px;
      font-weight: 600;
      padding-bottom: 6px;
    }
  </style>
<!-- / $DEMO -->

</head>


<!-- 1. $BODY ======================================================================================
  
  Body

  Classes:
  * 'theme-{THEME NAME}'
  * 'right-to-left'     - Sets text direction to right-to-left
-->
<body class="theme-default page-signin">

<script>
  var init = [];
  
</script>
  <!-- Page background -->
  <div id="page-signin-bg">
    <!-- Background overlay -->
    <div class="overlay"></div>
    <!-- Replace this with your bg image -->
    <img src="<?php echo base_url() ?>demo/signin-bg-1.jpg" alt="">
  </div>
  <!-- / Page background -->

  <!-- Container -->
  <div class="signin-container">

    <!-- Left side -->
    <div class="signin-info">
      <a href="index.html" class="logo">
        <img src="<?php echo base_url() ?>demo/logo-big.png" alt="" style="margin-top: -5px;">&nbsp;
        Emonev 2019
      </a> <!-- / .logo -->
      <div class="slogan">
        Simple. Flexible. Powerful.
      </div> <!-- / .slogan -->
    </div>
    <!-- / Left side -->

    <!-- Right side -->
    <div class="signin-form">

      <!-- Form -->
      <?php echo form_open("auth/login", ['id'=>'signin-form_id']);?>
        <div class="signin-text">
          <span>Sign In to your account</span>
        </div> <!-- / .signin-text -->

        <div class="form-group w-icon">
          <input type="text" name="identity" id="username_id" class="form-control input-lg" placeholder="Username or email">
          <span class="fa fa-user signin-form-icon"></span>
        </div> <!-- / Username -->

        <div class="form-group w-icon">
          <input type="password" name="password" id="password_id" class="form-control input-lg" placeholder="Password">
          <span class="fa fa-lock signin-form-icon"></span>
        </div> <!-- / Password -->

        <div class="form-actions">
          <input type="submit" value="SIGN IN" class="signin-btn bg-primary">
          <a href="http://e-monev.bojonegorokab.go.id" class="signin-btn bg-danger" >Kembali</a>
        </div> <!-- / .form-actions -->
      <?php echo form_close();?>
      <!-- / Form -->

      <!-- "Sign In with" block -->
      <div class="signin-with">
        <!-- Facebook -->
        <!-- <a href="index.html" class="signin-with-btn" style="background:#4f6faa;background:rgba(79, 111, 170, .8);">Sign In with <span>Facebook</span></a> -->
      </div>
      <!-- / "Sign In with" block -->

      
      <!-- / Password reset form -->
    </div>
    <!-- Right side -->
  </div>
  <!-- / Container -->

  <div class="not-a-member">
    <!-- Not a member? <a href="pages-signup.html">Sign up now</a> -->
  </div>

<script src="<?php echo base_url() ?>javascripts/jquery.min.js"></script>
<!-- Pixel Admin's javascripts -->
<script src="<?php echo base_url() ?>javascripts/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>javascripts/pixel-admin.min.js"></script>

<script type="text/javascript">
  // Resize BG
  init.push(function () {
    var $ph  = $('#page-signin-bg'),
        $img = $ph.find('> img');

    $(window).on('resize', function () {
      $img.attr('style', '');
      if ($img.height() < $ph.height()) {
        $img.css({
          height: '100%',
          width: 'auto'
        });
      }
    });
  });

  // Show/Hide password reset form on click
  init.push(function () {
    $('#forgot-password-link').click(function () {
      $('#password-reset-form').fadeIn(400);
      return false;
    });
    $('#password-reset-form .close').click(function () {
      $('#password-reset-form').fadeOut(400);
      return false;
    });
  });

  // Setup Sign In form validation
  init.push(function () {
    $("#signin-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });
    
    // Validate username
    $("#username_id").rules("add", {
      required: true,
      minlength: 3
    });

    // Validate password
    $("#password_id").rules("add", {
      required: true,
      minlength: 6
    });
  });

  // Setup Password Reset form validation
  init.push(function () {
    $("#password-reset-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });
    
    // Validate email
    $("#p_email_id").rules("add", {
      required: true,
      email: true
    });
  });

  window.PixelAdmin.start(init);
</script>

</body>
</html>
