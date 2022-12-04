<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - MyDoc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/metisMenu.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/typography.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/default-css.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/styles.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="<?= base_url('auth/login'); ?>" method="post">
                    <div class="login-form-head">
                        <a href="">
                            <h1 style="color: #fff;font-weight:700;"><span>MyDoc</span></h1>
                        </a>
                        <p>Silahkan masukan Username & Password anda</p>
                    </div>
                    <div class="login-form-body">
                       <!-- Disini set flash data -->
                       <?=form_error(session('error'), '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                       <?=form_error(session('success'), '<div class="alert alert-success" role="alert">', '</div>'); ?>
                       
                        <div class="form-gp <?= old('login') ? 'focused' : ''; ?>">
                            <label for="username">Email/Username</label>
                            <input type="username" id="username" name="login" value="<?= old('login');?>">
                            <i class="ti-user"></i>
                            <?=form_error(session('errors.login'), '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-gp">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" value="">
                            <i class="ti-lock"></i>
                            <?=form_error(session('errors.password'), '<small class="text-danger pl-3">', '</small>'); ?>
                            <!-- form_error('password', '<small class="text-danger pl-3">', '</small>'); -->
                        </div>
                        <!-- <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="#">Forgot Password?</a>
                            </div>
                        </div> -->
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="<?= base_url(); ?>/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="<?= base_url(); ?>/assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/owl.carousel.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/metisMenu.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/jquery.slicknav.min.js"></script>

    <!-- others plugins -->
    <script src="<?= base_url(); ?>/assets/js/plugins.js"></script>
    <script src="<?= base_url(); ?>/assets/js/scripts.js"></script>
</body>

</html>