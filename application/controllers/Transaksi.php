<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	function __construct(){
	 	parent::__construct();
	 	//validasi jika user belum login
		$this->data['CI'] =& get_instance();
		$this->load->model('M_Admin');
		$this->load->model('M_Datatables');
		$this->load->library(array('cart'));
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}
	}
	 
	public function index()
	{	
		$this->data['title_web'] = 'Data Peminjaman Buku ';
		$this->data['uid'] = $this->session->userdata('ses_id');

		if($this->session->userdata('level') == 'Anggota'){
			if(!empty($this->input->get('bln') && $this->input->get('thn')))
			{
				$periode = $this->input->get('bln').'-'.$this->input->get('thn');
				$this->data['pinjam'] = $this->db->query(sql_transaksi()." WHERE periode = ? AND anggota_id = ?
															AND status = 'Dipinjam' ORDER BY id_pinjam DESC",[ 
															$periode, $this->session->userdata('anggota_id')
														]);
			}else{
				$this->data['pinjam'] = $this->db->query(sql_transaksi()." WHERE status = 'Dipinjam' 
															AND anggota_id = ? ORDER BY id_pinjam DESC", [
																$this->session->userdata('anggota_id')
															]);
			}
		}else{
			if(!empty($this->input->get('bln') && $this->input->get('thn')))
			{
				$periode = $this->input->get('bln').'-'.$this->input->get('thn');
				$this->data['pinjam'] = $this->db->query(sql_transaksi()." WHERE periode = ? 
															AND status = 'Dipinjam' ORDER BY id_pinjam DESC",[
																$periode
															]);
			}else{
				$this->data['pinjam'] = $this->db->query(sql_transaksi()." WHERE status = 'Dipinjam' ORDER BY id_pinjam DESC");
			}
		}

		$this->data['sidebar'] = 'transaksi';
		
		$this->load->view('header_view',$this->data);
		$this->load->view('sidebar_view',$this->data);
		$this->load->view('pinjam/pinjam_view',$this->data);
		$this->load->view('footer_view',$this->data);
	}

	public function kembali()
	{	
		$this->data['title_web'] = 'Data Pengembalian Buku ';
		$this->data['uid'] = $this->session->userdata('ses_id');

		if(!empty($this->input->get('bln') && $this->input->get('thn')))
		{
			$periode = $this->input->get('bln').'-'.$this->input->get('thn');
		}else{
			$periode = date('m-Y');
		}

		$this->data['sidebar'] = 'kembali';

		if($this->session->userdata('level') == 'Anggota'){
			$this->data['pinjam'] = $this->db->query(sql_transaksi()." WHERE periode_kembali = ? AND anggota_id = ?
										AND status = 'Di Kembalikan' ORDER BY id_pinjam DESC", [
											$periode,$this->session->userdata('anggota_id')
										]);
		}else{
			$this->data['pinjam'] = $this->db->query(sql_transaksi()." WHERE periode_kembali = ? AND status = 'Di Kembalikan' 
														ORDER BY id_pinjam DESC",[ $periode ]);
		}
		
		$this->load->view('header_view',$this->data);
		$this->load->view('sidebar_view',$this->data);
		$this->load->view('kembali/home',$this->data);
		$this->load->view('footer_view',$this->data);
	}

	public function pinjam()
	{	
		
		$this->data['nop'] = $this->M_Admin->buat_kode('tbl_pinjam','PJ','id_pinjam','ORDER BY id_pinjam DESC LIMIT 1'); 
		$this->data['uid'] = $this->session->userdata('ses_id');
        $this->data['user'] = $this->M_Admin->get_table('tbl_login');
		$this->data['buku'] = $this->db->query("SELECT * FROM tbl_buku ORDER BY id_buku DESC");

		$this->data['sidebar'] = 'transaksi';
		$this->data['title_web'] = 'Tambah Pinjam Buku ';

		$this->load->view('header_view',$this->data);
		$this->load->view('sidebar_view',$this->data);
		$this->load->view('pinjam/tambah_view',$this->data);
		$this->load->view('footer_view',$this->data);
	}

	public function cek_buku($id)
	{

		$count = $this->M_Admin->CountTableId('tbl_buku','buku_id',$id);
		if($count > 0)
		{
			$buku = $this->M_Admin->get_tableid_edit('tbl_buku','buku_id',$id);
			echo '<script>
					$("#buku-search").val("'.$id.'");
					$.ajax({
						type: "POST",
						url: "'.base_url("transaksi/buku").'",
						data:"kode_buku='.$id.'",
						success: function(html){
							$("#result_buku").load("'.base_url("transaksi/buku_list").'");
							$("#result_tunggu_buku").html("");
						}
					});
				</script>';
		}else{
			echo 'BUKU TIDAK DITEMUKAN !';
		}
	}

	public function cetak()
	{
		if(!empty($this->input->get('sortir') == 'kembali'))
		{
			if(!empty($this->input->get('bln') && $this->input->get('thn')))
			{
				$periode = $this->input->get('bln').'-'.$this->input->get('thn');
			}else{
				$periode = date('m-Y');
			}

			$this->data['pinjam'] = $this->db->query(sql_transaksi()." WHERE periode_kembali = ? 
														AND status = 'Di Kembalikan' ORDER BY id_pinjam DESC", [
															$periode
														]);

			$this->data['title_web'] = 'Print Laporan Pengembalian ';
			// filename dari pdf ketika didownload
			$file_pdf = 'Laporan-pengembalian-'.$periode;

		}else{

			if(!empty($this->input->get('bln') && $this->input->get('thn')))
			{
				$periode = $this->input->get('bln').'-'.$this->input->get('thn');
			}else{
				$periode = date('m-Y');
			}

			$this->data['pinjam'] = $this->db->query(sql_transaksi()." WHERE periode = ? AND status = 'Dipinjam' ORDER BY id_pinjam DESC",[ $periode ]);

			$this->data['title_web'] = 'Print Laporan Peminjaman ';
			// filename dari pdf ketika didownload
			$file_pdf = 'Laporan-pinjaman-'.$periode;
		}
		// panggil library yang kita buat sebelumnya yang bernama pdfgenerator
		$this->load->library('pdfgenerator');
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "landscape";

		$html = $this->load->view('pinjam/cetak',$this->data, true);	    
		// run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	}

	public function excel()
	{
		if(!empty($this->input->get('sortir') == 'kembali'))
		{
			if(!empty($this->input->get('bln') && $this->input->get('thn')))
			{
				$periode = $this->input->get('bln').'-'.$this->input->get('thn');
			}else{
				$periode = date('m-Y');
			}

			$this->data['pinjam'] = $this->db->query(sql_transaksi()."  WHERE periode_kembali = ? AND
										status = 'Di Kembalikan' ORDER BY id_pinjam DESC",[ $periode ]);

			$this->data['title_web'] = 'Print Laporan Pengembalian ';
			// filename dari pdf ketika didownload
			$file_pdf = 'Laporan-pengembalian-'.$periode;
		}else{

			if(!empty($this->input->get('bln') && $this->input->get('thn')))
			{
				$periode = $this->input->get('bln').'-'.$this->input->get('thn');
			}else{
				$periode = date('m-Y');
			}
			$this->data['pinjam'] = $this->db->query(sql_transaksi()."  WHERE periode_kembali = ? AND
										status = 'Dipinjam' ORDER BY id_pinjam DESC",[ $periode ]);
			$this->data['title_web'] = 'Print Laporan Peminjaman ';
			// filename dari pdf ketika didownload
			$file_pdf = 'Laporan-pinjaman-'.$periode;
		}

		// fungsi header dengan mengirimkan raw data excel
    header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		// membuat nama file ekspor "export-to-excel.xls"
		header("Content-Disposition: attachment; filename=".$file_pdf.".xls");
  
		// filename dari pdf ketika didownload
		$this->load->view('pinjam/cetak',$this->data);	    
	}
	
	public function detailpinjam()
	{
		$this->data['uid'] = $this->session->userdata('ses_id');		
		$id = $this->uri->segment('3');
		if($this->session->userdata('level') == 'Anggota'){
			$count = $this->db->get_where('tbl_pinjam',[
				'pinjam_id' => $id, 
				'anggota_id' => $this->session->userdata('anggota_id')
			])->num_rows();
			if($count > 0)
			{
				$this->data['pinjam'] = $this->db->query(sql_transaksi()."  WHERE pinjam_id = ? AND anggota_id =?", 
											[$id,$this->session->userdata('anggota_id')])->row();
			}else{
				echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="'.base_url('transaksi').'"</script>';
			}
		}else{
			$count = $this->M_Admin->CountTableId('tbl_pinjam','pinjam_id',$id);
			if($count > 0)
			{
				$this->data['pinjam'] = $this->db->query(sql_transaksi()." WHERE pinjam_id = '$id'")->row();
			}else{
				echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="'.base_url('transaksi').'"</script>';
			}
		}

		$this->data['sidebar'] = 'kembali';
		$this->data['title_web'] = 'Detail Pinjam Buku ';
		$this->load->view('header_view',$this->data);
		$this->load->view('sidebar_view',$this->data);
		$this->load->view('pinjam/detail',$this->data);
		$this->load->view('footer_view',$this->data);
	}

	public function kembalipinjam()
	{
		$this->data['uid'] = $this->session->userdata('ses_id');		
		$id = $this->uri->segment('3');
		$count = $this->M_Admin->CountTableId('tbl_pinjam','pinjam_id',$id);
		if($count > 0)
		{
			$this->data['pinjam'] = $this->db->query(sql_transaksi()." WHERE pinjam_id = '$id'")->row();
		}else{
			echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="'.base_url('transaksi').'"</script>';
		}

		$this->data['sidebar'] = 'transaksi';

		$this->data['title_web'] = 'Kembali Pinjam Buku ';
		$this->load->view('header_view',$this->data);
		$this->load->view('sidebar_view',$this->data);
		$this->load->view('pinjam/kembali',$this->data);
		$this->load->view('footer_view',$this->data);
	}

	public function prosespinjam()
	{
		$post = $this->input->post();
		if(!empty($post['tambah']))
		{

			$tgl = $post['tgl'];
			$tgl2 = date('Y-m-d', strtotime('+'.$post['lama'].' days', strtotime($tgl)));
			$hasil_cart = $this->db->query("SELECT * FROM tbl_keranjang WHERE login_id = ?",[$this->session->userdata('ses_id')])
							->result_array();
      
      if ($hasil_cart) {
        foreach($hasil_cart as $isi)
        {
          $id = $isi['kode_buku'];
          $data = array(
            'pinjam_id' => htmlentities($post['nopinjam']), 
            'anggota_id' => htmlentities($post['anggota_id']), 
            'buku_id' => $id, 
            'status' => 'Dipinjam', 
            'jml' => $isi['jml'],
            'tgl_pinjam' => htmlentities($post['tgl']), 
            'lama_pinjam' => htmlentities($post['lama']), 
            'tgl_balik'  => $tgl2, 
            'tgl_kembali'  => '0',
            'periode'	=> date('m-Y')
          );
          $this->db->insert('tbl_pinjam',$data);
          $dd = $this->db->query("SELECT sum(jml) as jml FROM tbl_pinjam WHERE buku_id= '$id' AND status = 'Dipinjam'");
          $jml = $dd->row();
          $data_update[] = array(
            'buku_id' => $id,
            'dipinjam' => $jml->jml
          );
        }
        $total_array = count($data);
        if($total_array != 0)
        {
          // $this->db->insert_batch('tbl_pinjam',$data);
          $this->db->update_batch('tbl_buku',$data_update,'buku_id');
          unset_cart();
        }
  
        $this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
                  <p> Tambah Pinjam Buku Sukses !</p>
                </div></div>');
  
        redirect(base_url('transaksi'));
      } else {
        $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
          <p>Pilih buku terlebih dahulu!</p>
          </div></div>'
        );
        redirect($_SERVER['HTTP_REFERER']);
      }
		}

		if($this->input->get('pinjam_id'))
		{
			$this->M_Admin->delete_table('tbl_pinjam','pinjam_id',$this->input->get('pinjam_id'));
			$this->M_Admin->delete_table('tbl_denda','pinjam_id',$this->input->get('pinjam_id'));

			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
					<p>  Hapus Transaksi Pinjam Buku Sukses !</p>
				</div></div>');
				
			if($this->input->get('tipe') == 'kembali'){
				redirect(base_url('transaksi/kembali')); 
			}else{
				redirect(base_url('transaksi')); 
			}
		}

		if($this->input->get('kembali'))
		{
			$id = $this->input->get('kembali');
			$pinjam = $this->db->query("SELECT  * FROM tbl_pinjam WHERE pinjam_id = '$id'");

			foreach($pinjam->result_array() as $isi){
				$pinjam_id = $isi['pinjam_id'];
				$jml = $this->db->query("SELECT sum(jml) as jml FROM tbl_pinjam WHERE pinjam_id = '$pinjam_id'")->row();	
				$jml = $jml->jml;	
				// $date1 = date('Ymd');
				// $date2 = preg_replace('/[^0-9]/','',$isi['tgl_balik']);
				// $diff = $date2 - $date1;

				$now = time(); // or your date as well
				$your_date = strtotime($isi['tgl_balik']);
				$datediff = $now - $your_date;
				$tenggat = round($datediff / (60 * 60 * 24));

				if($tenggat > 0 )
				{
					$dd = $this->M_Admin->get_tableid_edit('tbl_biaya_denda','stat','Aktif'); 
					$harga_denda = $jml*($dd->harga_denda*abs($tenggat));
					$lama_waktu = abs($tenggat);
				}else{
					$harga_denda = 0;
					$lama_waktu = 0;
				}
				
			}

			$data = array(
				'status' => 'Di Kembalikan', 
				'tgl_kembali'  => date('Y-m-d'),
				'periode_kembali' => date('m-Y')
			);

			$total_array = count($data);
			if($total_array != 0)
			{	
				$this->db->where('pinjam_id',$this->input->get('kembali'));
				$this->db->update('tbl_pinjam',$data);
			}

			$data_denda = array(
				'pinjam_id' => $this->input->get('kembali'), 
				'denda' => $harga_denda, 
				'lama_waktu'=>$lama_waktu, 
				'tgl_denda'=> date('Y-m-d'),
			);
			
			$this->db->insert('tbl_denda',$data_denda);

			$pinjam2 = $this->db->query("SELECT  * FROM tbl_pinjam WHERE pinjam_id = '$id'");

			foreach($pinjam2->result_array() as $isi){
				$buku = $isi['buku_id'];
				$dd = $this->db->query("SELECT sum(jml) as jml FROM tbl_pinjam WHERE buku_id = ? AND status = 'Dipinjam'", array($buku));
				$jml = $dd->row();
				$data_update[] = array(
					'buku_id' => $buku,
					'dipinjam' => $jml->jml
				);
			}

			$total_array = count($data_update);
			if($total_array != 0)
			{	
				$this->db->update_batch('tbl_buku', $data_update ,'buku_id');
			}

			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
					<p> Pengembalian Pinjam Buku Sukses !</p>
					</div></div>');

			redirect(base_url('transaksi')); 

		}
	}

	public function denda()
	{
		$this->data['uid'] = $this->session->userdata('ses_id');	

		$this->data['sidebar'] = 'denda';
		$this->data['denda'] =  $this->db->query("SELECT * FROM tbl_biaya_denda ORDER BY id_biaya_denda DESC");

		if(!empty($this->input->get('id'))){
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_biaya_denda','id_biaya_denda',$id);
			if($count > 0)
			{			
				$this->data['den'] = $this->db->query("SELECT *FROM tbl_biaya_denda WHERE id_biaya_denda='$id'")->row();
			}else{
				echo '<script>alert("KATEGORI TIDAK DITEMUKAN");window.location="'.base_url('transaksi/denda').'"</script>';
			}
		}

		$this->data['title_web'] = ' Denda ';
		$this->load->view('header_view',$this->data);
		$this->load->view('sidebar_view',$this->data);
		$this->load->view('denda/denda_view',$this->data);
		$this->load->view('footer_view',$this->data);
	}

	public function dendaproses()
	{
		if(!empty($this->input->post('tambah'))){
			$this->form_validation->set_rules('harga', 'harga', 'required', ['required' => 'Harga Denda Harus Diisi!']);
			
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
            <p>' . validation_errors() . '</p>
          </div></div>');
		} else {
			$dendaUnique  = $this->db->like('denda', $this->input->post('harga_denda'))->get('tbl_denda');
			if ($dendaUnique->num_rows() <= 0) {
			$post= $this->input->post();
			$data = array(
				'harga_denda'=>$post['harga'],
				'stat'=>'Tidak Aktif',
				'tgl_tetap' => date('Y-m-d')
			);

			$this->db->insert('tbl_biaya_denda', $data);
			
			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah Harga Denda Sukses!</p>
			</div></div>');
					  redirect(base_url('data/rak'));
				  } else {
					  $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
				<p>Harga Denda sudah ada!</p>
			  </div></div>');
				  }
			  }
			  redirect($_SERVER['HTTP_REFERER']);
		  }

		if(!empty($this->input->post('edit')))
		{
			$dd = $this->M_Admin->get_tableid('tbl_biaya_denda','stat','Aktif');
			foreach($dd as $isi)
			{
				$data1 = array(
					'stat'=>'Tidak Aktif',
				);
				$this->db->where('id_biaya_denda',$isi['id_biaya_denda']);
				$this->db->update('tbl_biaya_denda', $data1);
			}

			$post= $this->input->post();
			$data = array(
				'harga_denda'=>htmlentities($post['harga']),
				'stat'=>$post['status'],
				'tgl_tetap' => date('Y-m-d')
			);

			$this->db->where('id_biaya_denda',$post['edit']);
			$this->db->update('tbl_biaya_denda', $data);


			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Harga Denda  Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/denda')); 	
		}

		if(!empty($this->input->get('denda_id')))
		{
			$this->db->where('id_biaya_denda',$this->input->get('denda_id'));
			$this->db->delete('tbl_biaya_denda');

			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
			<p> Hapus Harga Denda Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/denda')); 
		}
	}


	public function result()
    {	
		
		$user = $this->M_Admin->get_tableid_edit('tbl_login','anggota_id',$this->input->post('kode_anggota'));
		error_reporting(0);
		if($user->nama != null)
		{
			echo '<table class="table table-striped">
					<tr>
						<td>Nama Anggota</td>
						<td>:</td>
						<td>'.$user->nama.'</td>
					</tr>
					<tr>
						<td>Telepon</td>
						<td>:</td>
						<td>'.$user->telepon.'</td>
					</tr>
					<tr>
						<td>E-mail</td>
						<td>:</td>
						<td>'.$user->email.'</td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td>'.$user->alamat.'</td>
					</tr>
					<tr>
						<td>Level</td>
						<td>:</td>
						<td>'.$user->level.'</td>
					</tr>
				</table>';
		}else{
			echo 'Anggota Tidak Ditemukan !';
		}
        
	}

	public function buku()
    {	
		if($this->input->get('upd'))
		{
			$id = $this->input->post('id');
			$jml = $this->input->post('jml');
			$item = [
				'jml' => $jml,
			];
			$this->db->where('id',$id);
			$this->db->update('tbl_keranjang', $item);
		}else{
			$id = $this->input->post('kode_buku');
			$row = $this->db->query("SELECT * FROM tbl_buku WHERE buku_id ='$id'");
			
			if($row->num_rows() > 0)
			{
				$tes = $row->row();
				$item = array(
					'kode_buku' => $id,
					'nama_buku' => $tes->title,
					'penerbit'  => $tes->penerbit,
					'tahun'		=> $tes->thn_buku,
					'jml'		=> 1,
					'login_id'  => $this->session->userdata('ses_id')
				);
				$cek = $this->db->query("SELECT * FROM tbl_keranjang WHERE kode_buku = ? AND login_id = ?",[$id, $this->session->userdata('ses_id')])->row();
				if(!$cek) {
					$this->db->insert('tbl_keranjang', $item);
				}
			}else{
	
			}
		}
	}

	public function buku_list()
	{
		error_reporting(0);
		$this->load->view('pinjam/buku_list');
	}

	public function del_cart()
    {
        $id = $this->input->post('kode_buku');
		$this->db->where('id', $id);
		$this->db->delete('tbl_keranjang');
		echo '<script>$("#result_buku").load("'.base_url('transaksi/buku_list').'");</script>';
    }

}
