<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    <!-- Sidebar user panel -->
	<?php if($this->session->userdata('level')){?>
    <div class="user-panel">
        <div class="pull-left image">
          <?php
            $d = $this->db->query("SELECT * FROM tbl_login WHERE id_login='$uid'")->row();
            if(!empty($d->foto !== "-")){
          ?>
          <br/>
          <img src="<?php echo base_url();?>assets/image/<?php echo $d->foto;?>" alt="#" 
		  	class="user-image" style="border:2px solid #fff;height:auto;width:100%;"/>
          <?php }else{?>
            <!--<img src="" alt="#" class="user-image" style="border:2px solid #fff;"/>-->
            <i class="fa fa-user fa-4x" style="color:#fff;"></i>
          <?php }?>
        </div>
        <div class="pull-left info" style="margin-top: 5px;">
          <p><?php echo $d->nama;?></p>
          <p><?= $d->level;?>
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
		</div>
      	<ul class="sidebar-menu" data-widget="tree">
			<?php if($this->session->userdata('level') == 'Petugas'){?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
			<li class="header">MAIN NAVIGATION</li>
			<li class="<?php if($sidebar == 'dashboard'){ echo 'active';}?>">
				<a href="<?php echo base_url('dashboard');?>">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="<?php if($this->uri->uri_string() == 'dashboard/track'){ echo 'active';}?>">
                <a href="<?php echo base_url('dashboard/track');?>">
                    <i class="fa fa-user-plus"></i> <span> Track Pengunjung</span>
                </a>
            </li>
            <li class="<?php if($this->uri->uri_string() == 'dashboard/data'){ echo 'active';}?>">
                <a href="<?php echo base_url('dashboard/data');?>">
                    <i class="fa fa-users"></i> <span> Data Pengunjung</span>
                </a>
            </li>
			<li class="<?php if($sidebar == 'user'){ echo 'active';}?>">
				<a href="<?php echo base_url('user');?>" class="cursor">
					<i class="fa fa-user"></i> <span>Data Pengguna</span></a>
			</li>
			<li class="treeview <?php if($sidebar == 'kategori'){ echo 'active';}?>
				<?php if($sidebar == 'rak'){ echo 'active';}?>
				<?php if($sidebar == 'buku_data'){ echo 'active';}?>
				<?php if($sidebar == 'buku'){ echo 'active';}?>
				<?php if($sidebar == 'jurusan'){ echo 'active';}?>">
				<a href="#">
					<i class="fa fa-pencil-square"></i>
					<span>Data </span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?php if($sidebar == 'buku_data'){ echo 'active';}?>
						<?php if($sidebar == 'buku'){ echo 'active';}?>">
						<a href="<?php echo base_url("data");?>" class="cursor">
							<span class="fa fa-book"></span> Data Buku
							
						</a>
					</li>
					<li class=" <?php if($sidebar == 'jurusan'){ echo 'active';}?>">
						<a href="<?php echo base_url("data/jurusan");?>" class="cursor">
							<span class="fa fa-cube"></span> Data Status
							
						</a>
					</li>
					<li class=" <?php if($sidebar == 'kategori'){ echo 'active';}?>">
						<a href="<?php echo base_url("data/kategori");?>" class="cursor">
							<span class="fa fa-tags"></span> Kategori
							
						</a>
					</li>
					<li class=" <?php if($sidebar == 'rak'){ echo 'active';}?>">
						<a href="<?php echo base_url("data/rak");?>" class="cursor">
							<span class="fa fa-list"></span> Rak
							
						</a>
					</li>
          		</ul>
        	</li>
			<li class="treeview 
				<?php if($sidebar == 'transaksi'){ echo 'active';}?>
				<?php if($sidebar == 'kembali'){ echo 'active';}?>
				">
				<a href="#">
					<i class="fa fa-exchange"></i>
					<span>Transaksi</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?php if($sidebar == 'transaksi'){ echo 'active';}?>">
						<a href="<?php echo base_url("transaksi");?>" class="cursor">
							<span class="fa fa-upload"></span> Peminjaman
							
						</a>
					</li>
					<li class="<?php if($sidebar == 'kembali'){ echo 'active';}?>">
						<a href="<?php echo base_url("transaksi/kembali");?>" class="cursor">
							<span class="fa fa-download"></span> Dikembalikan
						</a>
					</li>
				</ul>
			</li>
			<li class="<?php if($sidebar == 'denda'){ echo 'active';}?>">
				<a href="<?php echo base_url("transaksi/denda");?>" class="cursor">
					<i class="fa fa-money"></i> <span>Denda</span>
					
				</a>
			</li>
			<li class="<?php if($sidebar == 'atur'){ echo 'active';}?>">
				<a href="<?php echo base_url('dashboard/atur');?>">
					<i class="fa fa-cogs"></i> <span>Atur Perpustakaan</span>
				</a>
			</li>
		<?php }?>
		<?php if($this->session->userdata('level') == 'Anggota'){?>
			<li class="<?php if($sidebar == 'transaksi'){ echo 'active';}?>">
				<a href="<?php echo base_url("transaksi");?>" class="cursor">
					<i class="fa fa-upload"></i> <span>Data Peminjaman </span>
				</a>
			</li>
			<li class="<?php if($sidebar == 'kembali'){ echo 'active';}?>">
				<a href="<?php echo base_url("transaksi/kembali");?>" class="cursor">
					<i class="fa fa-download"></i> <span>Data Pengembalian </span>
				</a>
			</li>
			<li class="<?php if($sidebar == 'buku_data'){ echo 'active';}?>
			<?php if($this->uri->uri_string() == 'data/bukudetail/'.$this->uri->segment('3')){ echo 'active';}?>">
				<a href="<?php echo base_url("data");?>" class="cursor">
					<i class="fa fa-search"></i>  <span>Cari Buku</span>
				</a>
			</li>
			<li class="<?php if($sidebar == 'user'){ echo 'active';}?>">
				<a href="<?php echo base_url('user/edit/'.$this->session->userdata('ses_id'));?>" class="cursor">
					<i class="fa fa-user"></i>  <span>Data Anggota</span>
				</a>
			</li>
			<li class="">
				<a href="<?php echo base_url('user/detail/'.$this->session->userdata('ses_id'));?>" target="_blank" class="cursor">
					<i class="fa fa-print"></i> <span>Cetak kartu Anggota</span>
				</a>
			</li>
		<?php }?>
		<?php if($this->session->userdata('level') == 'Superadmin'){?>
			<li class="<?= $sidebar === 'kelola_petugas' ? 'active' : ''; ?>">
				<a href="<?= base_url(); ?>kelola_petugas" class="cursor">
					<i class="fa fa-upload"></i> <span>Kelola Petugas</span>
				</a>
			</li>
		<?php }?>
        </ul>
	<?php }else{?>
      	<ul class="sidebar-menu" data-widget="tree">
			<li class="<?php if($sidebar == 'buku_data'){ echo 'active';}?>
				<?php if($this->uri->uri_string() == 'data/bukudetail/'.$this->uri->segment('3')){ echo 'active';}?>">
				<a href="<?php echo base_url("data");?>" class="cursor">
					<i class="fa fa-search"></i>  <span>Cari Buku</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url("login");?>" class="cursor">
					<i class="fa fa-sign-in"></i>  <span>Login Area</span>
				</a>
			</li>
			<!-- <li class="<?php if($sidebar == 'register'){ echo 'active';}?>">
				<a href="<?php echo base_url("login/daftar");?>" class="cursor">
					<i class="fa fa-user-plus"></i>  <span>Register</span>
				</a>
			</li> -->
        </ul>
	<?php }?>
    </section>
    <!-- /.sidebar -->
  </aside>
