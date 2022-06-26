<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	function __construct(){
	 	parent::__construct();
	 	//validasi jika user belum login
		$this->data['CI'] =& get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->model('M_Datatables');
		
	}

	/*
	|	CRUD MENU BUKU 
	*/
	public function index()
	{
		$this->data['uid'] = $this->session->userdata('ses_id');
		$this->data['buku'] =  $this->db->query("SELECT * FROM tbl_buku ORDER BY id_buku DESC");
        $this->data['title_web'] = 'Data Buku';
		$this->data['sidebar'] = 'buku_data';
        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('buku/buku_view',$this->data);
        $this->load->view('footer_view',$this->data);
	}

	public function data_buku()
	{
		$query  = "SELECT 
					tbl_kategori.nama_kategori,
					tbl_rak.nama_rak,
					tbl_buku.*,
					(SELECT * FROM pengarang_tambahan WHERE tbl_buku.buku_id = pengarang_tambahan.buku_id)
				FROM tbl_buku 
				LEFT JOIN tbl_kategori ON tbl_buku.id_kategori=tbl_kategori.id_kategori 
				LEFT JOIN tbl_rak ON tbl_buku.id_rak=tbl_rak.id_rak";
		
		$search = array('isbn','tbl_buku.buku_id','title','nama_kategori','nama_rak','penerbit','thn_buku','jml','dipinjam','tgl_masuk');
		$where  = null; 
		if($this->input->get('sortir')){
			$sortir = htmlspecialchars($this->input->get('sortir'));
			$isWhere = "nama_kategori LIKE '%$sortir%'";
		}else{
			if($this->input->get('rak')){
				$rak = htmlspecialchars($this->input->get('rak'));
				$isWhere = "nama_rak LIKE '%$rak%'";
			}else{
				$isWhere = null;
			}
		}
		// $where  = array('nama_kategori' => 'Tutorial');
		// jika memakai IS NULL pada where sql
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

	public function bukudetail()
	{
		$this->data['uid'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('tbl_buku','id_buku',$this->uri->segment('3'));
		if($count > 0)
		{
			$buku = $this->M_Admin->get_tableid_edit('tbl_buku','id_buku',$this->uri->segment('3'));
			$this->data['buku'] = $buku;
			$this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
			$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();

		}else{
			echo '<script>alert("BUKU TIDAK DITEMUKAN");window.location="'.base_url('data').'"</script>';
		}

		$this->data['sidebar'] = 'buku';
		$this->data['title_web'] = 'Data Buku Detail';
        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('buku/detail',$this->data);
        $this->load->view('footer_view',$this->data);
	}

	public function bukuedit()
	{
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}
		$this->data['uid'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('tbl_buku','id_buku',$this->uri->segment('3'));
		if($count > 0)
		{
			
			$this->data['buku'] = $this->M_Admin->get_tableid_edit('tbl_buku','id_buku',$this->uri->segment('3'));
	   
			$this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
			$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();

		}else{
			echo '<script>alert("BUKU TIDAK DITEMUKAN");window.location="'.base_url('data').'"</script>';
		}

		$this->data['sidebar'] = 'buku';
		$this->data['title_web'] = 'Data Buku Edit';
        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('buku/edit_view',$this->data);
        $this->load->view('footer_view',$this->data);
	}

	public function bukutambah()
	{
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}
		$this->data['uid'] = $this->session->userdata('ses_id');

		$this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
		$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();


		$this->data['sidebar'] = 'buku';
        $this->data['title_web'] = 'Tambah Buku';
        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('buku/tambah_view',$this->data);
        $this->load->view('footer_view',$this->data);
	}

	public function prosesbuku()
	{
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}

		// hapus aksi form proses buku
		if(!empty($this->input->get('buku_id')))
		{
        
			$buku = $this->M_Admin->get_tableid_edit('tbl_buku','id_buku',htmlentities($this->input->get('buku_id')));
			
			$sampul = './assets/image/buku/'.$buku->sampul;
			if(file_exists($sampul))
			{
				unlink($sampul);
			}
			
			$lampiran = './assets/image/buku/'.$buku->lampiran;
			if(file_exists($lampiran))
			{
				unlink($lampiran);
			}
			
			$this->M_Admin->delete_table('tbl_buku','id_buku',$this->input->get('buku_id'));
			
			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
					<p> Berhasil Hapus Buku !</p>
				</div></div>');
			redirect(base_url('data'));  
		}

		// tambah aksi form proses buku
		if(!empty($this->input->post('tambah')))
		{
			$post= $this->input->post();
			$buku_id = $this->M_Admin->buat_kode('tbl_buku','BK','id_buku','ORDER BY id_buku DESC LIMIT 1');
			$data = array(
				'buku_id'=>$buku_id,
				'id_kategori'=>htmlentities($post['kategori']),
				'subkategori_id'	=> htmlentities($post['subkategori_id']),
				'id_rak' => htmlentities($post['rak']), 
				'isbn' => htmlentities($post['isbn']), 
				'title'  => htmlentities($post['title']), 
				'pengarang'=> htmlentities($post['pengarang']), 
				'penerbit'=> htmlentities($post['penerbit']),    
				'thn_buku' => htmlentities($post['thn']), 
				'isi' => $this->input->post('ket'), 
				'jml'=> htmlentities($post['jml']),  
				'tgl_masuk' => date('Y-m-d H:i:s')
			);

			if(!empty($_FILES['gambar']['name']))
			{
				// setting konfigurasi upload
				$config['upload_path'] = './assets/image/buku/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png'; 
				$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
				// load library upload
				$this->load->library('upload',$config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('gambar')) {
					$this->upload->data();
					$file1 = array('upload_data' => $this->upload->data());
					$this->db->set('sampul', $file1['upload_data']['file_name']);
				}else{
					$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
							<p> Edit Buku Gagal !</p>
						</div></div>');
					redirect(base_url('data')); 
				}
			}

			if(!empty($_FILES['lampiran']['name']))
			{
				// setting konfigurasi upload
				$config['upload_path'] = './assets/image/buku/';
				$config['allowed_types'] = 'pdf'; 
				$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
				// load library upload
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				// script uplaod file kedua
				if ($this->upload->do_upload('lampiran')) {
					$this->upload->data();
					$file2 = array('upload_data' => $this->upload->data());
					$this->db->set('lampiran', $file2['upload_data']['file_name']);
				}else{

					$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
							<p> Edit Buku Gagal !</p>
						</div></div>');
					redirect(base_url('data')); 
				}
			}
			
			$this->db->insert('tbl_buku', $data);

			foreach ($this->input->post('pengarang_tambahan') as $key) {
				$this->db->insert('pengarang_tambahan', [
					'buku_id'					=> $buku_id,
					'nama_pengarang_tambahan'	=> $key,
				]);
			}

			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah Buku Sukses !</p>
			</div></div>');
			redirect(base_url('data')); 
		}

		// edit aksi form proses buku
		if(!empty($this->input->post('edit')))
		{
			$post = $this->input->post();
			$data = array(
				'id_kategori'=>htmlentities($post['kategori']), 
				'id_rak' => htmlentities($post['rak']), 
				'isbn' => htmlentities($post['isbn']), 
				'title'  => htmlentities($post['title']),
				'pengarang'=> htmlentities($post['pengarang']), 
				'penerbit'=> htmlentities($post['penerbit']),  
				'thn_buku' => htmlentities($post['thn']), 
				'isi' => $this->input->post('ket'), 
				'jml'=> htmlentities($post['jml']),  
				'tgl_masuk' => date('Y-m-d H:i:s')
			);

			if(!empty($_FILES['gambar']['name']))
			{
				// setting konfigurasi upload
				$config['upload_path'] = './assets/image/buku/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png'; 
				$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
				// load library upload
				$this->load->library('upload',$config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('gambar')) {
					$this->upload->data();
					$gambar = './assets/image/buku/'.htmlentities($post['gmbr']);
					if(file_exists($gambar)) {
						unlink($gambar);
					}
					$file1 = array('upload_data' => $this->upload->data());
					$this->db->set('sampul', $file1['upload_data']['file_name']);
				}else{
					$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
							<p> Edit Buku Gagal !</p>
						</div></div>');
					redirect(base_url('data')); 
				}
			}

			if(!empty($_FILES['lampiran']['name']))
			{
				// setting konfigurasi upload
				$config['upload_path'] = './assets/image/buku/';
				$config['allowed_types'] = 'pdf'; 
				$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
				// load library upload
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				// script uplaod file kedua
				if ($this->upload->do_upload('lampiran')) {
					$this->upload->data();
					$lampiran = './assets/image/buku/'.htmlentities($post['lamp']);
					if(file_exists($lampiran)) {
						unlink($lampiran);
					}
					$file2 = array('upload_data' => $this->upload->data());
					$this->db->set('lampiran', $file2['upload_data']['file_name']);
				}else{

					$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
							<p> Edit Buku Gagal !</p>
						</div></div>');
					redirect(base_url('data')); 
				}
			}

			$this->db->where('id_buku',htmlentities($post['edit']));
			$this->db->update('tbl_buku', $data);

			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
					<p> Edit Buku Sukses !</p>
				</div></div>');
			redirect(base_url('data/bukuedit/'.$post['edit'])); 
		}
	}

	/*
	|	END CRUD MENU BUKU 
	*/

	/*
	|	CRUD MENU KATEGORI
	*/
	public function kategori()
	{
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}
		
        $this->data['uid'] = $this->session->userdata('ses_id');
		$this->data['kategori'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC");

		if(!empty($this->input->get('id'))){
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_kategori','id_kategori',$id);
			if($count > 0)
			{			
				$this->data['kat'] = $this->db->query("SELECT *FROM tbl_kategori WHERE id_kategori='$id'")->row();
			}else{
				echo '<script>alert("KATEGORI TIDAK DITEMUKAN");window.location="'.base_url('data/kategori').'"</script>';
			}
		}
        $this->data['sidebar'] = 'kategori';
        $this->data['title_web'] = 'Data Kategori ';
        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('kategori/kat_view',$this->data);
        $this->load->view('footer_view',$this->data);
	}

	public function data_kategori()
	{
		$tables = "tbl_kategori";
		$search = array('nama_kategori');
		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables($tables,$search,$isWhere);
	}

	public function katproses()
	{
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}

		// tambah aksi form proses kategori
		if(!empty($this->input->post('tambah')))
		{
			$post= $this->input->post();
			$data = array(
				'nama_kategori'=>htmlentities($post['kategori']),
			);

			$this->db->insert('tbl_kategori', $data);

			
			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah Kategori Sukses !</p>
			</div></div>');
			redirect(base_url('data/kategori'));  
		}

		// edit aksi form proses kategori
		if(!empty($this->input->post('edit')))
		{
			$post= $this->input->post();
			$data = array(
				'nama_kategori'=>htmlentities($post['kategori']),
			);
			$this->db->where('id_kategori',htmlentities($post['edit']));
			$this->db->update('tbl_kategori', $data);


			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Kategori Sukses !</p>
			</div></div>');
			redirect(base_url('data/kategori')); 		
		}

		// hapus aksi form proses kategori
		if(!empty($this->input->get('kat_id')))
		{
			$this->db->where('id_kategori',$this->input->get('kat_id'));
			$this->db->delete('tbl_kategori');

			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
			<p> Hapus Kategori Sukses !</p>
			</div></div>');
			redirect(base_url('data/kategori')); 
		}
	}

	/*
	|	END CRUD MENU KATEGORI
	*/
	
	/*
	|	CRUD MENU JURUSAN
	*/
	public function jurusan()
	{
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}
		
        $this->data['uid'] = $this->session->userdata('ses_id');
		$this->data['jurusan'] =  $this->db->query("SELECT * FROM tbl_status ORDER BY id_status DESC");

		$this->data['sidebar'] = 'jurusan';
		if(!empty($this->input->get('id'))){
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_status','id_status',$id);
			if($count > 0)
			{			
				$this->data['kat'] = $this->db->query("SELECT *FROM tbl_status WHERE id_status='$id'")->row();
			}else{
				echo '<script>alert("status TIDAK DITEMUKAN");window.location="'.base_url('data/jurusan').'"</script>';
			}
		}

        $this->data['title_web'] = 'Data Status ';
        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('jurusan/home',$this->data);
        $this->load->view('footer_view',$this->data);
	}

	public function data_jurusan()
	{
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}
		$tables = "tbl_status";
		$search = array('nama_status');
		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables($tables,$search,$isWhere);
	}

	public function jurproses()
	{
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}

		// tambah aksi form proses jurusan
		if(!empty($this->input->post('tambah')))
		{
			$post= $this->input->post();
			$data = array(
				'nama_status'=>htmlentities($post['jurusan']),
			);

			$this->db->insert('tbl_status', $data);

			
			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah status Sukses !</p>
			</div></div>');
			redirect(base_url('data/jurusan'));  
		}

		// edit aksi form proses jurusan
		if(!empty($this->input->post('edit')))
		{
			$post= $this->input->post();
			$data = array(
				'nama_status'=>htmlentities($post['jurusan']),
			);
			$this->db->where('id_status',htmlentities($post['edit']));
			$this->db->update('tbl_status', $data);


			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
			<p> Edit status Sukses !</p>
			</div></div>');
			redirect(base_url('data/jurusan')); 		
		}

		// hapus aksi form proses jurusan
		if(!empty($this->input->get('kat_id')))
		{
			$this->db->where('id_status',$this->input->get('kat_id'));
			$this->db->delete('tbl_status');

			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
			<p> Hapus status Sukses !</p>
			</div></div>');
			redirect(base_url('data/jurusan')); 
		}
	}
	/*
	|	END CRUD MENU JURUSAN
	*/
	/*
	|	CRUD MENU RAK
	*/
	public function rak()
	{
		
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}
        $this->data['uid'] = $this->session->userdata('ses_id');
		$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC");

		$this->data['sidebar'] = 'rak';
		if(!empty($this->input->get('id'))){
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_rak','id_rak',$id);
			if($count > 0)
			{	
				$this->data['rak'] = $this->db->query("SELECT *FROM tbl_rak WHERE id_rak='$id'")->row();
			}else{
				echo '<script>alert("KATEGORI TIDAK DITEMUKAN");window.location="'.base_url('data/rak').'"</script>';
			}
		}

        $this->data['title_web'] = 'Data Rak Buku ';
        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('rak/rak_view',$this->data);
        $this->load->view('footer_view',$this->data);
	}

	public function data_rak()
	{
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}
		$tables = "tbl_rak";
		$search = array('nama_rak');
		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables($tables,$search,$isWhere);
	}

	public function rakproses()
	{
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}

		// tambah aksi form proses rak
		if(!empty($this->input->post('tambah')))
		{
			$post= $this->input->post();
			$data = array(
				'nama_rak'=>htmlentities($post['rak']),
			);

			$this->db->insert('tbl_rak', $data);

			
			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah Rak Buku Sukses !</p>
			</div></div>');
			redirect(base_url('data/rak'));  
		}

		// edit aksi form proses rak
		if(!empty($this->input->post('edit')))
		{
			$post= $this->input->post();
			$data = array(
				'nama_rak'=>htmlentities($post['rak']),
			);
			$this->db->where('id_rak',htmlentities($post['edit']));
			$this->db->update('tbl_rak', $data);


			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Rak Sukses !</p>
			</div></div>');
			redirect(base_url('data/rak')); 		
		}

		// hapus aksi form proses rak
		if(!empty($this->input->get('rak_id')))
		{
			$this->db->where('id_rak',$this->input->get('rak_id'));
			$this->db->delete('tbl_rak');

			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
			<p> Hapus Rak Buku Sukses !</p>
			</div></div>');
			redirect(base_url('data/rak')); 
		}
	}
	/*
	|	END CRUD MENU RAK
	*/
}
