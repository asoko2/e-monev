<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php _e($window_title) ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<!-- Open Sans font from Google CDN -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

	<!-- Pixel Admin's stylesheets -->
	<link href="<?php echo base_url() ?>stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
	<!-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet"> -->
	<link href="<?php echo base_url() ?>stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>stylesheets/widgets.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>stylesheets/pages.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>stylesheets/themes.min.css" rel="stylesheet" type="text/css">
	
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

	<!--[if lt IE 9]>
		<script src="<?php echo base_url() ?>javascripts/ie.min.js"></script>
	<![endif]-->

	<?php if (isset($css)): ?>
		<?php $this->load->view('partial/css/' . $css); ?>
	<?php endif ?>
</head>
<body class="theme-purple-hills main-menu-animated main-navbar-fixed main-menu-fixed">

	<script>var init = [];</script>
	
	<div id="main-wrapper">
