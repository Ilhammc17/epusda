<?php if(! defined('BASEPATH')) exit('No direct script acess allowed');?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-edit" style="color:green"> </i>  <?= $title_web;?>
    </h1>
    <ol class="breadcrumb">
			<li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</a></li>
			<li class="active"><i class="fa fa-edit"></i>&nbsp;  <?= $title_web;?></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?= base_url(); ?>kelola_petugas/<?= $type === 'edit' ? 'edit/' . $id_login : 'tambah'; ?>" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" value="<?= $type === 'edit' ? $nama : ''; ?>" name="nama" placeholder="Masukan Nama">
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" value="<?= $type === 'edit' ? $user : ''; ?>" name="username" placeholder="Masukan Username">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Masukan Password">
                  </div>
                  <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" class="form-control" value="<?= $type === 'edit' ? $telepon : ''; ?>" name="telepon" placeholder="Masukan Telepon">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="<?= $type === 'edit' ? $email : ''; ?>" name="email" placeholder="Masukan Email">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-md">Submit</button>
              <a href="<?= base_url('data');?>" class="btn btn-danger btn-md">Kembali</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
