<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct(){
	 	parent::__construct();
	 	//validasi jika user belum login
		$this->data['CI'] =& get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->model('M_Datatables');
     	if($this->session->userdata('masuk_perpus') != TRUE){
			$url=base_url('login');
			redirect($url);
		}
		
     }
     
    public function index()
    {	
		if($this->session->userdata('level') != 'Petugas'){
			$url=base_url('transaksi');
			redirect($url);
		}
		
        $this->data['uid'] = $this->session->userdata('ses_id');
		$this->data['user'] = $this->M_Admin->get_table('tbl_login');

		$this->data['sidebar'] = 'user';

		$this->data['title_web'] = 'Data User ';
		
        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('user/user_view',$this->data);
        $this->load->view('footer_view',$this->data);
	}
	
	public function get_data()
	{
		$user = $this->db->get_where('tbl_login',['anggota_id' => $this->input->post('anggota_id')])->row_array();
		
		echo json_encode($user);
	}

	public function data_user()
	{
		$query  = "SELECT tbl_login.anggota_id,tbl_login.id_login,tbl_login.nim,
					tbl_login.nama,tbl_login.user,tbl_login.jenkel,
					tbl_login.telepon,tbl_login.level,tbl_login.alamat, 
					tbl_status.nama_status, tbl_login.ktp
					FROM tbl_login LEFT JOIN 
					tbl_status ON tbl_login.id_status=tbl_status.id_status";
		$search = array('anggota_id','nama','user','tbl_status.nama_status','nim','telepon','level','alamat');
		$where  = ['level' => 'Anggota'];
		// if($this->input->get('sortir') == 'petugas'){
		// 	$where  = array('level' => 'Petugas');
		// }else if($this->input->get('sortir') == 'anggota'){
		// 	$where  = array('level' => 'Anggota');
		// }else{
		// 	$where  = null; 
		// }
		// $where  = array('nama_kategori' => 'Tutorial');
		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

	public function data_anggota()
	{
		$query  = "SELECT tbl_login.anggota_id,tbl_login.id_login,tbl_login.nim,
					tbl_login.nama,tbl_login.user,tbl_login.jenkel,
					tbl_login.telepon,tbl_login.level,tbl_login.alamat, 
					tbl_status.nama_status 
					FROM tbl_login LEFT JOIN 
					tbl_status ON tbl_login.id_status=tbl_status.id_status";
		$search = array('anggota_id','nama','user','tbl_status.nama_status','nim','telepon','level','alamat');
		$where  = array('level' => 'Anggota'); 
		// $where  = array('nama_kategori' => 'Tutorial');
		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

    public function tambah()
    {	
        $this->data['uid'] = $this->session->userdata('ses_id');
        $this->data['user'] = $this->M_Admin->get_table('tbl_login');
        $this->data['jur'] = $this->M_Admin->get_table('tbl_status');
		$this->data['sidebar'] = 'user';
        $this->data['title_web'] = 'Tambah User ';
        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('user/tambah_view',$this->data);
        $this->load->view('footer_view',$this->data);
    }

    public function add()
    {
		// format tabel / kode baru 3 hurup / id tabel / order by limit ngambil data terakhir
		$id = $this->M_Admin->buat_kode('tbl_login','AG','id_login','ORDER BY id_login DESC LIMIT 1'); 
		$nim = htmlentities($this->input->post('nim',TRUE));
		$jur = htmlentities($this->input->post('jurusan',TRUE));
		$nama = htmlentities($this->input->post('nama',TRUE));
        $user = htmlentities($this->input->post('user',TRUE));
        $pass = htmlentities($this->input->post('pass',TRUE));
        $level = 'Anggota';
        $jenkel = htmlentities($this->input->post('jenkel',TRUE));
        $telepon = htmlentities($this->input->post('telepon',TRUE));
        $status = htmlentities($this->input->post('status',TRUE));
        $alamat = htmlentities($this->input->post('alamat',TRUE));
		$email = $_POST['email'];
		
		$passhash = password_hash($pass, PASSWORD_DEFAULT);
		
		$dd = $this->db->query("SELECT * FROM tbl_login WHERE user = '$user' OR email = '$email'");
		if($dd->num_rows() > 0)
		{
			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
					<p> Gagal Update User : '.$nama.' !, Username Anda Sudah Terpakai</p>
				</div></div>');
			redirect(base_url('user/tambah')); 
		}else{
            // setting konfigurasi upload
            $nmfile = "user_".time();
            $config['upload_path'] = './assets/image/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['file_name'] = $nmfile;
            // load library upload
            $this->load->library('upload', $config);
            // upload gambar 1
            // $this->upload->do_upload('gambar');

            if (!$this->upload->do_upload('gambar')) {
              $this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
                  <p>Format pas foto yang dimasukan salah</p>
                </div></div>');
              redirect($_SERVER['HTTP_REFERER']);
            }

            $result1 = $this->upload->data();
            $result = array('gambar'=>$result1);
            $data1 = array('upload_data' => $this->upload->data());

            $nmfile = "ktp_".time();
            $config['file_name'] = $nmfile;

            // $this->upload->do_upload('ktp');

            
            if (!$this->upload->do_upload('ktp')) {
              $this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
                  <p>Format ktp yang dimasukan salah</p>
                </div></div>');
              redirect($_SERVER['HTTP_REFERER']);
            }

            $ktp = $this->upload->data()['file_name'];

            $data = array(
				'anggota_id' => $id,
                'nim'=>$nim,
				'nama'=>$nama,
				'id_status' => $jur,
                'user'=>$user,
                'pass'=>$passhash,
                'level'=>$level,
                'tempat_lahir'=>$_POST['lahir'],
                'tgl_lahir'=>$_POST['tgl_lahir'],
                'email'=>$_POST['email'],
                'telepon'=>$telepon,
                'foto'=>$data1['upload_data']['file_name'],
				'ktp'	=> $ktp,
                'jenkel'=>$jenkel,
                'alamat'=>$alamat,
                'tgl_bergabung'=>date('Y-m-d')
            );
			$this->db->insert('tbl_login',$data);
			
            $this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
            <p> Daftar User telah berhasil !</p>
            </div></div>');
			redirect(base_url('user'));
		}    
      
    }

    public function edit()
    {	
		if($this->session->userdata('level') == 'Petugas'){
			if($this->uri->segment('3') == ''){ echo '<script>alert("halaman tidak ditemukan");window.location="'.base_url('user').'";</script>';}
			$this->data['uid'] = $this->session->userdata('ses_id');
			$count = $this->M_Admin->CountTableId('tbl_login','id_login',$this->uri->segment('3'));
			if($count > 0)
			{			
				$this->data['user'] = $this->M_Admin->get_tableid_edit('tbl_login','id_login',$this->uri->segment('3'));
			}else{
				echo '<script>alert("USER TIDAK DITEMUKAN");window.location="'.base_url('user').'"</script>';
			}
		}elseif($this->session->userdata('level') == 'Anggota'){
			$this->data['uid'] = $this->session->userdata('ses_id');
			$count = $this->M_Admin->CountTableId('tbl_login','id_login',$this->uri->segment('3'));
			if($count > 0)
			{			
				$this->data['user'] = $this->M_Admin->get_tableid_edit('tbl_login','id_login',$this->session->userdata('ses_id'));
			}else{
				echo '<script>alert("USER TIDAK DITEMUKAN");window.location="'.base_url('user').'"</script>';
			}
		}
        $this->data['title_web'] = 'Edit User ';
        $this->data['jur'] = $this->M_Admin->get_table('tbl_status');
		$this->data['sidebar'] = 'user';

        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('user/edit_view',$this->data);
        $this->load->view('footer_view',$this->data);
	}
	
	public function detail()
    {	
		if($this->session->userdata('level') == 'Petugas'){
			if($this->uri->segment('3') == ''){ echo '<script>alert("halaman tidak ditemukan");window.location="'.base_url('user').'";</script>';}
			$this->data['uid'] = $this->session->userdata('ses_id');
			$count = $this->M_Admin->CountTableId('tbl_login','id_login',$this->uri->segment('3'));
			if($count > 0)
			{			
				$this->data['user'] = $this->db->query("SELECT 
						tbl_status.nama_status, tbl_login.*
						FROM tbl_login LEFT JOIN 
						tbl_status 
						ON tbl_login.id_status=tbl_status.id_status 
						WHERE tbl_login.id_login = ?",array($this->uri->segment('3')))->row();
			}else{
				echo '<script>alert("USER TIDAK DITEMUKAN");window.location="'.base_url('user').'"</script>';
			}		
		}elseif($this->session->userdata('level') == 'Anggota'){
			$this->data['uid'] = $this->session->userdata('ses_id');
			$count = $this->M_Admin->CountTableId('tbl_login','id_login',$this->session->userdata('ses_id'));
			if($count > 0)
			{			
				$this->data['user'] = $this->db->query("SELECT 
						tbl_status.nama_status, tbl_login.*
						FROM tbl_login LEFT JOIN 
						tbl_status 
						ON tbl_login.id_status=tbl_status.id_status 
						WHERE tbl_login.id_login = ?",array($this->session->userdata('ses_id')))->row();
			}else{
				echo '<script>alert("USER TIDAK DITEMUKAN");window.location="'.base_url('user').'"</script>';
			}
		}
		// panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');
		
		$user = $this->data['user'];
        // title dari pdf
        $this->data['title_web'] = 'Print Kartu Anggota ';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Anggota-'.$user->anggota_id;
        // setting paper
        $paper = 'B5';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
		$html = $this->load->view('user/detail',$this->data, true);	    
        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }

    public function upd()
    {
        $nim = htmlentities($this->input->post('nim',TRUE));
		$jur = htmlentities($this->input->post('jurusan',TRUE));
        $nama = htmlentities($this->input->post('nama',TRUE));
        $user = htmlentities($this->input->post('user',TRUE));
        $pass = htmlentities($this->input->post('pass'));
        $level = 'Anggota';
        $jenkel = htmlentities($this->input->post('jenkel',TRUE));
        $telepon = htmlentities($this->input->post('telepon',TRUE));
        $status = htmlentities($this->input->post('status',TRUE));
        $alamat = htmlentities($this->input->post('alamat',TRUE));
        $id_login = htmlentities($this->input->post('id_login',TRUE));

		$passhash = password_hash($pass, PASSWORD_DEFAULT);
		
		if($_FILES['gambar']['name'] == '' && $_FILES['ktp']['name'] == '')
		{
			if($this->input->post('pass') !== ''){
				$data = array(
					'nim'=> $nim,
					'id_status' => $jur,
					'nama'=>$nama,
					'user'=>$user,
					'pass'=>$passhash,
					'tempat_lahir'=>$_POST['lahir'],
					'tgl_lahir'=>$_POST['tgl_lahir'],
					'level'=>$level,
					'email'=>$_POST['email'],
					'telepon'=>$telepon,
					'jenkel'=>$jenkel,
					'alamat'=>$alamat,
				);
				$this->M_Admin->update_table('tbl_login','id_login',$id_login,$data);
				if($this->session->userdata('level') == 'Petugas')
				{
					$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
					<p> Berhasil Update User : '.$nama.' !</p>
					</div></div>');
					redirect(base_url('user/edit/'.$id_login)); 
				}elseif($this->session->userdata('level') == 'Anggota'){

					$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
					<p> Berhasil Update User : '.$nama.' !</p>
					</div></div>');
					redirect(base_url('user/edit/'.$id_login)); 
				}
			}else{
				$data = array(
					'nim'=> $nim,
					'id_status' => $jur,
					'nama'=>$nama,
					'user'=>$user,
					'tempat_lahir'=>$_POST['lahir'],
					'tgl_lahir'=>$_POST['tgl_lahir'],
					'level'=>$level,
					'email'=>$_POST['email'],
					'telepon'=>$telepon,
					'jenkel'=>$jenkel,
					'alamat'=>$alamat,
				);
				$this->M_Admin->update_table('tbl_login','id_login',$id_login,$data);
			
				if($this->session->userdata('level') == 'Petugas')
				{
					$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
						<p> Berhasil Update User : '.$nama.' !</p>
						</div></div>');
					redirect(base_url('user/edit/'.$id_login)); 
				}elseif($this->session->userdata('level') == 'Anggota'){

					$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
						<p> Berhasil Update User : '.$nama.' !</p>
						</div></div>');
					redirect(base_url('user/edit/'.$id_login)); 
				} 
			}
		}else{
			$data = array(
				'nim'=> $nim,
				'id_status' => $jur,
				'nama'=>$nama,
				'user'=>$user,
				'tempat_lahir'=>$_POST['lahir'],
				'tgl_lahir'=>$_POST['tgl_lahir'],
				'level'=>$level,
				'email'=>$_POST['email'],
				'telepon'=>$telepon,
				'jenkel'=>$jenkel,
				'alamat'=>$alamat
			);

			$config['upload_path'] = './assets/image/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';

			if ($_FILES['gambar']['name'] != '') {
				// setting konfigurasi upload
				$nmfile = "user_".time();
				$config['file_name'] = $nmfile;
				// load library upload
				$this->load->library('upload', $config);
				// upload gambar 1
				$this->upload->do_upload('gambar');
	
				$result1 = $this->upload->data();
				$result = array('gambar'=>$result1);
				$data1 = array('upload_data' => $this->upload->data());
				unlink('./assets/image/'.$this->input->post('foto'));

				$data['foto']	= $data1['upload_data']['file_name'];
			}

			if ($_FILES['ktp']['name'] != '') {
				// setting konfigurasi upload
				$nmktp = "ktp_".time();
				$config['file_name'] = $nmktp;
				// load library upload
				$this->load->library('upload', $config);
				// upload ktp 1
				$this->upload->do_upload('ktp');
	
				$ktp = $this->upload->data()['file_name'];
				unlink('./assets/image/'.$this->input->post('ktp'));

				$data['ktp']	= $ktp;
			}

			if($this->input->post('pass') !== ''){
				$data['pass']	= $passhash;
				$this->M_Admin->update_table('tbl_login','id_login',$id_login,$data);
			
				if($this->session->userdata('level') == 'Petugas')
				{
					$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
						<p> Berhasil Update User : '.$nama.' !</p>
						</div></div>');
					redirect(base_url('user/edit/'.$id_login)); 
				}elseif($this->session->userdata('level') == 'Anggota'){
					$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
						<p> Berhasil Update User : '.$nama.' !</p>
						</div></div>');
					redirect(base_url('user/edit/'.$id_login)); 
				} 
		
			}else{
				$this->M_Admin->update_table('tbl_login','id_login',$id_login,$data);
			
				if($this->session->userdata('level') == 'Petugas')
				{
					$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
						<p> Berhasil Update User : '.$nama.' !</p>
						</div></div>');
					redirect(base_url('user/edit/'.$id_login)); 
				}elseif($this->session->userdata('level') == 'Anggota'){

					$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
						<p> Berhasil Update User : '.$nama.' !</p>
						</div></div>');
					redirect(base_url('user/edit/'.$id_login)); 
				}
			}
		}
    }
    public function del()
    {
        if($this->uri->segment('3') == ''){ echo '<script>alert("halaman tidak ditemukan");window.location="'.base_url('user').'";</script>';}
        
        $user = $this->M_Admin->get_tableid_edit('tbl_login','id_login',$this->uri->segment('3'));
        unlink('./assets/image/'.$user->foto);
		$this->M_Admin->delete_table('tbl_login','id_login',$this->uri->segment('3'));
		
		$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-warning">
		<p> Berhasil Hapus User !</p>
		</div></div>');
		redirect(base_url('user'));  
    }
}
