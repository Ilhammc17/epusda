<?php if(! defined('BASEPATH')) exit('No direct script acess allowed');?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-plus" style="color:green"> </i>  <?= $title_web;?>
    </h1>
    <ol class="breadcrumb">
			<li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</a></li>
			<li class="active"><i class="fa fa-plus"></i>&nbsp;  <?= $title_web;?></li>
    </ol>
  </section>
  <section class="content">
	<?php if(!empty($this->session->flashdata())){ echo $this->session->flashdata('pesan');}?>
	<div class="row">
	    <div class="col-md-12">
	        <div class="box box-primary">
                <div class="box-header with-border">
                </div>
			    <!-- /.box-header -->
			    <div class="box-body">
                    <form action="<?php echo base_url('data/prosesbuku');?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
								<div class="form-group">
									<label>Kategori</label>
									<select class="form-control select2" required="required"  name="kategori" onchange="showSubkategori()" id="kategori">
										<option disabled selected value> -- Pilih Kategori -- </option>
										<?php foreach($kats as $isi){?>
											<option value="<?= $isi['id_kategori'];?>"><?= $isi['no_kelas'] . ' - ' . $isi['nama_kategori'];?></option>
										<?php }?>
									</select>
								</div>
								<div class="form-group">
									<label>Sub Kategori</label>
									<select class="form-control select2" required="required"  name="subkategori_id" id="subkategori"></select>
								</div>
								<div class="form-group">
									<label>Sumber</label>
									<select class="form-control select2" required="required"  name="sumber_id">
										<option disabled selected value> -- Pilih Sumber -- </option>
										<?php foreach($sumber as $isi){?>
											<option value="<?= $isi['id_sumber'];?>"><?= $isi['nama_sumber'];?></option>
										<?php }?>
                  </select>
								</div>
                                <div class="form-group">
                                    <label>Judul Buku</label>
                                    <input type="text" class="form-control" name="title" placeholder="Judul Utama">
                                    <!-- <input type="text" class="form-control" name="title" placeholder="Anak Judul">
                                    <input type="text" class="form-control" name="title" placeholder="Penanggung Jawab"> -->
                                </div>
                                <div class="form-group">
                                    <label>Nama Pengarang</label>
                                    <input type="text" class="form-control" name="pengarang" placeholder="Nama Pengarang Utama">
                                    <div class="row" id="formTambahan">
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="pengarang_tambahan[]" placeholder="Nama Pengarang Tambahan">
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="btn btn-success" onclick="addTambahan(1)"><i class="fa fa-plus"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Rak / Lokasi</label>
                                    <select name="rak" class="form-control select2" required="required">
										<option disabled selected value> -- Pilih Rak / Lokasi -- </option>
										<?php foreach($rakbuku as $isi){?>
											<option value="<?= $isi['id_rak'];?>"><?= $isi['nama_rak'];?></option>
										<?php }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>ISBN</label>
                                    <input type="text" class="form-control" name="isbn"  placeholder="Contoh ISBN : 978-602-8123-35-8">
                                </div>
                                <div class="form-group">
                                    <label>Penerbit</label>
                                    <input type="text" class="form-control" name="tempat_terbit" placeholder="Tempat Terbit">
                                    <input type="text" class="form-control" name="penerbit" placeholder="Nama Penerbit">
                                    <input type="number" class="form-control" name="thn" placeholder="Tahun Buku : 2019">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type="number" class="form-control" name="jml" placeholder="Jumlah buku : 12">
                                    <input type="file" accept="image/*" name="gambar" placeholder="Sampul">
                                    <textarea class="form-control" name="ket" id="summernotehal" style="height:120px" placeholder="Keterangan Lainnya"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
							<input type="hidden" name="tambah" value="tambah">
                            <button type="submit" class="btn btn-primary btn-md">Submit</button> 
                    </form>
                            <a href="<?= base_url('data');?>" class="btn btn-danger btn-md">Kembali</a>
                        </div>
		        </div>
	        </div>
	    </div>
    </div>
</section>
</div>
