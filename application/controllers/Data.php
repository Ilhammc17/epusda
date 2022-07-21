<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		$this->data['CI'] = &get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->model('M_Datatables');
		$this->load->model('subkategori_m');
		$this->load->model('pencarian_m');
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
		$this->data['subkategori'] = $this->db->query("SELECT * FROM tbl_subkategori JOIN tbl_buku ON tbl_buku.subkategori_id = tbl_subkategori.id_subkategori group by tbl_subkategori.id_subkategori")->result_array();
		$this->data['subkategori_filter'] = null;
		$this->data['filter_filter'] = null;
		$this->data['keyword_filter'] = null;

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku/buku_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function filter()
	{
		$input = $this->input->get();
		$this->data['uid'] = $this->session->userdata('ses_id');
		$this->data['buku'] =  $this->db->query("SELECT * FROM tbl_buku ORDER BY id_buku DESC");
		$this->data['title_web'] = 'Data Buku';
		$this->data['sidebar'] = 'buku_data';
		$this->data['subkategori'] = $this->db->query("SELECT * FROM tbl_subkategori JOIN tbl_buku ON tbl_buku.subkategori_id = tbl_subkategori.id_subkategori group by tbl_subkategori.id_subkategori")->result_array();
		$this->data['subkategori_filter'] = $input['subkategori'];
		$this->data['filter_filter'] = $input['filter'];
		$this->data['keyword_filter'] = $input['keyword'];


		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku/buku_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function insert_pencarian()
	{
		$data = $this->input->get();
		$this->db->select('*');
		$this->db->from('tbl_buku');
		$this->db->like('title', $data['keyword'], 'both');
		$buku = $this->db->get();
		if($buku->num_rows() > 0){
			foreach ($buku->result_array() as $key) {
				$this->pencarian_m->create([
					'subkategori_id' => $key['subkategori_id'],
					'buku_id' => $key['id_buku'],
					'tgl_pencarian' => date('Y-m-d')
				]);
			}
		}
		
	}

	public function data_buku()
	{
		$query  = "SELECT 
					tbl_kategori.nama_kategori,
					tbl_kategori.no_kelas,
					tbl_rak.nama_rak,
					tbl_buku.*,
          tbl_subkategori.nama_subkategori,
          tbl_sumber.nama_sumber
				FROM tbl_buku
				LEFT JOIN tbl_kategori ON tbl_buku.id_kategori=tbl_kategori.id_kategori
				LEFT JOIN tbl_subkategori ON tbl_buku.subkategori_id = tbl_subkategori.id_subkategori
				LEFT JOIN tbl_sumber ON tbl_buku.sumber_id = tbl_sumber.id_sumber
				LEFT JOIN tbl_rak ON tbl_buku.id_rak=tbl_rak.id_rak";

		$search = array('isbn', 'buku_id', 'title', 'nama_kategori', 'nama_subkategori', 'pengarang', 'no_kelas', 'nama_rak', 'penerbit', 'thn_buku', 'jml', 'dipinjam', 'tgl_masuk');
		$where  = null;
		if ($this->input->get('sortir')) {
			$sortir = htmlspecialchars($this->input->get('sortir'));
			$isWhere = "nama_kategori LIKE '%$sortir%'";
		} else {
			if ($this->input->get('rak')) {
				$rak = htmlspecialchars($this->input->get('rak'));
				$isWhere = "nama_rak LIKE '%$rak%'";
			} else {
				$isWhere = null;
			}
		}

		$include  = 'pengarang_tambahan';

		// $where  = array('nama_kategori' => 'Tutorial');
		// jika memakai IS NULL pada where sql
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere, $include);
	}

	public function data_buku_pinjam($anggota_id = null)
	{
		$query  = "SELECT 
					tbl_kategori.nama_kategori,
					tbl_kategori.no_kelas,
					tbl_rak.nama_rak,
					tbl_buku.*,
          tbl_subkategori.nama_subkategori,
          tbl_sumber.nama_sumber
				FROM tbl_buku
				LEFT JOIN tbl_kategori ON tbl_buku.id_kategori=tbl_kategori.id_kategori
				LEFT JOIN tbl_subkategori ON tbl_buku.subkategori_id = tbl_subkategori.id_subkategori
				LEFT JOIN tbl_sumber ON tbl_buku.sumber_id = tbl_sumber.id_sumber
				LEFT JOIN tbl_rak ON tbl_buku.id_rak=tbl_rak.id_rak";

		$search = array('isbn', 'buku_id', 'title', 'nama_kategori', 'nama_subkategori', 'pengarang', 'no_kelas', 'nama_rak', 'penerbit', 'thn_buku', 'jml', 'dipinjam', 'tgl_masuk');
		$where  = ['tbl_buku.jml >' => 1];

		if ($this->input->get('sortir')) {
			$sortir = htmlspecialchars($this->input->get('sortir'));
			$isWhere = "nama_kategori LIKE '%$sortir%' AND tbl_buku.buku_id NOT IN (SELECT buku_id FROM tbl_pinjam WHERE anggota_id = '$anggota_id' AND status = 'Dipinjam')";
		} else {
			if ($this->input->get('rak')) {
				$rak = htmlspecialchars($this->input->get('rak'));
				$isWhere = "nama_rak LIKE '%$rak%' AND tbl_buku.buku_id NOT IN (SELECT buku_id FROM tbl_pinjam WHERE anggota_id = '$anggota_id' AND status = 'Dipinjam')";
			} else {
        if ($anggota_id) {
          $isWhere  = "tbl_buku.buku_id NOT IN (SELECT buku_id FROM tbl_pinjam WHERE anggota_id = '$anggota_id' AND status = 'Dipinjam')";
        } else {
          $isWhere = null;
        }
			}
		}

		$include  = 'pengarang_tambahan';

		// $where  = array('nama_kategori' => 'Tutorial');
		// jika memakai IS NULL pada where sql
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere, $include);
	}

	public function bukudetail()
	{
		$this->data['uid'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('tbl_buku', 'id_buku', $this->uri->segment('3'));
		if ($count > 0) {
			$buku = $this->M_Admin->get_tableid_edit('tbl_buku', 'id_buku', $this->uri->segment('3'));
			$this->data['buku'] = $buku;
			$this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
			$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();
		} else {
			echo '<script>alert("BUKU TIDAK DITEMUKAN");window.location="' . base_url('data') . '"</script>';
		}

		$this->data['sidebar'] = 'buku';
		$this->data['title_web'] = 'Data Buku Detail';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku/detail', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function bukuedit()
	{
		if ($this->session->userdata('masuk_perpus') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}
		$this->data['uid'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('tbl_buku', 'id_buku', $this->uri->segment('3'));
		if ($count > 0) {

			$this->data['buku'] = $this->M_Admin->get_tableid_edit('tbl_buku', 'id_buku', $this->uri->segment('3'));

			$this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
			$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();
			$this->data['sumber'] =  $this->db->query("SELECT * FROM tbl_sumber ORDER BY id_sumber DESC")->result_array();
			$this->data['subkategori'] =  $this->db->get_where('tbl_subkategori', ['kategori_id' => $this->data['buku']->id_kategori])->result_array();
		} else {
			echo '<script>alert("BUKU TIDAK DITEMUKAN");window.location="' . base_url('data') . '"</script>';
		}

		$this->data['sidebar'] = 'buku';
		$this->data['title_web'] = 'Data Buku Edit';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku/edit_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function bukutambah()
	{
		if ($this->session->userdata('masuk_perpus') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}
		$this->data['uid'] = $this->session->userdata('ses_id');

		$this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
		$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();
		$this->data['sumber'] =  $this->db->query("SELECT * FROM tbl_sumber ORDER BY id_sumber DESC")->result_array();


		$this->data['sidebar'] = 'buku';
		$this->data['title_web'] = 'Tambah Buku';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku/tambah_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function prosesbuku()
	{
		if ($this->session->userdata('masuk_perpus') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}

		// hapus aksi form proses buku
		if (!empty($this->input->get('buku_id'))) {

			$buku = $this->M_Admin->get_tableid_edit('tbl_buku', 'id_buku', htmlentities($this->input->get('buku_id')));

			$sampul = './assets/image/buku/' . $buku->sampul;
			if (file_exists($sampul)) {
				unlink($sampul);
			}

			$lampiran = './assets/image/buku/' . $buku->lampiran;
			if (file_exists($lampiran)) {
				unlink($lampiran);
			}

			$this->M_Admin->delete_table('tbl_buku', 'id_buku', $this->input->get('buku_id'));

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
					<p> Berhasil Hapus Buku !</p>
				</div></div>');
			redirect(base_url('data'));
		}

		// tambah aksi form proses buku
		if (!empty($this->input->post('tambah'))) {
      $this->form_validation->set_rules('kategori', 'Kategori', 'required');
      $this->form_validation->set_rules('subkategori_id', 'Sub Kategori', 'required');
      $this->form_validation->set_rules('sumber_id', 'Sumber', 'required');
      $this->form_validation->set_rules('title', 'Title', 'required');
      $this->form_validation->set_rules('pengarang', 'Pengarang', 'required');
      $this->form_validation->set_rules('rak', 'Rak', 'required');
      $this->form_validation->set_rules('isbn', 'ISBN', 'required');
      $this->form_validation->set_rules('tempat_terbit', 'Tempat Terbit', 'required');
      $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
      $this->form_validation->set_rules('thn', 'Tahun', 'required');
      $this->form_validation->set_rules('jml', 'Jumlah', 'required');
      $this->form_validation->set_rules('ket', 'Keterangan', 'required');
  
      if ($this->form_validation->run() !== FALSE) {$post = $this->input->post();
        $buku_id = $this->M_Admin->buat_kode('tbl_buku', 'BK', 'id_buku', 'ORDER BY id_buku DESC LIMIT 1');
        $data = array(
          'buku_id' => $buku_id,
          'id_kategori' => htmlentities($post['kategori']),
          'subkategori_id'	=> htmlentities($post['subkategori_id']),
          'id_rak' => htmlentities($post['rak']),
          'isbn' => htmlentities($post['isbn']),
          'title'  => htmlentities($post['title']),
          'pengarang' => htmlentities($post['pengarang']),
          'penerbit' => htmlentities($post['penerbit']),
          'sumber_id' => htmlentities($post['sumber_id']),
          'thn_buku' => htmlentities($post['thn']),
          'isi' => $this->input->post('ket'),
          'jml' => htmlentities($post['jml']),
          'tgl_masuk' => date('Y-m-d H:i:s')
        );
  
        if (!empty($_FILES['gambar']['name'])) {
          // setting konfigurasi upload
          $config['upload_path'] = './assets/image/buku/';
          $config['allowed_types'] = 'gif|jpg|jpeg|png';
          $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
          // load library upload
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
  
          if ($this->upload->do_upload('gambar')) {
            $this->upload->data();
            $file1 = array('upload_data' => $this->upload->data());
            $this->db->set('sampul', $file1['upload_data']['file_name']);
          } else {
            $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
                <p> Edit Buku Gagal !</p>
              </div></div>');
            redirect(base_url('data'));
          }
        }
  
        if (!empty($_FILES['lampiran']['name'])) {
          // setting konfigurasi upload
          $config['upload_path'] = './assets/image/buku/';
          $config['allowed_types'] = 'pdf';
          $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
          // load library upload
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
          // script uplaod file kedua
          if ($this->upload->do_upload('lampiran')) {
            $this->upload->data();
            $file2 = array('upload_data' => $this->upload->data());
            $this->db->set('lampiran', $file2['upload_data']['file_name']);
          } else {
  
            $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
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
  
        $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
        <p> Tambah Buku Sukses !</p>
        </div></div>');
        redirect(base_url('data'));
      } else {
        $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
          <p>' . validation_errors() . '</p>
          </div></div>'
        );
        redirect($_SERVER['HTTP_REFERER']);
      }
		}

		// edit aksi form proses buku
		if (!empty($this->input->post('edit'))) {
			$post = $this->input->post();
			$data = array(
				'id_kategori' => htmlentities($post['kategori']),
				'subkategori_id'	=> htmlentities($post['subkategori_id']),
				'id_rak' => htmlentities($post['rak']),
				'isbn' => htmlentities($post['isbn']),
				'title'  => htmlentities($post['title']),
				'pengarang' => htmlentities($post['pengarang']),
				'penerbit' => htmlentities($post['penerbit']),
				'sumber_id' => htmlentities($post['sumber_id']),
				'thn_buku' => htmlentities($post['thn']),
				'isi' => $this->input->post('ket'),
				'jml' => htmlentities($post['jml']),
				'tgl_masuk' => date('Y-m-d H:i:s')
			);

			if (!empty($_FILES['gambar']['name'])) {
				// setting konfigurasi upload
				$config['upload_path'] = './assets/image/buku/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
				// load library upload
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('gambar')) {
					$this->upload->data();
					$gambar = './assets/image/buku/' . htmlentities($post['gmbr']);
					if (file_exists($gambar)) {
						unlink($gambar);
					}
					$file1 = array('upload_data' => $this->upload->data());
					$this->db->set('sampul', $file1['upload_data']['file_name']);
				} else {
					$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
							<p> Edit Buku Gagal !</p>
						</div></div>');
					redirect(base_url('data'));
				}
			}

			if (!empty($_FILES['lampiran']['name'])) {
				// setting konfigurasi upload
				$config['upload_path'] = './assets/image/buku/';
				$config['allowed_types'] = 'pdf';
				$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
				// load library upload
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				// script uplaod file kedua
				if ($this->upload->do_upload('lampiran')) {
					$this->upload->data();
					$lampiran = './assets/image/buku/' . htmlentities($post['lamp']);
					if (file_exists($lampiran)) {
						unlink($lampiran);
					}
					$file2 = array('upload_data' => $this->upload->data());
					$this->db->set('lampiran', $file2['upload_data']['file_name']);
				} else {

					$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
							<p> Edit Buku Gagal !</p>
						</div></div>');
					redirect(base_url('data'));
				}
			}

			$this->db->where('id_buku', htmlentities($post['edit']));
			$this->db->update('tbl_buku', $data);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
					<p> Edit Buku Sukses !</p>
				</div></div>');
			redirect(base_url('data'));
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
		if ($this->session->userdata('masuk_perpus') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}

		$this->data['uid'] = $this->session->userdata('ses_id');
		$this->data['kategori'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC");

		if (!empty($this->input->get('id'))) {
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_kategori', 'id_kategori', $id);
			if ($count > 0) {
				$this->data['kat'] = $this->db->query("SELECT *FROM tbl_kategori WHERE id_kategori='$id'")->row();
			} else {
				echo '<script>alert("KATEGORI TIDAK DITEMUKAN");window.location="' . base_url('data/kategori') . '"</script>';
			}
		}
		$this->data['sidebar'] = 'kategori';
		$this->data['title_web'] = 'Data Kategori ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('kategori/kat_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function data_kategori()
	{
		$tables = "tbl_kategori";
		$search = array('nama_kategori');
		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables($tables, $search, $isWhere);
	}

	public function katproses()
	{
		if ($this->session->userdata('masuk_perpus') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}

		$kategoriUnique = $this->db->like('nama_kategori', $this->input->post('kategori'))->get('tbl_kategori');
		$noKelasUnique  = $this->db->like('no_kelas', $this->input->post('no_kelas'))->get('tbl_kategori');

		// tambah aksi form proses kategori
		if (!empty($this->input->post('tambah'))) {
			$this->form_validation->set_rules('no_kelas', 'No. Kelas', 'required', ['required' => 'No. kelas harus diisi']);
			$this->form_validation->set_rules('kategori', 'Nama Kategori', 'required', ['required' => 'Nama kategori harus diisi']);

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
            <p>' . validation_errors() . '</p>
          </div></div>');
			} else {
				if ($kategoriUnique->num_rows() <= 0) {
					if ($noKelasUnique->num_rows() <= 0) {
						$post = $this->input->post();
						$data = array(
							'no_kelas'      => htmlentities($post['no_kelas']),
							'nama_kategori' => htmlentities($post['kategori']),
						);

						$this->db->insert('tbl_kategori', $data);


						$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
            <p> Tambah Kategori Sukses !</p>
            </div></div>');
						redirect(base_url('data/kategori'));
					} else {
						$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
                <p>No kelas sudah digunakan</p>
              </div></div>');
					}
				} else {
					$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
              <p>Nama kategori sudah digunakan</p>
            </div></div>');
				}
			}
			redirect($_SERVER['HTTP_REFERER']);
		}

		// edit aksi form proses kategori
		if (!empty($this->input->post('edit'))) {
			$this->form_validation->set_rules('no_kelas', 'No. Kelas', 'required', ['required' => 'No. kelas harus diisi']);
			$this->form_validation->set_rules('kategori', 'Nama Kategori', 'required', ['required' => 'Nama kategori harus diisi']);

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
            <p>' . validation_errors() . '</p>
          </div></div>');
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$post = $this->input->post();
				$data = array(
					'no_kelas'      => htmlentities($post['no_kelas']),
					'nama_kategori' => htmlentities($post['kategori']),
				);
				$this->db->where('id_kategori', htmlentities($post['edit']));
				$this->db->update('tbl_kategori', $data);


				$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
        <p> Edit Kategori Sukses !</p>
        </div></div>');
				redirect(base_url('data/kategori'));
			}
		}

		// hapus aksi form proses kategori
		if (!empty($this->input->get('kat_id'))) {
			$this->db->where('id_kategori', $this->input->get('kat_id'));
			$this->db->delete('tbl_kategori');

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
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
		if ($this->session->userdata('masuk_perpus') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}

		$this->data['uid'] = $this->session->userdata('ses_id');
		$this->data['jurusan'] =  $this->db->query("SELECT * FROM tbl_status ORDER BY id_status DESC");

		$this->data['sidebar'] = 'jurusan';
		if (!empty($this->input->get('id'))) {
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_status', 'id_status', $id);
			if ($count > 0) {
				$this->data['kat'] = $this->db->query("SELECT *FROM tbl_status WHERE id_status='$id'")->row();
			} else {
				echo '<script>alert("status TIDAK DITEMUKAN");window.location="' . base_url('data/jurusan') . '"</script>';
			}
		}

		$this->data['title_web'] = 'Data Status ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('jurusan/home', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function data_jurusan()
	{
		if ($this->session->userdata('masuk_perpus') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}
		$tables = "tbl_status";
		$search = array('nama_status');
		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables($tables, $search, $isWhere);
	}

	public function jurproses()
	{
		if ($this->session->userdata('masuk_perpus') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}

		// tambah aksi form proses jurusan
		if (!empty($this->input->post('tambah'))) {
			$this->form_validation->set_rules('jurusan', 'Status', 'required', ['required' => 'Status harus diisi']);

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
            <p>' . validation_errors() . '</p>
          </div></div>');
			} else {
				$jurusanUnique  = $this->db->like('nama_status', $this->input->post('jurusan'))->get('tbl_status');

				if ($jurusanUnique->num_rows() <= 0) {
					$post = $this->input->post();
					$data = array(
						'nama_status' => htmlentities($post['jurusan']),
					);

					$this->db->insert('tbl_status', $data);


					$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
          <p> Tambah status Sukses !</p>
          </div></div>');
					redirect(base_url('data/jurusan'));
				} else {
					$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
              <p>Status sudah digunakan</p>
            </div></div>');
				}
			}
			redirect($_SERVER['HTTP_REFERER']);
		}

		// edit aksi form proses jurusan
		if (!empty($this->input->post('edit'))) {
			$post = $this->input->post();
			$data = array(
				'nama_status' => htmlentities($post['jurusan']),
			);
			$this->db->where('id_status', htmlentities($post['edit']));
			$this->db->update('tbl_status', $data);


			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Edit status Sukses !</p>
			</div></div>');
			redirect(base_url('data/jurusan'));
		}

		// hapus aksi form proses jurusan
		if (!empty($this->input->get('kat_id'))) {
			$this->db->where('id_status', $this->input->get('kat_id'));
			$this->db->delete('tbl_status');

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
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

		if ($this->session->userdata('masuk_perpus') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}
		$this->data['uid'] = $this->session->userdata('ses_id');
		$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC");

		$this->data['sidebar'] = 'rak';
		if (!empty($this->input->get('id'))) {
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_rak', 'id_rak', $id);
			if ($count > 0) {
				$this->data['rak'] = $this->db->query("SELECT *FROM tbl_rak WHERE id_rak='$id'")->row();
			} else {
				echo '<script>alert("KATEGORI TIDAK DITEMUKAN");window.location="' . base_url('data/rak') . '"</script>';
			}
		}

		$this->data['title_web'] = 'Data Rak Buku ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('rak/rak_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function data_rak()
	{
		if ($this->session->userdata('masuk_perpus') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}
		$tables = "tbl_rak";
		$search = array('nama_rak');
		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables($tables, $search, $isWhere);
	}

	public function rakproses()
	{
		if ($this->session->userdata('masuk_perpus') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}

		// tambah aksi form proses rak
		if (!empty($this->input->post('tambah'))) {
			$this->form_validation->set_rules('rak', 'Rak', 'required', ['required' => 'Rak harus diisi']);

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
            <p>' . validation_errors() . '</p>
          </div></div>');
			} else {
				$rakUnique  = $this->db->like('nama_rak', $this->input->post('rak'))->get('tbl_rak');

				if ($rakUnique->num_rows() <= 0) {
					$post = $this->input->post();
					$data = array(
						'nama_rak' => htmlentities($post['rak']),
					);

					$this->db->insert('tbl_rak', $data);


					$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
          <p> Tambah Rak Buku Sukses !</p>
          </div></div>');
					redirect(base_url('data/rak'));
				} else {
					$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
              <p>Rak sudah digunakan</p>
            </div></div>');
				}
			}
			redirect($_SERVER['HTTP_REFERER']);
		}

		// edit aksi form proses rak
		if (!empty($this->input->post('edit'))) {
			$post = $this->input->post();
			$data = array(
				'nama_rak' => htmlentities($post['rak']),
			);
			$this->db->where('id_rak', htmlentities($post['edit']));
			$this->db->update('tbl_rak', $data);


			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Rak Sukses !</p>
			</div></div>');
			redirect(base_url('data/rak'));
		}

		// hapus aksi form proses rak
		if (!empty($this->input->get('rak_id'))) {
			$this->db->where('id_rak', $this->input->get('rak_id'));
			$this->db->delete('tbl_rak');

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p> Hapus Rak Buku Sukses !</p>
			</div></div>');
			redirect(base_url('data/rak'));
		}
	}

  public function trackPengunjung()
  {
		$this->data['title_web']        = 'Visitor Counter';
		$this->data['count_pengunjung'] = $this->db->query("SELECT * FROM tbl_pengunjung WHERE created_at = ?", [date('Y-m-d')])->num_rows();
		$this->data['sidebar']          = 'track';

		$this->load->view('header_view',$this->data);
		$this->load->view('sidebar_view',$this->data);
		$this->load->view('track_view',$this->data);
		$this->load->view('footer_view',$this->data);
  }

  public function storeTrackPengunjung()
  {
		$this->form_validation->set_rules("nama", "Nama", "required");
		$this->form_validation->set_rules("pekerjaan", "Pekerjaan", "required");
		$this->form_validation->set_rules("pendidikan_terakhir", "Pendidikan Terakhir", "required");
		$this->form_validation->set_rules("jenis_kelamin", "Jenis Kelamin", "required");
		$this->form_validation->set_rules("alamat", "Alamat", "required");
		$this->form_validation->set_rules("token", "Token", "required");

    if ($this->form_validation->run() !== FALSE) {
      $result = $this->db->get_where('token', ['token' => $this->input->post('token')])->row_array();

      if ($result) {
        $this->db->insert('tbl_pengunjung', $this->input->post());
        $this->session->set_flashdata("success", "Berhasil input pengunjung");
      } else {
        $this->session->set_flashdata("failed", "Token salah!");
      }
    } else {
			$this->session->set_flashdata("failed", "Gagal Insert Data ! " . validation_errors());
    }

    redirect($_SERVER['HTTP_REFERER']);
  }

  public function generateToken()
  {
    $this->db->update('token', ['token' => random_int(1000, 9999)], ['id_token' => 1]);
    redirect($_SERVER['HTTP_REFERER']);
  }
	/*
	|	END CRUD MENU RAK
	*/
}
