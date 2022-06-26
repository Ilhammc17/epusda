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
	<div class="row">
	    <div class="col-md-12">
	        <div class="box box-primary">
			    <!-- /.box-header -->
			    <div class="box-body" style="padding:5px !important;">
                    <form action="<?php echo base_url('transaksi/prosespinjam');?>" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-5">
								<div class="table-responsive">
									<table class="table table-striped">
										<tr style="background:yellowgreen">
											<td colspan="3">Data Transaksi</td>
										</tr>
										<tr>
											<td>No Peminjaman</td>
											<td>:</td>
											<td>
												<input type="text" name="nopinjam" value="<?= $nop;?>" readonly class="form-control">
											</td>
										</tr>
										<tr>
											<td>Tgl Peminjaman</td>
											<td>:</td>
											<td>
												<input type="date" value="<?= date('Y-m-d');?>" name="tgl" class="form-control">
											</td>
										</tr>
										<tr>
											<td>ID Anggota</td>
											<td>:</td>
											<td>
												<div class="input-group">
													<input type="text" class="form-control" required autocomplete="off" name="anggota_id" id="search-box" placeholder="Contoh ID Anggota : AG001" type="text" value="">
													<span class="input-group-btn">
														<a data-toggle="modal" data-target="#TableAnggota" class="btn btn-primary"><i class="fa fa-search"></i></a>
													</span>
												</div>
											</td>
										</tr>
										<tr>
											<td>Biodata</td>
											<td>:</td>
											<td>
												<div id="result_tunggu"> <p style="color:red">* Belum Ada Hasil</p></div>
												<div id="result"></div>
											</td>
										</tr>
										<tr>
											<td>Lama Peminjaman</td>
											<td>:</td>
											<td>
												<input type="number" required placeholder="Lama Pinjam Contoh : 2 Hari (2)" name="lama" class="form-control">
											</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="col-sm-7">
								<div class="table-responsive">
									<table class="table table-striped ">
										<tr style="background:yellowgreen">
											<td colspan="3">Pinjam Buku</td>
										</tr>
										<tr>
											<td>Kode Buku</td>
											<td>:</td>
											<td>
												<div class="input-group">
													<input type="text" class="form-control"  autocomplete="off" name="buku_id" 
														id="buku-search" placeholder="Contoh ID Buku : BK001" type="text" value="">
													<span class="input-group-btn">
														<a data-toggle="modal" data-target="#TableBuku" class="btn btn-primary"><i class="fa fa-search"></i> Cari Buku </a>
														<!-- Button trigger modal -->
													</span>
												</div>
											</td>
										</tr>
										<tr>
											<td>Data Buku</td>
											<td>:</td>
											<td>
											</td>
										</tr>
									</table>
									<div id="result_tunggu_buku"> <p style="color:red">* Belum Ada Hasil</p></div>
									<div id="result_buku"></div>
								</div>
							</div>
						</div>
                        <div class="pull-right">
							<input type="hidden" name="tambah" value="tambah">
                            <button type="submit" class="btn btn-primary btn-md">Submit</button> 
							<a href="<?= base_url('transaksi');?>" class="btn btn-danger btn-md">Kembali</a>
						</div>
                    </form>
		        </div>
	        </div>
	    </div>
    </div>
