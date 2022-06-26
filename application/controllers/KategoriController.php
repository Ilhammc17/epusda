<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriController extends CI_Controller {
  
  public function index($id_kategori)
  {
    $this->data['title_web']    = 'Data Kategori';
		$this->data['uid']          = $this->session->userdata('ses_id');
    $this->data['sidebar']      = 'kategori';
    $this->data['id_kategori']  = $id_kategori;

		if(!empty($this->input->get('id'))){
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_subkategori','id_subkategori',$id);
			if($count > 0)
			{			
				$this->data['kat'] = $this->db->query("SELECT *FROM tbl_subkategori WHERE id_subkategori='$id'")->row();
			}else{
				echo '<script>alert("SUBKATEGORI TIDAK DITEMUKAN");window.location="'.$_SERVER['HTTP_REFERER'].'"</script>';
			}
		}

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('kategori/index', $this->data);
		$this->load->view('footer_view', $this->data);
  }

  public function data($id_kategori)
  {
		$query  = "SELECT * FROM tbl_subkategori";
		$search = array('nama_subkategori');
		$where  = ['kategori_id' => $id_kategori];
		$isWhere = null;
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
  }

  public function store($id_kategori)
	{
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}

		// hapus aksi form proses kategori
		if(!empty($this->input->get('subkat_id')))
		{ 
			$this->db->delete('tbl_subkategori', ['id_subkategori' => $this->input->get('subkat_id')]);

			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
			<p> Hapus Sub Kategori Sukses !</p>
			</div></div>');
			redirect($_SERVER['HTTP_REFERER']);
		} else {

		$post= $this->input->post();
		$data = [
			'kategori_id'       => $id_kategori,
			'nama_subkategori'  =>htmlentities($post['nama_subkategori'])];
	
		// tambah aksi form proses kategori
		if(!empty($this->input->post('tambah')))
		{
			$this->db->insert('tbl_subkategori', $data);
			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah Sub Kategori Sukses !</p>
			</div></div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	
		// edit aksi form proses kategori
		if(!empty($this->input->post('edit')))
		{
			$this->db->update('tbl_subkategori', $data, ['id_subkategori' => $this->input->post('edit')]);
			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Sub Kategori Sukses !</p>
			</div></div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
		}
	}

	public function data_select($id_kategori)
	{
		header('Content-Type: application/json');
		echo json_encode($this->db->get_where('tbl_subkategori', ['kategori_id' => $id_kategori])->result_array());
	}
}
