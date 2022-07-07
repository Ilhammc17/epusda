<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SumberController extends CI_Controller {
  
  public function index()
  {
    $this->data['title_web']    = 'Data Sumber';
		$this->data['uid']          = $this->session->userdata('ses_id');
    $this->data['sidebar']      = 'sumber';

		if(!empty($this->input->get('id'))){
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_sumber','id_sumber',$id);
			if($count > 0)
			{			
				$this->data['sumber'] = $this->db->query("SELECT *FROM tbl_sumber WHERE id_sumber='$id'")->row();
			}else{
				echo '<script>alert("SUMBER TIDAK DITEMUKAN");window.location="'.$_SERVER['HTTP_REFERER'].'"</script>';
			}
		}

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('sumber/index', $this->data);
		$this->load->view('footer_view', $this->data);
  }

  public function data()
  {
		$query  = "SELECT * FROM tbl_sumber";
		$search = array('nama_sumber');
		$where  = [];
		$isWhere = null;
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
  }

  public function store()
	{
		if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}

		// hapus aksi form proses kategori
		if(!empty($this->input->get('sumber_id')))
		{ 
			$this->db->delete('tbl_sumber', ['id_sumber' => $this->input->get('sumber_id')]);

			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
			<p> Hapus Sumber Sukses !</p>
			</div></div>');
			redirect($_SERVER['HTTP_REFERER']);
		} else {

		$post= $this->input->post();
		$data = ['nama_sumber' =>htmlentities($post['nama_sumber'])];
	
		// tambah aksi form proses kategori
		if(!empty($this->input->post('tambah')))
		{
      $this->form_validation->set_rules('nama_sumber', 'Nama Sumber', 'required', ['required' => 'Nama sumber harus diisi']);

      if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
            <p>' . validation_errors() . '</p>
          </div></div>');
      } else {
        $subkategoriUnique  = $this->db->like('nama_sumber', $this->input->post('nama_sumber'))->get('tbl_sumber');

        if ($subkategoriUnique->num_rows() <= 0) {
          $this->db->insert('tbl_sumber', $data);
          $this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
          <p> Tambah sumber Sukses !</p>
          </div></div>');
        } else {
          $this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
              <p>Nama sumber sudah digunakan</p>
            </div></div>');
        }
      }
      redirect($_SERVER['HTTP_REFERER']);
		}
	
		// edit aksi form proses kategori
		if(!empty($this->input->post('edit')))
		{
			$this->db->update('tbl_sumber', $data, ['id_sumber' => $this->input->post('edit')]);
			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Sumber Sukses !</p>
			</div></div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
		}
	}

	public function data_select($id_kategori)
	{
		header('Content-Type: application/json');
		echo json_encode($this->db->get_where('tbl_sumber', ['kategori_id' => $id_kategori])->result_array());
	}
}
