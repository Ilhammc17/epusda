<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
  $atur =$this->db->query("SELECT * FROM tbl_atur WHERE id = 1")->row();
?>
<div class="clearfix"></div>
<footer class="main-footer">
    <div id="mycredit"><strong> Copyright &copy; <?php echo date('Y');?> <?= $atur->nama_perpus;?> 
    </strong> All rights reserved
    <div class="pull-right">
     <!-- <span id="made_with"></span> -->
    </div></div>
</footer>

<div id="logout"></div>
<!-- ./wrapper -->
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/summernote/summernote-lite.js"></script>
<script>
  var url_base = '<?php echo base_url();?>';
</script>
<script>
    $('#summernotehal').summernote({
        height: 150,
        tabsize: 1,
        direction: 'rtl',
        toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
								['view', ['fullscreen', 'help']],
								['table', ['table']],
                ],
	});
</script>
<!-- Select2 -->
<script src="<?php echo base_url();?>assets/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>

$(function() {
    //Initialize Select2 Elements
    $('.select2').select2();
});
// Restricts input for each element in the set of matched elements to the given inputFilter.
(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  };
}(jQuery));
// Install input filters.
$("#uintTextBox").inputFilter(function(value) {
  return /^\d*$/.test(value); });
// Install input filters.
$("#uintTextBox2").inputFilter(function(value) {
  return /^\d*$/.test(value); });
$("#uintTextBox3").inputFilter(function(value) {
  return /^\d*$/.test(value); });
</script>
<script>
    // notifikasi gagal di hide
    //$("#notifikasi").hide();
    var logingagal = function(){
        $("#notifikasi").fadeOut('slow');
    };
    setTimeout(logingagal, 4000);
</script> 

<!-- custom jQuery -->
<script src="<?php echo base_url();?>assets/adminlte/dist/js/custom.js"></script>

<!-- Logout Ajax -->
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/adminlte/dist/js/demo.js"></script>
<!-- PACE -->
<script src="<?php echo base_url();?>assets/adminlte/bower_components/PACE/pace.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>

<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
  const showSubkategori = () => {
    const id_kategori = $('#kategori').val();

    $.ajax({
      url: `<?= base_url(); ?>data/subkategori/data_select/${id_kategori}`,
      method: 'POST',
      success: (response) => {
        let option = '<option disabled selected value> -- Pilih Sub Kategori -- </option>';

        response.forEach(opt => {
          option += `<option value="${opt.id_subkategori}">${opt.nama_subkategori}</option>`;
        });

        $('#subkategori').html(option);
      },
      error: (e) => {
        console.log(e);
      }
    });
  }

  const addTambahan = (key) => {
    $('#formTambahan').append(
      `<div id="tambahan${key + 1}">
        <div class="col-lg-9">
          <input type="text" class="form-control" name="pengarang_tambahan[]" placeholder="Nama Pengarang Tambahan">
        </div>
        <div class="col-lg-3">
          <div class="btn btn-success" onclick="addTambahan(${key + 1})"><i class="fa fa-plus"></i></div>
          <div class="btn btn-danger" onclick="deleteTambahan(${key + 1})"><i class="fa fa-trash"></i></div>
        </div>
      </div>`
    );
  }

  const deleteTambahan = (key) => {
    $('#tambahan' + key).remove();
  }
</script>
</body>
</html>
