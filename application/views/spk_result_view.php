<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php if ($this->session->userdata('level') == 'Anggota') {
  redirect(base_url('transaksi'));
} ?>
<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      SPK
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">SPK</li>
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

            <?php foreach ($list_all_data as $index => $value) { ?>

              Centeroid <?= $index + 1 ?>
              <table class="centeroid table table-striped">
                <tr>
                  <td>C1</td>
                  <td><?= $c1[$index]['peminjam'] ?></td>
                  <td><?= $c1[$index]['pencarian'] ?></td>
                  <td><?= $c1[$index]['stok'] ?></td>
                </tr>
                <tr>
                  <td>C2</td>
                  <td><?= $c2[$index]['peminjam'] ?></td>
                  <td><?= $c2[$index]['pencarian'] ?></td>
                  <td><?= $c2[$index]['stok'] ?></td>
                </tr>
                <tr>
                  <td>C3</td>
                  <td><?= $c3[$index]['peminjam'] ?></td>
                  <td><?= $c3[$index]['pencarian'] ?></td>
                  <td><?= $c3[$index]['stok'] ?></td>
                </tr>
              </table>

              <br>

              Iteration <?= $index + 1 ?>
              <table class="iteration table table-striped">
                <tr>
                  <th>No</th>
                  <th>Klasifikasi</th>
                  <th>Sub Klasifikasi</th>
                  <th>Banyak Peminjam</th>
                  <th>Banyak Dicari</th>
                  <th>Stok</th>
                  <th>Sangat Diminati (C1)</th>
                  <th>Diminati (C2)</th>
                  <th>Tidak Diminati (C3)</th>
                  <th>Jarak Terdekat</th>
                </tr>
                <?php $no = 1;
                foreach ($value as $index2 => $value2) { ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $value2['nama_kategori'] ?></td>
                    <td><?= $value2['nama_subkategori'] ?></td>
                    <td><?= $value2['peminjam'] ?></td>
                    <td><?= $value2['pencarian'] ?></td>
                    <td><?= $value2['stok'] ?></td>
                    <td style="<?= $value2['label'] == 'c1' ? 'background-color:yellow' : '' ?>"><?= $value2['c1'] ?></td>
                    <td style="<?= $value2['label'] == 'c2' ? 'background-color:yellow' : '' ?>"><?= $value2['c2'] ?></td>
                    <td style="<?= $value2['label'] == 'c3' ? 'background-color:yellow' : '' ?>"><?= $value2['c3'] ?></td>
                    <td><?= $value2['jarak'] ?></td>
                  </tr>
                <?php } ?>
                <tr>
                  <td colspan="3">Total</td>
                  <td><?= array_sum(array_column($value, 'peminjam')) ?></td>
                  <td><?= array_sum(array_column($value, 'pencarian')) ?></td>
                  <td><?= array_sum(array_column($value, 'stok')) ?></td>
                  <td><?= array_sum(array_column($value, 'c1')) ?></td>
                  <td><?= array_sum(array_column($value, 'c2')) ?></td>
                  <td><?= array_sum(array_column($value, 'c3')) ?></td>
                  <td><?= array_sum(array_column($value, 'jarak')) ?></td>
                </tr>
              </table>
              <br>
              <br>
              <br>

            <?php } ?>

            <table class="iteration table table-striped">
              <tr>
                <th colspan="8">
                  Hasil Cluster 1 (Sangat Diminati)
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Klasifikasi</th>
                <th>Sub Klasifikasi</th>
                <th>Banyak Peminjam</th>
                <th>Banyak Dicari</th>
                <th>Stok</th>
                <th>Judul Buku</th>
                <th>Kesimpulan</th>
              </tr>
              <?php if (count($result_c1) > 0) { ?>
                <?php $no = 1;
                foreach ($result_c1 as $index => $value) { ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $value['nama_kategori'] ?></td>
                    <td><?= $value['nama_subkategori'] ?></td>
                    <td><?= $value['peminjam'] ?></td>
                    <td><?= $value['pencarian'] ?></td>
                    <td><?= $value['stok_per_buku'] ?></td>
                    <td><?= $value['judul_buku'] ?></td>
                    <td>Buku dengan subkategori tersebut adalah buku yang sangat diminati, karena memiliki jumlah penncarian dan jumlah peminjaman lebih banyak dari subkategori yang lainnya maka dari itu buku dengan subkategori ini menjadi salah satu rekomendasi buku yang akan di adakan di pengadaan !</td>
                  </tr>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="7" class="center">Data Tidak Ada</td>
                </tr>
              <?php } ?>

            </table>

            <br>
            <br>
            <br>

            <table class="iteration table table-striped">
              <tr>
                <th colspan="7">
                  Hasil Cluster 2 (Diminati)
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Klasifikasi</th>
                <th>Sub Klasifikasi</th>
                <th>Banyak Peminjam</th>
                <th>Banyak Dicari</th>
                <th>Stok</th>
                <th>Judul Buku</th>
              </tr>
              <?php if (count($result_c2) > 0) { ?>
                <?php $no = 1;
                foreach ($result_c2 as $index => $value) { ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $value['nama_kategori'] ?></td>
                    <td><?= $value['nama_subkategori'] ?></td>
                    <td><?= $value['peminjam'] ?></td>
                    <td><?= $value['pencarian'] ?></td>
                    <td><?= $value['stok'] ?></td>
                    <td><?= $value['judul_buku'] ?></td>
                  </tr>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="7" class="center">Data Tidak Ada</td>
                </tr>
              <?php } ?>

            </table>

            <br>
            <br>
            <br>

            <table class="iteration table table-striped">
              <tr>
                <th colspan="7">
                  Hasil Cluster 3 (Tidak Diminati)
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Klasifikasi</th>
                <th>Sub Klasifikasi</th>
                <th>Banyak Peminjam</th>
                <th>Banyak Dicari</th>
                <th>Stok</th>
                <th>Judul Buku</th>
              </tr>
              <?php if (count($result_c3) > 0) { ?>
                <?php $no = 1;
                foreach ($result_c3 as $index => $value) { ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $value['nama_kategori'] ?></td>
                    <td><?= $value['nama_subkategori'] ?></td>
                    <td><?= $value['peminjam'] ?></td>
                    <td><?= $value['pencarian'] ?></td>
                    <td><?= $value['stok'] ?></td>
                    <td><?= $value['judul_buku'] ?></td>
                  </tr>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="7" class="center">Data Tidak Ada</td>
                </tr>
              <?php } ?>

            </table>

            <br>

            <a href="<?= base_url('spk'); ?>" class="btn btn-danger btn-md mt-5 pull-center">Kembali</a>

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