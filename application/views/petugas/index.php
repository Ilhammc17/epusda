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
      <div class="box box-primary">
        <div class="box-header with-border">
          <a href="<?= base_url(); ?> qkelola_petugas/tambah"><button class="btn btn-primary" style="margin-top:0.5pc;">
            <i class="fa fa-plus"> </i> Tambah Buku</button>
          </a>
        </div>
      <!-- /.box-header -->
      <div class="box-body">
        <br/>
        <div class="table-responsive">
          <table id="example" class="table table-bordered table-striped table table-sm" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Email</th>
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
            "ajax": {
              "url": "<?= base_url();?>kelola_petugas/data_petugas",
              "type": "POST",
            },
            "deferRender": true,
            "aLengthMenu": [[10, 25, 50],[ 10, 25, 50]], // Combobox Limit
            "columns": [
              {
                "data": 'id_login',
                "sortable": false, 
                render: (data, type, row, meta) => {
                  return meta.row + meta.settings._iDisplayStart + 1;
                },
              },
              {"data": "user"},
              {"data": "nama"},
              {"data": "telepon"},
              {"data": "email"},  
              {
                "data": "id_login",
                "render": ( data, type, row, meta ) => {
                  return `<a href="${base_url}kelola_petugas/edit/${row.id_login}" title="Edit buku" class="btn btn-success btn-sm">
                            <i class="fa fa-edit"></i>
                          </a>
                          <a href="${base_url}kelola_petugas/delete/${row.id_login}" onclick="return confirm('Anda yakin Buku ini akan dihapus ?');" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                          </a>`;
                  }
                },
            ],
        });
    });
</script>
