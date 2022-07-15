<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
	 parent::__construct();
		//validasi jika user belum login
		$this->data['CI'] =& get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}
		
	}
	
	public function index()
	{	
		$this->data['uid'] = $this->session->userdata('ses_id');
		$this->data['title_web'] = 'Dashboard ';
		$this->data['sidebar'] = 'dashboard';
		$this->data['count_pengguna']=$this->db->query("SELECT * FROM tbl_login")->num_rows();
		$this->data['count_buku']=$this->db->query("SELECT * FROM tbl_buku")->num_rows();
		$this->data['count_kategori']=$this->db->query("SELECT * FROM tbl_kategori")->num_rows();
		$this->data['count_pinjam']=$this->db->query("SELECT sum(jml) as jml FROM tbl_pinjam WHERE status = 'Dipinjam'")->row();
		$this->data['count_kembali']=$this->db->query("SELECT sum(jml) as jml FROM tbl_pinjam WHERE status = 'Di Kembalikan' AND periode_kembali = '".date('m-Y')."'")->row();
		
		$this->load->view('header_view',$this->data);
		$this->load->view('sidebar_view',$this->data);
		$this->load->view('dashboard_view',$this->data);
		$this->load->view('footer_view',$this->data);
	}

	public function data()
	{
		$this->data['uid'] = $this->session->userdata('ses_id');
		$this->data['title_web'] = 'Visitor Counter';
		$this->data['tbl_pengunjung'] = $this->db->query("SELECT * FROM tbl_pengunjung ORDER BY id DESC")->result();
		$this->data['count_pengunjung'] = $this->db->like('created_at', date('Y-m-d'))->get("tbl_pengunjung")->num_rows();
		$this->data['sidebar'] = 'track';
    $this->data['token']  = $this->db->get_where('token', ['id_token' => 1])->row_array();

		$this->load->view('header_view',$this->data);
		$this->load->view('sidebar_view',$this->data);
		$this->load->view('track_data',$this->data);
		$this->load->view('footer_view',$this->data);
	}

	public function data_pengunjung()
	{
		$query  = "SELECT * FROM  tbl_pengunjung";
		$search = array('nama', 'pekerjaan', 'jenis_kelamin', 'created_at');
		$where  = null;
		// $where  = array('nama_kategori' => 'Tutorial');
		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

	// public function pengunjung()
	// {
		
	// 	$this->form_validation->set_rules("nama", "Nama", "required");
	// 	if($this->form_validation->run() != false) {
		
	// 		$data = [
	// 			'anggota_id' => htmlspecialchars($this->input->post("anggota_id", TRUE) ,ENT_QUOTES),
	// 			'nama' => htmlspecialchars($this->input->post("nama", TRUE) ,ENT_QUOTES),
	// 			'created_at' => date('Y-m-d H:i:s'),
	// 			'tgl_masuk' => date('Y-m-d'),
	// 		];

	// 		$this->db->insert("tbl_pengunjung", $data);
	// 		$this->session->set_flashdata("success"," Berhasil Insert Data ! ");
	// 		redirect(base_url("dashboard/track"));
	// 	}else{
	// 		$this->session->set_flashdata("failed"," Gagal Insert Data ! ".validation_errors());
	// 		redirect(base_url("dashboard/track"));
	// 	}
	// }

	public function delete()
	{
		$id = (int)$this->input->get("id");
		$cek = $this->db->get_where("tbl_pengunjung",["id" => $id]); // tulis id yang dituju
		if($cek->num_rows() > 0)
		{
			$this->db->where("id",$id); // tulis id yang dituju
			$this->db->delete("tbl_pengunjung");
			$this->session->set_flashdata("pesan"," Berhasil Delete Data ! ");
			redirect(base_url("dashboard/data"));
		}else{
			$this->session->set_flashdata("pesan"," Gagal Delete Data ! ".validation_errors());
			redirect(base_url("dashboard/data"));
		}
	}

	public function atur()
	{
		$this->data['uid'] = $this->session->userdata('ses_id');
		$this->data['title_web'] = 'Atur';
		
		$this->data['sidebar'] = 'atur';
		
		$this->load->view('header_view',$this->data);
		$this->load->view('sidebar_view',$this->data);
		$this->load->view('atur', $this->data);
		$this->load->view('footer_view',$this->data);
	}

	public function aturan()
	{
		$data = [
			'nama_perpus' => htmlspecialchars($this->input->post("nama_perpus", TRUE) ,ENT_QUOTES),
			'email' => htmlspecialchars($this->input->post("email", TRUE) ,ENT_QUOTES),
			'telepon' => htmlspecialchars($this->input->post("telepon", TRUE) ,ENT_QUOTES),
			'alamat' => htmlspecialchars($this->input->post("alamat", TRUE) ,ENT_QUOTES),
		];

		$upload_foto = $_FILES['logo']['name'];
		if ($upload_foto) {
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '2048';
			$config['upload_path'] = './assets/image';
			// $this->load->library('upload', $config);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('logo')) {
				$foto_baru = $this->upload->data('file_name');
				$this->db->set('logo', $foto_baru);
			}
		}
			
		$this->db->where("id", 1); // ubah id dan postnya
		$this->db->update("tbl_atur", $data);
		$this->session->set_flashdata("success"," Berhasil Update Data ! ");
		redirect(base_url('dashboard/atur')); 
	}

  public function exportPengunjung($tipe)
  {
    $data['pengunjung'] = $this->db->get('tbl_pengunjung')->result_array();
    switch ($tipe) {
      case 'cetak':
        $this->load->library('pdfgenerator');
    
        $paper              = 'A4';
        $orientation        = "landscape";
        $file_pdf = 'Laporan-Pengunjung-';
    
        $html = $this->load->view('cetakPengunjung', $data, true);
    
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        break;
      
      case 'excel':
        $file_pdf = 'Laporan-Pengunjung-';
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=".$file_pdf.".xls");
        $this->load->view('cetakPengunjung', $data);
        break;
      
      default:
        # code...
        break;
    }
  }
}
