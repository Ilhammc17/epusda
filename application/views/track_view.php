<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Buku Tamu Pengunjung  <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Track Pengunjung</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                    <?php
                      if($this->input->get('tahun')){
                        $thn = $this->input->get('tahun');
                      }else{
                        $thn = date('Y');
                      }
                    ?>
                        Grafik Pengunjung Tahun <?= $thn;?>
                    </div>
                    <div class="panel-body">
                        <canvas id="line-chart" height="440"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <?= alert_bs();?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Buku Tamu Pengunjung
                    </div>
                    <div class="panel-body" style="text-align:center">
                        <form method="post" action="<?= base_url('track_pengunjung');?>">
                            <h3>Selamat Datang Di Halaman Lobby</h3>
                            <h4>Bagi Pengunjung Yang Datang, Silahkan Masukan Data Dengan Lengkap</h4>
                            <br>
                            <!-- <div class="form-group">
                                <input type="text" name="anggota_id" autofocus autocomplete="off"
                                    class="form-control form-lg" id="anggota_id"
                                    style="height:50px; font-size:16pt;"
                                    placeholder="Masukan Anggota ID" aria-describedby="helpId">
                            </div> -->

                            <?php
                              if ($this->session->success) { ?>
                                <div class="alert alert-success"><?= $this->session->success; ?></div>
                              <?php }
                            ?>
                            <?php
                              if ($this->session->failed) { ?>
                                <div class="alert alert-danger"><?= $this->session->failed; ?></div>
                              <?php }
                            ?>
                            <div class="form-group">
                                <input type="text" name="nama" autocomplete="off"
                                    class="form-control form-lg"  id="nama"
                                    style="height:50px; font-size:16pt;"
                                    placeholder="Nama Lengkap" aria-describedby="helpId">
                            </div>
                            <div class="form-group" style="text-align: left">
                              <label>Pekerjaan</label>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pekerjaan" id="exampleRadios" value="Pegawai Negeri">
                                <label class="form-check-label" for="exampleRadios">
                                  Pegawai Negeri
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pekerjaan" id="exampleRadios0" value="Pegawai Swasta">
                                <label class="form-check-label" for="exampleRadios0">
                                  Pegawai Swasta
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pekerjaan" id="exampleRadios1" value="Wiraswasta">
                                <label class="form-check-label" for="exampleRadios1">
                                  Wiraswasta
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pekerjaan" id="exampleRadios2" value="Mahasiswa">
                                <label class="form-check-label" for="exampleRadios2">
                                  Mahasiswa
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pekerjaan" id="exampleRadios3" value="Lainnya">
                                <label class="form-check-label" for="exampleRadios3">
                                  Lainnya
                                </label>
                              </div>
                            </div>
                            <div class="form-group" style="text-align: left">
                              <label>Pendidikan Terakhir</label>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pendidikan_terakhir" id="pendidikanTerakhir" value="SD">
                                <label class="form-check-label" for="pendidikanTerakhir">
                                  SD
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pendidikan_terakhir" id="pendidikanTerakhir0" value="SMP">
                                <label class="form-check-label" for="pendidikanTerakhir0">
                                  SMP
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pendidikan_terakhir" id="pendidikanTerakhir1" value="SMA">
                                <label class="form-check-label" for="pendidikanTerakhir1">
                                  SMA
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pendidikan_terakhir" id="pendidikanTerakhir2" value="S1">
                                <label class="form-check-label" for="pendidikanTerakhir2">
                                  S1
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pendidikan_terakhir" id="pendidikanTerakhir3" value="S2">
                                <label class="form-check-label" for="pendidikanTerakhir3">
                                  S2
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pendidikan_terakhir" id="pendidikanTerakhir3" value="D1">
                                <label class="form-check-label" for="pendidikanTerakhir3">
                                  D1
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pendidikan_terakhir" id="pendidikanTerakhir3" value="D3">
                                <label class="form-check-label" for="pendidikanTerakhir3">
                                  D3
                                </label>
                              </div>
                            </div>
                            <div class="form-group" style="text-align: left">
                              <label>Jenis Kelamin</label>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenkel" value="Laki - Laki">
                                <label class="form-check-label" for="jenkel">
                                  Laki - Laki
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenkel0" value="Perempuan">
                                <label class="form-check-label" for="jenkel0">
                                  Perempuan
                                </label>
                              </div>
                            </div>
                            <div class="form-group">
                              <input
                                type="text"
                                name="alamat"
                                class="form-control form-lg"
                                style="height:50px; font-size:16pt;"
                                placeholder="Alamat Lengkap"
                              >
                            </div>
                            <div class="form-group">
                              <input
                                type="text"
                                name="token"
                                class="form-control form-lg"
                                style="height:50px; font-size:16pt;"
                                placeholder="Token"
                              >
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <i class="fa fa-user-plus"></i> Tambah
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url();?>assets/adminlte/dist/js/chart.js"></script>
<script>
	$(document).ready(function(){
		$("#anggota_id").keyup(function(){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('user/get_data');?>",
				data:'anggota_id='+$(this).val(),
                dataType: "json",
				success: function(data){
					$('#nama').val(data.nama)
				}
			});
		});
	});
</script>
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
            datasets: [
                {
                  label: "Pengunjung",
                  data: [
                    <?php 
                      // php mencari produk
                      for($n=1; $n<=12; $n++){
                          if($n > 9) {
                              $m = $n;
                          }else{
                              $m = '0'.$n;
                          }
                          $gr = $this->db->query("SELECT * FROM tbl_pengunjung 
                            WHERE YEAR(created_at) = '$thn' 
                            AND MONTH(created_at) = '$m'")->num_rows();
                      ?>                                          
                      <?php echo $gr;?>,
                      <?php } ?>
                  ],
                  borderColor: '#16a862',              
                  backgroundColor: '#16a862',
                  borderWidth: 4,
                },
            ],
        },
        
        options: {
            responsive: true,
            indexAxis: 'y',
        },
    });
</script>