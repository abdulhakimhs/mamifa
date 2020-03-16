<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?= $title ?> - <?= $subtitle ?></title>

    <meta name="description" content="top menu &amp; navigation" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/backend/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- ace styles -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/bootstrap-datepicker3.min.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

    <script src="<?= base_url() ?>assets/backend/js/jquery-2.1.4.min.js"></script>
    <script src="<?= base_url() ?>assets/backend/js/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?= base_url() ?>assets/backend/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="<?= base_url() ?>assets/backend/js/html5shiv.min.js"></script>
    <script src="<?= base_url() ?>assets/backend/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="no-skin">
    <div id="navbar" class="navbar navbar-default navbar-collapse h-navbar ace-save-state">
      <div class="navbar-container ace-save-state" id="navbar-container">
        <div class="navbar-header pull-left">
          <a href="index.html" class="navbar-brand">
            <small>
              <i class="fa fa-leaf"></i>
              FIBER ACADEMY PEKALONGAN
            </small>
          </a>

          <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
            <span class="sr-only">Toggle user menu</span>
            <img src="<?= base_url() ?>assets/backend/images/avatars/user.jpg" alt="Jason's Photo" />
          </button>

          <button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
          <ul class="nav ace-nav">
            

            <li class="light-blue dropdown-modal user-min">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                <img class="nav-user-photo" src="<?= base_url() ?>assets/backend/images/avatars/user.jpg" alt="Jason's Photo" /> <?php echo $this->session->userdata('nama') ?>
                <span class="user-info">
                  <small>Welcome,</small>
                  <?php echo $this->session->userdata('nama') ?>
                </span>

                <i class="ace-icon fa fa-caret-down"></i>
              </a>

              <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                <li>
                  <a href="<?php echo site_url('changePassword') ?>">
                    <i class="ace-icon fa fa-cog"></i>
                    Change Password
                  </a>
                </li>

                <li class="divider"></li>

                <li>
                  <a href="<?php echo site_url('auth/logout') ?>">
                    <i class="ace-icon fa fa-power-off"></i>
                    Logout
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- /.navbar-container -->
    </div>
