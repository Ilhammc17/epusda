<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spk extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //validasi jika user belum login
    $this->data['CI'] = &get_instance();
    $this->load->helper(array('form', 'url'));
    $this->load->model('M_Admin');
    if ($this->session->userdata('masuk_perpus') != TRUE) {
      $url = base_url('login');
      redirect($url);
    }
    $this->load->model('subkategori_m');
    $this->load->model('buku_m');
  }

  public function index()
  {
    $this->data['uid'] = $this->session->userdata('ses_id');
    $this->data['title_web'] = 'SPK ';
    $this->data['sidebar'] = 'spk';

    $this->load->view('header_view', $this->data);
    $this->load->view('sidebar_view', $this->data);
    $this->load->view('spk_view', $this->data);
    $this->load->view('footer_view', $this->data);
  }

  public function prosesspk()
  {
    $data = $this->input->post();
    if ($data['jenis_tahun'] == 'start') {
      redirect(base_url('spk/generate_from/' . $data['tahun']));
    } else {
      redirect(base_url('spk/generate/' . $data['tahun']));
    }
  }

  public function generate($year)
  {
    // ambil centeroid
    $centeroid = $this->buku_m->get_book_spk_three_where_year($year)->result_array();

    // ambil data-data spk
    $all_data = $this->buku_m->get_book_spk_where_year($year)->result_array();

    $iteration = 1;

    $c1[0] = $centeroid[0];
    $c2[0] = $centeroid[1];
    $c3[0] = $centeroid[2];

    // c1 , c2 , c3
    $data_c1 = [];
    $data_c2 = [];
    $data_c3 = [];
    $list_all_data[0] = $all_data;
    foreach ($list_all_data[0] as $index => $item_data) {
      $list_all_data[0][$index]['c1'] = sqrt(pow($item_data['peminjam'] - $centeroid[0]['peminjam'], 2)) + pow($item_data['stok'] - $centeroid[0]['stok'], 2) + pow($item_data['pencarian'] - $centeroid[0]['pencarian'], 2);
      $list_all_data[0][$index]['c2'] = sqrt(pow($item_data['peminjam'] - $centeroid[1]['peminjam'], 2)) + pow($item_data['stok'] - $centeroid[1]['stok'], 2) + pow($item_data['pencarian'] - $centeroid[1]['pencarian'], 2);
      $list_all_data[0][$index]['c3'] = sqrt(pow($item_data['peminjam'] - $centeroid[2]['peminjam'], 2)) + pow($item_data['stok'] - $centeroid[2]['stok'], 2) + pow($item_data['pencarian'] - $centeroid[2]['pencarian'], 2);
      $list_all_data[0][$index]['jarak'] = min($list_all_data[0][$index]['c1'], $list_all_data[0][$index]['c2'], $list_all_data[0][$index]['c3']);
      if ($list_all_data[0][$index]['jarak'] == $list_all_data[0][$index]['c1']) {
        $list_all_data[0][$index]['label'] = 'c1';
        array_push($data_c1, $list_all_data[0][$index]);
      } else if ($list_all_data[0][$index]['jarak'] == $list_all_data[0][$index]['c2']) {
        $list_all_data[0][$index]['label'] = 'c2';
        array_push($data_c2, $list_all_data[0][$index]);
      } else if ($list_all_data[0][$index]['jarak'] == $list_all_data[0][$index]['c3']) {
        $list_all_data[0][$index]['label'] = 'c3';
        array_push($data_c3, $list_all_data[0][$index]);
      } else {
        $list_all_data[0][$index]['label'] = 'undefined';
      }
    }

    $iteration++;

    $any_error = 1;

    while ($any_error > 0) {
      $any_error = 0;

      // prepare mencari centeroid 2
      $c1[$iteration - 1] = [
        'stok' => count($data_c1) == 0 ? 0 : array_sum(array_column($data_c1, 'stok')) / count($data_c1),
        'peminjam' => count($data_c1) == 0 ? 0 : array_sum(array_column($data_c1, 'peminjam')) / count($data_c1),
        'pencarian' => count($data_c1) == 0 ? 0 : array_sum(array_column($data_c1, 'pencarian')) / count($data_c1),
      ];
      $c2[$iteration - 1] = [
        'stok' => count($data_c2) == 0 ? 0 : array_sum(array_column($data_c2, 'stok')) / count($data_c2),
        'peminjam' => count($data_c2) == 0 ? 0 : array_sum(array_column($data_c2, 'peminjam')) / count($data_c2),
        'pencarian' => count($data_c2) == 0 ? 0 : array_sum(array_column($data_c2, 'pencarian')) / count($data_c2),
      ];
      $c3[$iteration - 1] = [
        'stok' => count($data_c3) == 0 ? 0 : array_sum(array_column($data_c3, 'stok')) / count($data_c3),
        'peminjam' => count($data_c3) == 0 ? 0 : array_sum(array_column($data_c3, 'peminjam')) / count($data_c3),
        'pencarian' => count($data_c3) == 0 ? 0 : array_sum(array_column($data_c3, 'pencarian')) / count($data_c3),
      ];

      $list_all_data[$iteration - 1] = $list_all_data[$iteration - 2];

      foreach ($list_all_data[$iteration - 1] as $index => $item_data) {
        $list_all_data[$iteration - 1][$index]['c1'] = sqrt(pow($item_data['peminjam'] - $c1[$iteration - 1]['peminjam'], 2)) + pow($item_data['stok'] - $c1[$iteration - 1]['stok'], 2) + pow($item_data['pencarian'] - $c1[$iteration - 1]['pencarian'], 2);
        $list_all_data[$iteration - 1][$index]['c2'] = sqrt(pow($item_data['peminjam'] - $c2[$iteration - 1]['peminjam'], 2)) + pow($item_data['stok'] - $c2[$iteration - 1]['stok'], 2) + pow($item_data['pencarian'] - $c2[$iteration - 1]['pencarian'], 2);
        $list_all_data[$iteration - 1][$index]['c3'] = sqrt(pow($item_data['peminjam'] - $c3[$iteration - 1]['peminjam'], 2)) + pow($item_data['stok'] - $c3[$iteration - 1]['stok'], 2) + pow($item_data['pencarian'] - $c3[$iteration - 1]['pencarian'], 2);
        $list_all_data[$iteration - 1][$index]['jarak'] = min($list_all_data[$iteration - 1][$index]['c1'], $list_all_data[$iteration - 1][$index]['c2'], $list_all_data[$iteration - 1][$index]['c3']);
        if ($list_all_data[$iteration - 1][$index]['jarak'] == $list_all_data[$iteration - 1][$index]['c1']) {
          $all_data2[$index]['label'] = 'c1';
          array_push($data_c1, $all_data2[$index]);
        } else if ($list_all_data[$iteration - 1][$index]['jarak'] == $list_all_data[$iteration - 1][$index]['c2']) {
          $all_data2[$index]['label'] = 'c2';
          array_push($data_c2, $all_data2[$index]);
        } else if ($list_all_data[$iteration - 1][$index]['jarak'] == $list_all_data[$iteration - 1][$index]['c3']) {
          $all_data2[$index]['label'] = 'c3';
          array_push($data_c3, $all_data2[$index]);
        } else {
          $all_data2[$index]['label'] = 'undefined';
        }
      }

      // membandingkan pola
      $compare1 = array_column($list_all_data[$iteration - 1], 'label');
      $compare2 = array_column($list_all_data[$iteration - 2], 'label');

      if ($compare1 != $compare2) {
        $any_error = 1;
      }

      $iteration++;
    }

    $result_c1 = [];
    $result_c2 = [];
    $result_c3 = [];

    foreach ($list_all_data[$iteration - 2] as $item) {
      $buku = $this->buku_m->get_one_result_cluster($item['id_subkategori'])->row_array();
      $item['judul_buku'] = $buku['title'];
      $item['stok_per_buku'] = $buku['jml'];
      if ($item['label'] == 'c1') {
        array_push($result_c1, $item);
      } else if ($item['label'] == 'c2') {
        array_push($result_c2, $item);
      } else if ($item['label'] == 'c3') {
        array_push($result_c3, $item);
      }
    }

    $this->data['uid'] = $this->session->userdata('ses_id');
    $this->data['title_web'] = 'SPK ';
    $this->data['sidebar'] = 'spk';

    $this->load->view('header_view', $this->data);
    $this->load->view('sidebar_view', $this->data);
    $this->load->view('spk_result_view', [
      'list_all_data' => $list_all_data,
      'c1' => $c1,
      'c2' => $c2,
      'c3' => $c3,
      'result_c1' => $result_c1,
      'result_c2' => $result_c2,
      'result_c3' => $result_c3,
    ]);
    $this->load->view('footer_view', $this->data);
  }

  public function generate_from($year)
  {
    // ambil centeroid
    $centeroid = $this->buku_m->get_book_spk_three_where_year($year)->result_array();

    // ambil data-data spk
    $all_data = $this->buku_m->get_book_spk_where_year($year)->result_array();

    $iteration = 1;

    $c1[0] = $centeroid[0];
    $c2[0] = $centeroid[1];
    $c3[0] = $centeroid[2];

    // c1 , c2 , c3
    $data_c1 = [];
    $data_c2 = [];
    $data_c3 = [];
    $list_all_data[0] = $all_data;
    foreach ($list_all_data[0] as $index => $item_data) {
      $list_all_data[0][$index]['c1'] = sqrt(pow($item_data['peminjam'] - $centeroid[0]['peminjam'], 2)) + pow($item_data['stok'] - $centeroid[0]['stok'], 2) + pow($item_data['pencarian'] - $centeroid[0]['pencarian'], 2);
      $list_all_data[0][$index]['c2'] = sqrt(pow($item_data['peminjam'] - $centeroid[1]['peminjam'], 2)) + pow($item_data['stok'] - $centeroid[1]['stok'], 2) + pow($item_data['pencarian'] - $centeroid[1]['pencarian'], 2);
      $list_all_data[0][$index]['c3'] = sqrt(pow($item_data['peminjam'] - $centeroid[2]['peminjam'], 2)) + pow($item_data['stok'] - $centeroid[2]['stok'], 2) + pow($item_data['pencarian'] - $centeroid[2]['pencarian'], 2);
      $list_all_data[0][$index]['jarak'] = min($list_all_data[0][$index]['c1'], $list_all_data[0][$index]['c2'], $list_all_data[0][$index]['c3']);
      if ($list_all_data[0][$index]['jarak'] == $list_all_data[0][$index]['c1']) {
        $list_all_data[0][$index]['label'] = 'c1';
        array_push($data_c1, $list_all_data[0][$index]);
      } else if ($list_all_data[0][$index]['jarak'] == $list_all_data[0][$index]['c2']) {
        $list_all_data[0][$index]['label'] = 'c2';
        array_push($data_c2, $list_all_data[0][$index]);
      } else if ($list_all_data[0][$index]['jarak'] == $list_all_data[0][$index]['c3']) {
        $list_all_data[0][$index]['label'] = 'c3';
        array_push($data_c3, $list_all_data[0][$index]);
      } else {
        $list_all_data[0][$index]['label'] = 'undefined';
      }
    }

    $iteration++;

    $any_error = 1;

    while ($any_error > 0) {
      $any_error = 0;

      // prepare mencari centeroid 2
      $c1[$iteration - 1] = [
        'stok' => count($data_c1) == 0 ? 0 : array_sum(array_column($data_c1, 'stok')) / count($data_c1),
        'peminjam' => count($data_c1) == 0 ? 0 : array_sum(array_column($data_c1, 'peminjam')) / count($data_c1),
        'pencarian' => count($data_c1) == 0 ? 0 : array_sum(array_column($data_c1, 'pencarian')) / count($data_c1),
      ];
      $c2[$iteration - 1] = [
        'stok' => count($data_c2) == 0 ? 0 : array_sum(array_column($data_c2, 'stok')) / count($data_c2),
        'peminjam' => count($data_c2) == 0 ? 0 : array_sum(array_column($data_c2, 'peminjam')) / count($data_c2),
        'pencarian' => count($data_c2) == 0 ? 0 : array_sum(array_column($data_c2, 'pencarian')) / count($data_c2),
      ];
      $c3[$iteration - 1] = [
        'stok' => count($data_c3) == 0 ? 0 : array_sum(array_column($data_c3, 'stok')) / count($data_c3),
        'peminjam' => count($data_c3) == 0 ? 0 : array_sum(array_column($data_c3, 'peminjam')) / count($data_c3),
        'pencarian' => count($data_c3) == 0 ? 0 : array_sum(array_column($data_c3, 'pencarian')) / count($data_c3),
      ];

      $list_all_data[$iteration - 1] = $list_all_data[$iteration - 2];

      foreach ($list_all_data[$iteration - 1] as $index => $item_data) {
        $list_all_data[$iteration - 1][$index]['c1'] = sqrt(pow($item_data['peminjam'] - $c1[$iteration - 1]['peminjam'], 2)) + pow($item_data['stok'] - $c1[$iteration - 1]['stok'], 2) + pow($item_data['pencarian'] - $c1[$iteration - 1]['pencarian'], 2);
        $list_all_data[$iteration - 1][$index]['c2'] = sqrt(pow($item_data['peminjam'] - $c2[$iteration - 1]['peminjam'], 2)) + pow($item_data['stok'] - $c2[$iteration - 1]['stok'], 2) + pow($item_data['pencarian'] - $c2[$iteration - 1]['pencarian'], 2);
        $list_all_data[$iteration - 1][$index]['c3'] = sqrt(pow($item_data['peminjam'] - $c3[$iteration - 1]['peminjam'], 2)) + pow($item_data['stok'] - $c3[$iteration - 1]['stok'], 2) + pow($item_data['pencarian'] - $c3[$iteration - 1]['pencarian'], 2);
        $list_all_data[$iteration - 1][$index]['jarak'] = min($list_all_data[$iteration - 1][$index]['c1'], $list_all_data[$iteration - 1][$index]['c2'], $list_all_data[$iteration - 1][$index]['c3']);
        if ($list_all_data[$iteration - 1][$index]['jarak'] == $list_all_data[$iteration - 1][$index]['c1']) {
          $all_data2[$index]['label'] = 'c1';
          array_push($data_c1, $all_data2[$index]);
        } else if ($list_all_data[$iteration - 1][$index]['jarak'] == $list_all_data[$iteration - 1][$index]['c2']) {
          $all_data2[$index]['label'] = 'c2';
          array_push($data_c2, $all_data2[$index]);
        } else if ($list_all_data[$iteration - 1][$index]['jarak'] == $list_all_data[$iteration - 1][$index]['c3']) {
          $all_data2[$index]['label'] = 'c3';
          array_push($data_c3, $all_data2[$index]);
        } else {
          $all_data2[$index]['label'] = 'undefined';
        }
      }

      // membandingkan pola
      $compare1 = array_column($list_all_data[$iteration - 1], 'label');
      $compare2 = array_column($list_all_data[$iteration - 2], 'label');

      if ($compare1 != $compare2) {
        $any_error = 1;
      }

      $iteration++;
    }

    $result_c1 = [];
    $result_c2 = [];
    $result_c3 = [];

    foreach ($list_all_data[$iteration - 2] as $item) {
      $buku = $this->buku_m->get_one_result_cluster($item['id_subkategori'])->row_array();
      $item['judul_buku'] = $buku['title'];
      $item['stok_per_buku'] = $buku['jml'];
      if ($item['label'] == 'c1') {
        array_push($result_c1, $item);
      } else if ($item['label'] == 'c2') {
        array_push($result_c2, $item);
      } else if ($item['label'] == 'c3') {
        array_push($result_c3, $item);
      }
    }


    $this->data['uid'] = $this->session->userdata('ses_id');
    $this->data['title_web'] = 'SPK ';
    $this->data['sidebar'] = 'spk';

    $this->load->view('header_view', $this->data);
    $this->load->view('sidebar_view', $this->data);
    $this->load->view('spk_result_view', [
      'list_all_data' => $list_all_data,
      'c1' => $c1,
      'c2' => $c2,
      'c3' => $c3,
      'result_c1' => $result_c1,
      'result_c2' => $result_c2,
      'result_c3' => $result_c3,
    ]);
    $this->load->view('footer_view', $this->data);
  }
}
