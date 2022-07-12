/.login-logo -->
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
        <!-- /.col -->
      </div>
      <br>
      <!-- <p>Belum Punya Akun ? Silahkan <a href="<?= base_url('login/daftar');?>">Daftar</a></p> -->
    </form>
  </div>


AMADA

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="px-0 content-wrapper d-flex align-items-center auth">
        <div class="mx-0 row w-100">
          <div class="mx-auto col-lg-4">
            <div class="auth-form-light text-center py-5 px-4 px-sm-5">
                <div class="brand-logo">
                <img src="<?= base_url(''); ?>" heigth="1000" alt="logo">
              </div>
              <div>Selamat Datang di</div>
              <div class="wrapper">
              <div class="typingdemo">Sistem Perpustakaan Subang</div>
              </div>
              <form class="pt-3" action="<?= base_url('login/auth');?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" id="user" name="user" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" id="pass" name="pass" required="required" autocomplete="off">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" id="loding">SIGN IN</button>
                  <a href="<?= base_url();?>" class="btn btn-danger btn-flat">Back</a>
                </div>