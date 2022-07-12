<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Visitor Counter  <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Visitor Counter</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-3">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="panel panel-primary">
                              <div class="panel-heading">
                                  Pengunjung Hari ini
                              </div>
                              <div class="panel-body" style="text-align:center">
                                  <h1><?= $count_pengunjung;?></h1>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="panel panel-primary">
                            <div class="panel-heading">Generate Token</div>
                            <div class="panel-body" style="text-align:center">
                              <?= $token['token']; ?>
                              <a class="btn btn-success" href="<?= base_url('token'); ?>">Generate</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <?php
                                if($this->input->get('tahun')){
                                    $thn = $this->input->get('tahun');
                                }else{
                                    $thn = date('Y');
                                }
                                ?>
                                Grafik Perpustakaan ( Pengunjung ) Tahun <?= $thn;?>
                            </div>
                            <div class="panel-body">
                                <form method="get" action="">
                                    <div class="table-responsive">
                                    <table>
                                        <tr>
                                            <td>
                                                <select name="tahun" class="form-control">
                                                    <option value="">- Pilih Tahun Grafik -</option>
                                                    <?php
                                                        $thn_skr = date('Y');
                                                    ?>
                                                    <?php for ($x = $thn_skr; $x >= 2021; $x--){?>
                                                        <option value="<?= $x;?>" <?php if($thn == $x){?> selected <?php }?>><?= $x ;?></option>
                                                    <?php }?>
                                                </select>
                                            </td>
                                            <td style="padding-left:0.5pc;">
                                                <button type="submit" class="btn btn-primary btn-md">
                                                <i class="fa fa-search"></i></button></td>
                                            <td style="padding-left:0.5pc;">
                                                <a href="<?= base_url('dashboard');?>" class="btn btn-success btn-md">
                                                <i class="fa fa-sync"></i> Refresh</a></td>
                                        </tr>
                                    </table>
                                    </div>  
                                </form>
                                <canvas id="line-chart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(!empty($this->session->flashdata())){ ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <?= $this->session->flashdata('pesan');?>
                    </div>
                <?php }?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Data Pengunjung
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Pekerjaan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    var base_url = '<?= base_url();?>';
    var tabel = null;
    $(document).ready(function() {
        tabel = $('#example').DataTable({
            "processing": true,
            "responsive":true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax":
            {
                "url": "<?= base_url('dashboard/data_pengunjung');?>", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[10, 25, 50],[ 10, 25, 50]], // Combobox Limit
            "columns": [
                {"data": 'id',"sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                }, 
                { "data": "nama" },  
                { "data": "pekerjaan" }, 
                { "data": "jenis_kelamin" }, 
                { "data": "created_at" },  
                { "data": "id",
                    "render": 
                    function( data, type, row, meta ) {
                        return `<a href="${base_url}dashboard/delete?id=${row.id}" 
                                    onclick="return confirm('Anda yakin data ini akan dihapus ?');" 
                                    class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i></a>`;
                    }
                },
            ],
        });
    });
</script>

<script src="<?php echo base_url();?>assets/adminlte/dist/js/chart.js"></script>
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