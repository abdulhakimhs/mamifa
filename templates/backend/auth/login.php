<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Login Page - Mami FA</title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/backend/font-awesome/4.5.0/css/font-awesome.min.css" />

        <!-- text fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300&display=swap" rel="stylesheet">

        <!-- ace styles -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/ace.min.css" />

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/ace-rtl.min.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/ace-ie.min.css" />
        <![endif]-->

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="<?= base_url() ?>assets/backend/js/html5shiv.min.js"></script>
        <script src="<?= base_url() ?>assets/backend/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-layout light-login">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center">
                                <h4 class="blue" id="id-company-text"><a href=""></a> &copy; Fiber Academy Pekalongan</h4>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class="ace-icon fa fa-coffee green"></i>
                                                Please enter your information
                                            </h4>

                                            <div class="space-6"></div>

                                            <form id="login-form" action="<?= base_url() ?>admin/auth/getlogin" method="post">
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" name="email" class="form-control" placeholder="Email" />
                                                            <i class="ace-icon fa fa-user"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="password" class="form-control" placeholder="Password" />
                                                            <i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                    </label>

                                                    <div class="space"></div>

                                                    <?php
                                                        $info = $this->session->flashdata('info');
                                                        if (!empty($info)) {
                                                            echo $info;
                                                        }
                                                    ?>

                                                    <div class="clearfix">

                                                        <button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
                                                            <i class="ace-icon fa fa-key"></i>
                                                            <span class="bigger-110">Login</span>
                                                        </button>
                                                    </div>

                                                    <div class="space-4"></div>
                                                </fieldset>
                                            </form>

                                        </div><!-- /.widget-main -->

                                        <div class="toolbar clearfix" style="background: #D15B47">
                                            <div>
                                                <a href="#" data-toggle="modal" data-target="#myModal" class="forgot-password-link">
                                                    <i class="ace-icon fa fa-arrow-left"></i>
                                                    I forgot my password
                                                </a>
                                            </div>
                                        </div>
                                    </div><!-- /.widget-body -->
                                </div><!-- /.login-box -->
                            </div><!-- /.position-relative -->

                            <div class="navbar-fixed-top align-right">
                                <br />
                                &nbsp;
                                <a id="btn-login-dark" href="#">Dark</a>
                                &nbsp;
                                <span class="blue">/</span>
                                &nbsp;
                                <a id="btn-login-blur" href="#">Blur</a>
                                &nbsp;
                                <span class="blue">/</span>
                                &nbsp;
                                <a id="btn-login-light" href="#">Light</a>
                                &nbsp; &nbsp; &nbsp;
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->

        <!-- ==================== Modal ========================= -->
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Forgot your password ?</h4>
                    </div>
                    <form action="<?= site_url('admin/auth/reset_password') ?>" method="POST">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label>Please enter your email address to search for your account.</label>
                                    <input type="email" name="forgotEmail" class="form-control" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-backend" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-danger" value="Submit" name="forgotSubmit">
                        </div>
                      </div>
                    </form>
                  
                </div>
            </div>

        <!-- ==================== !Modal ========================= -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="<?= base_url() ?>assets/backend/js/jquery-2.1.4.min.js"></script>
        <script src="<?= base_url() ?>assets/backend/js/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/backend/js/bootstrap.min.js"></script>

        <!-- <![endif]-->

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            
            //you don't need this, just used for changing background
            jQuery(function($) {
             $('#btn-login-dark').on('click', function(e) {
                $('body').attr('class', 'login-layout');
                $('#id-text2').attr('class', 'white');
                $('#id-company-text').attr('class', 'blue');
                
                e.preventbackend();
             });
             $('#btn-login-light').on('click', function(e) {
                $('body').attr('class', 'login-layout light-login');
                $('#id-text2').attr('class', 'grey');
                $('#id-company-text').attr('class', 'blue');
                
                e.preventbackend();
             });
             $('#btn-login-blur').on('click', function(e) {
                $('body').attr('class', 'login-layout blur-login');
                $('#id-text2').attr('class', 'white');
                $('#id-company-text').attr('class', 'light-blue');
                
                e.preventbackend();
             });
             
            });
        </script>

<script type="text/javascript">
    $(function() {
        $('#login-form').validate({
            errorClass: "help-block",
            rules: {
                email: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            highlight: function(e) {
                $(e).closest(".form-group").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group").removeClass("has-error")
            },
        });
    });
</script>
</body>
</html>