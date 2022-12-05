<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mydoc - Admin | <?= $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/metisMenu.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/owl.carousel.min.css">

    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Stye Datatable -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/typography.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/default-css.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/styles.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="<?= base_url(); ?>/assets/js/jq/modernizr-2.8.3.min.js"></script>
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
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <!-- <a href=""><img src="<?= base_url(); ?>/assets/images/icon/logo3.png" alt="logo"></a> -->
                    <a href="<?= base_url(); ?>" alt="logo">
                        <h1 style="color: #fff;font-weight:700;"><span>MyDoc</span></h1>
                        <h6 style="color: #fff;font-weight:100;"><span>Subtitle</span></h6>
                    </a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="<?= link_active($title, 'Dashboard'); ?>"><a href="<?= base_url('admin/dashboard'); ?>"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                            <?php if($user['role'] == 1):?>
                                <li class="<?=link_active($title, 'List Instansi');?>"><a href="<?=base_url('admin/instansi') ;?>"><i class="fa fa-ambulance"></i> <span>List Instansi</span></a></li>
                                <li class="<?=link_active($title, 'List Pasien');?>"><a href="<?=base_url('admin/pasien') ;?>"><i class="fa fa-user"></i> <span>List Pasien</span></a></li>
                            <?php elseif($user['role'] == 2):?>
                                <li class="<?=link_active($title, 'List Dokter');?>"><a href="<?=base_url('admin/dokter') ;?>"><i class="fa fa-stethoscope"></i> <span>List Dokter</span></a></li>
                                <li class="<?=link_active($title, 'Pendaftaran Berobat');?>"><a href="<?=base_url('admin/pendaftaran_berobat') ;?>"><i class="fa fa-list"></i> <span>Verifikasi Antrian</span></a></li>
                            <?php endif;?>
                            <li class="<?=link_active($title, 'Riwayat Berobat');?>"><a href="<?=base_url('admin/riwayat_berobat') ;?>"><i class="fa fa-heartbeat"></i> <span>Riwayat Berobat</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <li class="settings-btn">
                                <i class="ti-settings"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left"><?= $title; ?></h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="/">MyDoc</a></li>
                                <li><span><?= $title; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="<?= base_url(); ?>/assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?= $user['fullname']; ?><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url('user'); ?>">Edit Profil</a>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>