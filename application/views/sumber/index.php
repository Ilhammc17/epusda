<?php if(! defined('BASEPATH')) exit('No direct script acess allowed');?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-edit" style="color:green"> </i>  <?= $title_web;?>
    </h1>
    <ol class="breadcrumb">
			<li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</a></li>
			<li class="active"><i class="fa fa-file-text"></i>&nbsp; <?= $title_web;?></li>
    </ol>
  </section>
  <section class="content">
	<?php if(!empty($this->session->flashdata())){ echo $this->session->flashdata('pesan');}?>
	<div class="row">
	    <div class="col-md-12">
			<div class="row">
				<div class="col-sm-4">
					<div class="box box-primary">
						<div class="box-header with-border">
							<?php if(!empty($this->input->get('id'))){?>
							<h4> Edit Sumber</h4>
							<?php }else{?>
							<h4> Tambah Sumber</h4>
							<?php }?>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<?php if(!empty($this->input->get('id'))){?>
							<form method="post" action="<?= base_url('data/sumber/update');?>">
								<div class="form-group">
								<label for="">Nama Sumber</label>
								<input type="text" name="nama_sumber"  value="<?=$sumber->nama_sumber;?>" class="form-control"  placeholder="Contoh : Pemrograman Web" >
								
								</div>
								<br/>
								<input type="hidden" name="edit" value="<?=$sumber->id_sumber;?>">
								<button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit Sumber</button>
							</form>
							<?php }else{?>

							<form method="post" action="<?= base_url('data/sumber');?>">
								<div class="form-group">
								<label for="">Nama Sumber</label>
								<input type="text" name="nama_sumber" class="form-control" placeholder="Contoh : Pemrograman Web" >
								
								</div>
								<br/>
								<input type="hidden" name="tambah" value="tambah">
								<button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Sumber</button>
							</form>
							<?php }?>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="box box-primary">
						<div class="box-header with-border">
						</div>
						<!-- /.box-header -->
						<div class="box-body">
						<div class="table-responsive">
							<table id="example" class="table table-bordered table-striped table" width="100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Sumber</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						</div>
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
                "url": "<?= base_url('data/sumber/data');?>", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[10, 25, 50],[ 10, 25, 50]], // Combobox Limit
            "columns": [
                {"data": 'id_sumber',"sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                { "data": "nama_sumber" },  
                { "data": "id_sumber",
                    "render": 
                    function( data, type, row, meta ) {
                        return `<a href="${base_url}data/sumber?id=${row.id_sumber}" 
									class="btn btn-success"><i class="fa fa-edit"></i></a>
								<a href="${base_url}data/sumber/delete?sumber_id=${row.id_sumber}" 
									onclick="return confirm('Anda yakin Sumber ini akan dihapus ?');" 
									class="btn btn-danger"><i class="fa fa-trash"></i></a>`;
                    }
                },
            ],
        });
    });
</script>

