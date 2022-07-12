<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php if ($this->session->userdata('level') == 'Anggota') {
  redirect(base_url('transaksi'));
} ?>
<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Pengadaan Buku
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pengadaan</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo base_url('spk/prosesspk'); ?>" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Klasterisasi Pengadaan Buku</label>
                    <select class="form-control select2" required="required" name="jenis_tahun" id="kategori" required>
                      <option disabled selected value> -- Pilih Berdasarkan -- </option>
                      <option value="start"> Dari Tahun </option>
                      <option value="on"> Pada Tahun </option>

                    </select>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Pada Tahun</label>
                      <input type="number" class="form-control" name="tahun" placeholder="2020" required>

                    </div>
                  </div>

                  <div class="pull-right">
                    <input type="hidden" name="tambah" value="tambah">
                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- /.content -->
<script src="<?php echo base_url(); ?>assets/adminlte/dist/js/chart.js"></script>
<script>
  var linechart = document.getElementById('line-chart');
  var chart = new Chart(linechart, {
    type: 'bar',
    data: {
      labels: [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      ], // Merubah data tanggal menjadi format JSON
      datasets: [{
        label: "Pengunjung",
        data: [
          <?php
          // php mencari produk
          for ($n = 1; $n <= 12; $n++) {
            if ($n > 9) {
              $m = $n;
            } else {
              $m = '0' . $n;
            }
            $gr = $this->db->query("SELECT * FROM tbl_pengunjung 
                          WHERE YEAR(tgl_masuk) = '$thn' 
                          AND MONTH(tgl_masuk) = '$m'")->num_rows();
          ?>
            <?php echo $gr; ?>,
          <?php } ?>
        ],
        borderColor: '#16a862',
        backgroundColor: '#16a862',
        borderWidth: 4,
      }, ],
    },

    options: {
      responsive: true,
    },
  });
</script>