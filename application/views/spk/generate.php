<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPK</title>
  <style>
    table,
    th,
    tr,
    td {
      border: 1px solid black;
    }

    .centeroid {
      width: 50%;
    }

    .iteration {
      width: 100%;
    }

    .center {
      text-align: center;
    }
  </style>
</head>

<body>
  <?php foreach ($list_all_data as $index => $value) { ?>

    Centeroid <?= $index + 1 ?>
    <table class="centeroid">
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
    <table class="iteration">
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

  <table class="iteration">
    <tr>
      <th colspan="7">
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

  <table class="iteration">
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

  <table class="iteration">
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
</body>

</html>