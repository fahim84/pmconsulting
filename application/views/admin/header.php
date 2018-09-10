<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- start: HEAD -->
<head>
    <title><?php echo SYSTEM_NAME; ?> Admin Panel</title>
    <!-- start: META -->
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- end: META -->
    <!-- start: GOOGLE FONTS -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <!-- end: GOOGLE FONTS -->
    <!-- start: MAIN CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>vendor/themify-icons/themify-icons.min.css">
    <link href="<?php echo base_url(); ?>vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <!-- end: MAIN CSS -->
    <!-- start: CLIP-TWO CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/themes/theme-1.css" id="skin_color" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/icosouq/css/jquery-ui.css"  media="screen">
    <!-- end: CLIP-TWO CSS -->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->


    <!-- start: MAIN JAVASCRIPTS -->
    <!--<script src="<?php /*echo base_url(); */?>vendor/jquery/jquery.min.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
    <script src="<?php echo base_url(); ?>vendor/jquery-ui/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>vendor/modernizr/modernizr.js"></script>
    <script src="<?php echo base_url(); ?>vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="<?php echo base_url(); ?>vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>vendor/switchery/switchery.min.js"></script>
    <!-- end: MAIN JAVASCRIPTS -->

    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="<?php echo base_url(); ?>vendor/maskedinput/jquery.maskedinput.min.js"></script>
    <script src="<?php echo base_url(); ?>vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="<?php echo base_url(); ?>vendor/autosize/autosize.min.js"></script>
    <script src="<?php echo base_url(); ?>vendor/selectFx/classie.js"></script>
    <script src="<?php echo base_url(); ?>vendor/selectFx/selectFx.js"></script>
    <script src="<?php echo base_url(); ?>vendor/select2/select2.min.js"></script>
    <!--<script src="<?php /*echo base_url(); */?>vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php /*echo base_url(); */?>vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>-->
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

    <!-- start: CLIP-TWO JAVASCRIPTS -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- start: JavaScript Event Handlers for this page -->
    <script src="<?php echo base_url(); ?>assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>


</head>
<!-- end: HEAD -->
<body>
<div id="app">
    <?php $this->load->view('admin/left_navigation'); ?>
    <div class="app-content">
        <?php $this->load->view('admin/top_navigation'); ?>
