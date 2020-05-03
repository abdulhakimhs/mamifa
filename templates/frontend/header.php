<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?> - <?= $subtitle; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url() ?>assets/frontend/asset/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome CSS -->
    <link href="<?= base_url() ?>assets/frontend/css/font-awesome.min.css" rel="stylesheet">
    
    
    <!-- Animate CSS -->
    <link href="<?= base_url() ?>assets/frontend/css/animate.css" rel="stylesheet" >
    
    <!-- Owl-Carousel -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/css/owl.carousel.css" >
    <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/css/owl.theme.css" >
    <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/css/owl.transitions.css" >

    <!-- Custom CSS -->
    <link href="<?= base_url() ?>assets/frontend/css/custom.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/frontend/css/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/frontend/css/responsive.css" rel="stylesheet">
    
    <!-- Colors CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/css/color/light-red.css">
    
    
    
    <!-- Colors CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/css/color/light-red.css" title="light-red">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/css/color/green.css" title="green">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/css/color/blue.css" title="blue">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/css/color/light-blue.css" title="light-blue">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/css/color/yellow.css" title="yellow">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/css/color/light-green.css" title="light-green">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    
    <!-- jQuery Version 2.1.1 -->
    <script src="<?= base_url() ?>/assets/frontend/js/jquery-2.1.1.min.js"></script>
    <!-- Modernizer js -->
    <script src="<?= base_url() ?>assets/frontend/js/modernizr.custom.js"></script>
</head>

<body class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="<?= site_url('') ?>">
                    <img src="<?= base_url() ?>assets/frontend/images/logo.png" style="width: 150px; height: 30px;;" alt="">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top">Home</a>
                    </li>
                    <li <?= $this->uri->segment(1) == 'monila' ? 'class="active"' : 'class=""' ?>>
                        <a class="page-scroll" href="<?= site_url('monila') ?>">Monila</a>
                    </li>
                    <li <?= $this->uri->segment(1) == 'training_request' ? 'class="active"' : 'class=""' ?>>
                        <a class="page-scroll" href="<?= site_url('training_request') ?>">Training Request</a>
                    </li>
                    <?php if($this->uri->segment(1) == '') { ?>
                        <li >
                            <a class="page-scroll" href="#berita">News</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#partner">Partner</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a class="page-scroll" href="<?= site_url('admin/auth') ?>" target="_blank">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>