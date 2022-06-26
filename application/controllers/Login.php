<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
        parent::__construct();
        //validasi jika user belum login
        $this->data['CI'] =& get_instance();
        $this->load->helper(array('form', 'url'));
        $this->load->model('M_login');
    
    }
	
	public function index()
	{
		$this->data['title_web'] = 'Login | Sistem Informasi Perpustakaan';
		$this->load->view('login_view',$this->data);
	}

    public function daftar()
    {
		$this->data['title_web'] = 'Daftar | Sistem Informasi Perpustakaan';
		$this->data['sidebar'] = 'register';
        $this->data['jur'] = $this->M_Admin->get_table('tbl_status');
        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('register',$this->data);
        $this->load->view('footer_view',$this->data);
    }

    public function add()
    {
		// format tabel / kode baru 3 hurup / id tabel / order by limit ngambil data terakhir
		$id = $this->M_Admin->buat_kode('tbl_login','AG','id_login','ORDER BY id_login DESC LIMIT 1'); 
		$nim = htmlentities($this->input->post('nim',TRUE));
        if($this->input->post('jurusan',TRUE)){
            $jur = htmlentities($this->input->post('jurusan',TRUE));
        }else{
            $jur = 0;
        }
		$nama = htmlentities($this->input->post('nama',TRUE));
        $user = htmlentities($this->input->post('user',TRUE));
        $pass = htmlentities($this->input->post('pass',TRUE));
        $level = "Anggota";
        $jenkel = htmlentities($this->input->post('jenkel',TRUE));
        $telepon = htmlentities($this->input->post('telepon',TRUE));
        $alamat = "-";
		$email = $this->input->post('email',TRUE);
		
		$passhash = password_hash($pass, PASSWORD_DEFAULT);
		
		$dd = $this->db->query("SELECT * FROM tbl_login WHERE user = '$user' OR email = '$email'");
		if($dd->num_rows() > 0)
		{
            $this->session->set_flashdata('failed','Gagal Update User : '.$nama.' !, Username / Email Anda Sudah Terpakai');
			redirect(base_url('login/daftar')); 
		}else{
            
            $data = array(
				'anggota_id' => $id,
                'nim'=>$nim,
				'nama'=>$nama,
				'id_status' => $jur,
                'user'=>$user,
                'pass'=>$passhash,
                'level'=>$level,
                'email'=>$_POST['email'],
                'telepon'=>$telepon,
                'jenkel'=>$jenkel,
                'foto' => '-',
                'alamat'=>$alamat,
                'tgl_bergabung'=>date('Y-m-d')
            );
			$this->db->insert('tbl_login',$data);
			
            $this->session->set_flashdata('success','Daftar User telah berhasil !');
			redirect(base_url('login'));
		}    
    }
    
    public function auth()
    {
        $user = htmlspecialchars($this->input->post('user',TRUE),ENT_QUOTES);
        $pass = htmlspecialchars($this->input->post('pass',TRUE),ENT_QUOTES);
        // auth
        $proses_login = $this->db->query("SELECT * FROM tbl_login WHERE user = ?", array($user));
        $row = $proses_login->num_rows();
        if($row > 0) {
            $hasil_login = $proses_login->row_array();
            if(password_verify($pass,$hasil_login['pass']))
			{
                $hasil_login = $proses_login->row_array();

                // create session
                $this->session->set_userdata('masuk_perpus',TRUE);
                $this->session->set_userdata('level',$hasil_login['level']);
                $this->session->set_userdata('ses_id',$hasil_login['id_login']);
                $this->session->set_userdata('anggota_id',$hasil_login['anggota_id']);
                
                redirect(base_url('dashboard'));
            }else{
                echo '<script>alert("Login Gagal, Periksa Kembali Password Anda"); window.location="'.base_url('login').'"</script>';
            }
        }else{
            echo '<script>alert("Login Gagal, Periksa Kembali Username dan Password Anda"); window.location="'.base_url('login').'"</script>';
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}
