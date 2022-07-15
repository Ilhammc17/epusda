<!DOCTYPE html>
<html>
	<head>
		<title></title>
        <style>
        #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size:9pt;
        }

        /* #customers tr:nth-child(even){background-color: #f2f2f2;} */

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
        </style>
	</head>
	<body>
    <h3 style="text-align:center;">-Data Laporan Pengunjung-</h3>
    <table id="customers">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Pekerjaan</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Kunjungan</th>
            </tr>
        </thead>
        <tbody>
          <?php 
            $no=1;
            foreach($pengunjung as $isi) { ?>
              <tr bgcolor="white">
                <td><?= $no;?></td>
                <td><?= $isi['nama'];?></td>
                <td><?= $isi['pekerjaan'];?></td>
                <td><?= $isi['jenis_kelamin'];?></td>
                <td><?= $isi['created_at'];?></td>
              </tr>
              <?php
                $no++;
              }
          ?>
        </tbody>
    </table>
    </body>
</html>
