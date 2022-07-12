<?php
/**
 * 
 * Author    : Fauzan Falah ( Anang )
 * File      : sqlquery_helper.php
 * Version   : v1.0.0
 * Ket       : Berisi tentang fungsi-fungsi sql query manual 
 * 
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('sql_transaksi')) {
	function sql_transaksi(){
        return "SELECT DISTINCT `pinjam_id`, `anggota_id`, `status`, `tgl_pinjam`, `lama_pinjam`, `tgl_balik`, `tgl_kembali`, tbl_buku.title, tbl_kategori.no_kelas, tbl_kategori.nama_kategori FROM tbl_pinjam
          JOIN tbl_buku ON tbl_pinjam.buku_id = tbl_buku.buku_id
          JOIN tbl_kategori ON tbl_buku.id_kategori = tbl_kategori.id_kategori
        ";
    }
}

if(!function_exists('unset_cart')) {
	function unset_cart(){
        $ci = & get_instance();
		$ci->db->where('login_id', $ci->session->userdata('ses_id'));
		return $ci->db->delete('tbl_keranjang');
    }
}
        