</section>
</div>
<div class="modal fade" id="TableBuku">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add Buku</h4>
</div>
<div id="modal_body" class="modal-body fileSelection1">
    <table id="example1" class="table table-bordered table-striped" style="width:100% !important;">
		<thead>
			<tr>
				<th>No</th>
				<th>BukuID</th>
				<th>ISBN</th>
				<th style="max-width:100px;">Title</th>
				<th>Penerbit</th>
				<th>Tahun</th>
				<th>Stok</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    var base_url = '<?= base_url();?>';
    var tabel = null;
    $(document).ready(function() {
        tabel = $('#example1').DataTable({
            "processing": true,
            "responsive":true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax":
            {
                "url": "<?= base_url('data/data_buku');?>", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
            "columns": [
                {"data": 'id_buku',"sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                { "data": "buku_id",
                    "render": 
                    function( data, type, row, meta ) {
                        return `${row.buku_id}`;
                    }
                },
                { "data": "isbn" },
                { "data": "title" },  
                { "data": "penerbit" },  
                { "data": "thn_buku" }, 
                { "data": "buku_id",
                    "render": 
                    function( data, type, row, meta ) {
                        return row.jml-row.dipinjam;
                    }
                },
                { "data": "id_buku",
                    "render": 
                    function( data, type, row, meta ) {
                        return `<a href="javascript:void(0)" class="btn btn-success btn-sm pilih_buku" 
									id="Select_File2" data_id="${row.buku_id}">
									<i class="fa fa-check"> </i> 
								</a> 
								<a href="${base_url}data/bukudetail/${row.id_buku}" 
									target="_blank" title="Detail Buku"
                                    class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>`;
                        
                    }
                },
            ],
        });
    });
</script>

<script>
	$('#example1 tbody').on('click', '.pilih_buku', function(){
		document.getElementsByName('buku_id')[0].value = $(this).attr("data_id");
		$('#TableBuku').modal('hide');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('transaksi/buku');?>",
			data:'kode_buku='+$(this).attr("data_id"),
			beforeSend: function(){
				$("#result_buku").html("");
				$("#result_tunggu_buku").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
			},
			success: function(html){
				$("#result_buku").load("<?= base_url('transaksi/buku_list');?>");
				$("#result_tunggu_buku").html('');
			}
		});
	});
</script>
<script>
$(document).ready(function(){
	$("#result_tunggu_buku").html('');
	$("#result_buku").load("<?= base_url('transaksi/buku_list');?>");
	$("#buku-search").bind("keyup change",function(){
        if($(this).val().length > 3) {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('transaksi/buku');?>",
				data:'kode_buku='+$(this).val(),
				beforeSend: function(){
					$("#result_tunggu_buku").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
				},
				success: function(html){
					$("#result_buku").load("<?= base_url('transaksi/buku_list');?>");
					$("#result_tunggu_buku").html('');
				}
			});
		}
	});
});
</script>
 <!--modal import -->
 <div class="modal fade" id="TableAnggota">
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">Add Anggota</h4>
	</div>
	<div id="modal_body" class="modal-body fileSelection1">
	<table id="example3" style="width:100%;" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>ID</th>
				<th>NIM</th>
				<th>Nama</th>
				<th>Jurusan</th>
				<th>Telepon</th>
				<th>Level</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
	</div>
	</div>
	<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<script>
	// AJAX call for autocomplete 
	$(document).ready(function(){
		$("#search-box").keyup(function(){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('transaksi/result');?>",
				data:'kode_anggota='+$(this).val(),
				beforeSend: function(){
					$("#result").html("");
					$("#result_tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
				},
				success: function(html){
					$("#result").html(html);
					$("#result_tunggu").html('');
				}
			});
		});
	});
</script>
<script>
    var base_url = '<?= base_url();?>';
    var tabel = null;
    $(document).ready(function() {
        tabel = $('#example3').DataTable({
            "processing": true,
            "responsive":true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax":
            {
                "url": "<?= base_url('user/data_anggota');?>", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
            "columns": [
                {"data": 'id_login',"sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                { "data": "anggota_id" }, 
                { "data": "nim" },  
                { "data": "nama" },  
                { "data": "nama_status" },  
                { "data": "telepon" },
                { "data": "level" },    
                { "data": "id_login",
                    "render": 
                    function( data, type, row, meta ) {
                        return `<button class="btn btn-primary pilih_anggota" id="Select_File1" data_id="${row.anggota_id}">
									<i class="fa fa-check"> </i> Pilih
								</button>`;
                    }
                },
            ],
        });
    });
</script>

<script>
	$('#example3 tbody').on('click', '.pilih_anggota', function(){
		document.getElementsByName('anggota_id')[0].value = $(this).attr("data_id");
		$('#TableAnggota').modal('hide');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('transaksi/result');?>",
			data:'kode_anggota='+$(this).attr("data_id"),
			beforeSend: function(){
				$("#result").html("");
				$("#result_tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
			},
			success: function(html){
				$("#result").html(html);
				$("#result_tunggu").html('');
			}
		});
	});
</script>
