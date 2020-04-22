<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title; ?> - <?= $subtitle; ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?= base_url() ?>assets/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="<?= base_url() ?>assets/frontend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/frontend/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="<?= base_url() ?>assets/frontend/css/landing-page.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/frontend/css/custom.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

  <style>
    .error {
      color: red;
      font-size: 11px;
    }
  </style>

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-light bg-light static-top">
  <div class="container">
    <a class="navbar-brand" href="<?= site_url() ?>">MAMI FA</a>
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#loginModal">
      <i class="icon icon-lock"></i> Login
    </button> -->
  </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="#" id="form" class="form-horizontal">
        <div class="form-group">
          <label for="username">username</label>
          <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="btnLogin" onclick="login()">Login</button>
      </div>
    </div>
  </div>
</div>

<script>
    function login()
    {
        $('#btnLogin').text('wait...'); //change button text
        $('#btnLogin').attr('disabled',true); //set button disable 
        var url;
    
        url = "<?php echo site_url('welcome/login')?>";
    
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
    
                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_table();
                    document.getElementById('pesan').innerHTML = data.pesan;
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnLogin').text('save'); //change button text
                $('#btnLogin').attr('disabled',false); //set button enable 
    
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnLogin').text('save'); //change button text
                $('#btnLogin').attr('disabled',false); //set button enable 
    
            }
        });
    }
</script>