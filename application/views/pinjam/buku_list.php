<div class="table-responsive">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>No. Kelas</th>
            <th>Nama Kategori</th>
            <th>Title</th>
            <th>Penerbit / Tahun</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $no=1;
        $cart =  $this->db->query("SELECT * FROM tbl_keranjang 
                                    JOIN tbl_buku ON tbl_keranjang.kode_buku = tbl_buku.buku_id
                                    JOIN tbl_kategori ON tbl_buku.id_kategori = tbl_kategori.id_kategori
                                    WHERE login_id = ?",[$this->session->userdata('ses_id')])
                    ->result_array();
        foreach($cart as $items){
    ?>
        <tr>
            <td><?= $no;?></td>
            <td><?= $items['no_kelas'];?></td>
            <td><?= $items['nama_kategori'];?></td>
            <td><?= $items['nama_buku'];?></td>
            <td><?= $items['penerbit'];?> / <?= $items['tahun'];?></td>
            <td>
                <a href="javascript:void(0)" 
                    id="delete_buku<?=$no;?>" 
                    data_<?=$no;?>="<?= $items['id'];?>" 
                    class="btn btn-danger btn-xs">
                    <i class="fa fa-times"></i>
                </a>
            </td>
        </tr>
        <script>
            $(document).ready(function(){
                $("#delete_buku<?=$no;?>").click(function (e) {
                    $.ajax({
                        type: "POST", url: "<?php echo base_url('transaksi/del_cart');?>",
                        data:'kode_buku='+$(this).attr("data_<?=$no;?>"), success: function(html){
                            $("#tampil").html(html);
                        }
                    });
                });
                $('#jml<?=$no;?>').bind('keyup mouseup',function(){
                    $.ajax({
                        type: "POST", url: "<?php echo base_url('transaksi/buku?upd=yes');?>",
                        data:{
                            id : $(this).attr("data_<?=$no;?>"), 
                            jml : $(this).val(),
                        },
                        success: function(html){
                            $("#tampil").html(html);
                        }
                    });
                });
            });
        </script>
    <?php $no++;}?>
    </tbody>
</table>
<?php foreach($cart as $items){ ?>
    <input type="hidden" value="<?= $items['kode_buku'];?>" name="idbuku[]">
<?php }?>
<div id="tampil"></div>
</div>