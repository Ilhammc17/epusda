<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PetugasController extends CI_Controller {
  
  public function index()
  {
    $this->data['title_web']  = 'Data Petugas';
		$this->data['uid']        = $this->session->userdata('ses_id');
		$this->data['sidebar']    = 'kelola_petugas';

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('petugas/index', $this->data);
		$this->load->view('footer_view', $this->data);
  }

  public function data()
  {
		$query    = "SELECT * FROM tbl_login";
    $search   = ['level'];
    $where   = ['level' => 'Petugas'];
    $isWhere   = null;
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
  }

  public function create()
  {
    $this->data['title_web']  = 'Data Petugas';
		$this->data['uid']        = $this->session->userdata('ses_id');
		$this->data['sidebar']    = 'kelola_petugas';
		$this->data['type']       = 'tambah';

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('petugas/form', $this->data);
		$this->load->view('footer_view', $this->data);
  }

  public function store()
  {
    $petugas            = $this->PetugasModel;
    $petugas->nama      = $this->input->post('nama');
    $petugas->user      = $this->input->post('username');
    $petugas->pass      = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
    $petugas->telepon   = $this->input->post('telepon');
    $petugas->email     = $this->input->post('email');
    $petugas->level     = 'Petugas';

    $petugas->save();
			
    $this->session->set_flashdata('pesan',
      '<div id="notifikasi">
        <div class="alert alert-warning">
          <p> Berhasil menambah petugas !</p>
        </div>
      </div>'
    );
    redirect('kelola_petugas');
  }

  public function edit($id_petugas)
  {
    $this->data               = $this->PetugasModel->find($id_petugas);
    $this->data['title_web']  = 'Data Petugas';
		$this->data['uid']        = $this->session->userdata('ses_id');
		$this->data['sidebar']    = 'kelola_petugas';
		$this->data['type']       = 'edit';

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('petugas/form', $this->data);
		$this->load->view('footer_view', $this->data);
  }

  public function update($id_petugas)
  {
    $petugas            = $this->PetugasModel;
    $petugas->id_login  = $id_petugas;
    $petugas->nama      = $this->input->post('nama');
    $petugas->user      = $this->input->post('username');

    if ($this->input->post('password')) {
      $petugas->pass  = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
    }
    
    $petugas->telepon = $this->input->post('telepon');
    $petugas->email   = $this->input->post('email');
    $petugas->level   = 'Petugas';

    $petugas->update();
			
    $this->session->set_flashdata('pesan',
      '<div id="notifikasi">
        <div class="alert alert-warning">
          <p> Berhasil mengedit petugas !</p>
        </div>
      </div>'
    );
    redirect('kelola_petugas');
  }

  public function destroy($id_petugas)
  {
    $petugas            = $this->PetugasModel;
    $petugas->id_login  = $id_petugas;
    $petugas->destroy();
			
    $this->session->set_flashdata('pesan',
      '<div id="notifikasi">
        <div class="alert alert-warning">
          <p> Berhasil mengedit petugas !</p>
        </div>
      </div>'
    );
    redirect('kelola_petugas');
  }
}
