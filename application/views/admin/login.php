<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- start: HEAD -->
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
    <!-- end: CLIP-TWO CSS -->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
</head>
<!-- end: HEAD -->
<!-- start: BODY -->
<body class="login">
<!-- start: LOGIN -->
<div class="row">
    <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="logo margin-top-30">
            <!--<img src="assets/images/logo.png" alt="Clip-Two"/>-->
            <h1>Sign In</h1>
        </div>
        <!-- start: LOGIN BOX -->
        <div class="box-login">
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo validation_errors();?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['msg_error'])){ ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo display_error(); ?>
                </div>
            <?php } ?>

            <?php if(isset($_SESSION['msg_success'])){ ?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo display_success_message(); ?>
                </div>
            <?php } ?>

                <form method="post" class="form-login" role="form" name="login" id="login">


                    <fieldset>
                    <legend>
                        Sign in to your account
                    </legend>
                    <p>
                        Please enter your email and password to log in.
                    </p>
                    <div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="email" placeholder="Email" required>
									<i class="fa fa-user"></i> </span>
                    </div>
                    <div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" placeholder="Password" maxlength="20">
									<i class="fa fa-lock"></i>
									 </span>
                    </div>
                    <div class="form-actions">
                        <div class="checkbox clip-check check-primary">
                            <input type="checkbox" id="remember_me" name="remember_me" value="1">
                            <label for="remember_me">
                                Keep me signed in
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">
                            Login <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </div>

                </fieldset>
            </form>
            <!-- start: COPYRIGHT -->
            <div class="copyright">
                &copy; <span class="current-year"></span><span class="text-bold text-uppercase"> <?php echo SYSTEM_NAME; ?></span>. <span>All rights reserved</span>
            </div>
            <!-- end: COPYRIGHT -->
        </div>
        <!-- end: LOGIN BOX -->
    </div>
</div>
<!-- end: LOGIN -->
<!-- start: MAIN JAVASCRIPTS -->
<script src="<?php echo base_url(); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/modernizr/modernizr.js"></script>
<script src="<?php echo base_url(); ?>vendor/jquery-cookie/jquery.cookie.js"></script>
<script src="<?php echo base_url(); ?>vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/switchery/switchery.min.js"></script>
<!-- end: MAIN JAVASCRIPTS -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="<?php echo base_url(); ?>vendor/jquery-validation/jquery.validate.min.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<!-- start: CLIP-TWO JAVASCRIPTS -->
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
<!-- start: JavaScript Event Handlers for this page -->
<script src="<?php echo base_url(); ?>assets/js/login.js"></script>
<script>
    jQuery(document).ready(function() {
        Main.init();
        Login.init();
    });
</script>
<!-- end: JavaScript Event Handlers for this page -->
<!-- end: CLIP-TWO JAVASCRIPTS -->

<script>
    if(typeof(Storage) !== "undefined")
    {
        // Code for localStorage/sessionStorage.
        console.log(localStorage.getItem("user_id"));
        if (localStorage.getItem("user_id") > 0) // if user selected remember me option
        {
            $('#remember_me').prop('checked', true);
            //console.log('Log user in, because user set option to remember him/her');
            window.location.href='<?php echo base_url(); ?>admin/login/remember_me/'+localStorage.getItem("user_id");
        }
    }
    else
    {
        // Sorry! No Web Storage support..
        //console.log('Sorry! No HTML5 Local Storage support in your browser..');
    }
</script>

</body>
<!-- end: BODY -->
</html>