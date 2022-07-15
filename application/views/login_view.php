<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title_web;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>"> 

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .navbar-inverse{
      background-color:#333;
    }
    .navbar-color{
      color:#fff;
    }
    blink, .blink {
      animation: blinker 3s linear infinite;
    }
    @keyframes blinker {
      50% { opacity: 0; }
    }
    </style>
  </head>
<body class="hold-transition login-page" style="overflow-y: hidden;background:url(
	'<?php echo base_url('assets/image/subang.jpg');?>')no-repeat;background-size:100% 100%; ">
<!-- <div class="login-box">
  <?=alert_bs();?>
  
  <div class="login-box-body text-center bg-green">
    <a href="index.php" style="color:#fff;font-size:20px !important;"><b>Sistem EPusda</b></a>
  </div>
  <div class="login-box-body" style="border:2px solid #226bbf;">
    <form action="<?= base_url('login/auth');?>" method="POST">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" id="user" name="user" required="required" autocomplete="off">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" id="pass" name="pass" required="required" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <button type="submit" id="loding" class="btn btn-primary btn-flat">Sign In</button>
          <a href="<?= base_url();?>" class="btn btn-danger btn-flat">Back</a>
        </div>
        
      </div>
      <br>
      <p>Belum Punya Akun ? Silahkan <a href="<?= base_url('login/daftar');?>">Daftar</a></p> 
    </form>
  </div>
  
  <footer>
    <div class="login-box-body text-center bg-green">
       <a style="color: #fff;"> Sistem Perpustakaan Daerah Kab. Subang - <?php echo date("Y");?>
    </div>
  </footer>
</div> -->
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="px-0 content-wrapper d-flex align-items-center auth">
        <div class="mx-0 row w-100">
          <div class="mx-auto col-lg-4">
            <div class="auth-form-light text-center py-5 px-4 px-sm-5">
                <div class="brand-logo">
                <img src="<?= base_url('assets/image/logologin.png'); ?>" heigth="1000" alt="logo">
              </div>
              <div>Selamat Datang di</div>
              <div class="wrapper">
              <div class="typingdemo">Sistem Perpustakaan Subang</div>
              </div>
              <form class="pt-3" action="<?= base_url('login/auth');?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" name="user" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="pass" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button>
                  <a href="<?= base_url();?>" class="btn btn-block btn-danger btn-lg font-weight-medium auth-form-btn">Back</a>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
<!-- /.login-box -->
<!-- Response Ajax -->
<div id="tampilkan"></div>
<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/adminlte/bower_components/jquery/dist/jquery.min.js');?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/adminlte/plugins/iCheck/icheck.min.js');?>"></script>
</body>
</html>