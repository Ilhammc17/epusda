
<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Buku_m extends Base_m
{
  public $table = "tbl_buku";

  public function get_book_spk()
  {
    return $this->db->query('SELECT tbl_subkategori.id_subkategori, tbl_kategori.nama_kategori, tbl_subkategori.nama_subkategori, sum(tbl_buku.jml) as stok, IFNULL(sum((SELECT sum(tbl_pinjam.jml) FROM tbl_pinjam WHERE tbl_pinjam.buku_id = tbl_buku.buku_id)),0) as peminjam, (SELECT count(*) from tbl_pencarian WHERE tbl_pencarian.subkategori_id = tbl_buku.subkategori_id) as pencarian
    FROM tbl_buku
    JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku.id_kategori 
    JOIN tbl_subkategori ON tbl_subkategori.id_subkategori  = tbl_buku.subkategori_id GROUP BY tbl_subkategori.id_subkategori;');
  }

  public function get_book_spk_three()
  {
    return $this->db->query("SELECT tbl_subkategori.id_subkategori, tbl_kategori.nama_kategori, tbl_subkategori.nama_subkategori, sum(tbl_buku.jml) as stok, IFNULL(sum((SELECT sum(tbl_pinjam.jml) FROM tbl_pinjam WHERE tbl_pinjam.buku_id = tbl_buku.buku_id)),0) as peminjam, (SELECT count(*) from tbl_pencarian WHERE tbl_pencarian.subkategori_id = tbl_buku.subkategori_id) as pencarian
    FROM tbl_buku
    RIGHT JOIN tbl_subkategori ON tbl_subkategori.id_subkategori  = tbl_buku.subkategori_id 
    JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku.id_kategori 
    GROUP BY tbl_subkategori.id_subkategori LIMIT 3;");
  }

  public function get_book_spk_three_where_year($year)
  {
    return $this->db->query("SELECT tbl_subkategori.id_subkategori, tbl_kategori.nama_kategori, tbl_subkategori.nama_subkategori, sum(tbl_buku.jml) as stok, IFNULL(sum((SELECT sum(tbl_pinjam.jml) FROM tbl_pinjam WHERE tbl_pinjam.buku_id = tbl_buku.buku_id AND YEAR(tbl_pinjam.tgl_pinjam) = $year)),0) as peminjam, (SELECT count(*) from tbl_pencarian WHERE tbl_pencarian.subkategori_id = tbl_buku.subkategori_id AND YEAR(tbl_pencarian.tgl_pencarian) = $year) as pencarian
    FROM tbl_buku
    RIGHT JOIN tbl_subkategori ON tbl_subkategori.id_subkategori  = tbl_buku.subkategori_id 
    JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku.id_kategori 
    GROUP BY tbl_subkategori.id_subkategori ORDER BY peminjam DESC, pencarian DESC, stok ASC LIMIT 3;");
  }

  public function get_book_spk_three_where_from_year($year)
  {
    return $this->db->query("SELECT tbl_subkategori.id_subkategori, tbl_kategori.nama_kategori, tbl_subkategori.nama_subkategori, sum(tbl_buku.jml) as stok, IFNULL(sum((SELECT sum(tbl_pinjam.jml) FROM tbl_pinjam WHERE tbl_pinjam.buku_id = tbl_buku.buku_id AND YEAR(tbl_pinjam.tgl_pinjam) >= $year)),0) as peminjam, (SELECT count(*) from tbl_pencarian WHERE tbl_pencarian.subkategori_id = tbl_buku.subkategori_id AND YEAR(tbl_pencarian.tgl_pencarian) >= $year) as pencarian
    FROM tbl_buku
    RIGHT JOIN tbl_subkategori ON tbl_subkategori.id_subkategori  = tbl_buku.subkategori_id 
    JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku.id_kategori 
    GROUP BY tbl_subkategori.id_subkategori ORDER BY peminjam DESC, pencarian DESC, stok ASC  LIMIT 3;");
  }

  // Example
  // Month = 5
  // Year = 2020
  public function get_book_spk_where($month, $year)
  {
    return $this->db->query("SELECT tbl_subkategori.id_subkategori, tbl_kategori.nama_kategori, tbl_subkategori.nama_subkategori, sum(tbl_buku.jml) as stok, IFNULL(sum((SELECT sum(tbl_pinjam.jml) FROM tbl_pinjam WHERE tbl_pinjam.buku_id = tbl_buku.buku_id AND MONTH(tbl_pinjam.tgl_pinjam) = $month AND YEAR(tbl_pinjam.tgl_pinjam) = $year)),0) as peminjam, (SELECT count(*) from tbl_pencarian WHERE tbl_pencarian.subkategori_id = tbl_buku.subkategori_id AND MONTH(tbl_pencarian.tgl_pencarian) = $month AND YEAR(tbl_pencarian.tgl_pencarian) = $year) as pencarian
    FROM tbl_buku
    JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku.id_kategori 
    JOIN tbl_subkategori ON tbl_subkategori.id_subkategori  = tbl_buku.subkategori_id GROUP BY tbl_subkategori.id_subkategori;");
  }

  public function get_book_spk_where_year($year)
  {
    return $this->db->query("SELECT tbl_subkategori.id_subkategori, tbl_kategori.nama_kategori, tbl_subkategori.nama_subkategori, sum(tbl_buku.jml) as stok, IFNULL(sum((SELECT sum(tbl_pinjam.jml) FROM tbl_pinjam WHERE tbl_pinjam.buku_id = tbl_buku.buku_id AND YEAR(tbl_pinjam.tgl_pinjam) = $year)),0) as peminjam, (SELECT count(*) from tbl_pencarian WHERE tbl_pencarian.subkategori_id = tbl_buku.subkategori_id AND YEAR(tbl_pencarian.tgl_pencarian) = $year) as pencarian
    FROM tbl_buku
    JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku.id_kategori 
    JOIN tbl_subkategori ON tbl_subkategori.id_subkategori  = tbl_buku.subkategori_id GROUP BY tbl_subkategori.id_subkategori;");
  }

  public function get_book_spk_where_from_year($year)
  {
    return $this->db->query("SELECT tbl_subkategori.id_subkategori, tbl_kategori.nama_kategori, tbl_subkategori.nama_subkategori, sum(tbl_buku.jml) as stok, IFNULL(sum((SELECT sum(tbl_pinjam.jml) FROM tbl_pinjam WHERE tbl_pinjam.buku_id = tbl_buku.buku_id AND YEAR(tbl_pinjam.tgl_pinjam) >= $year)),0) as peminjam, (SELECT count(*) from tbl_pencarian WHERE tbl_pencarian.subkategori_id = tbl_buku.subkategori_id AND YEAR(tbl_pencarian.tgl_pencarian) >= $year) as pencarian
    FROM tbl_buku
    JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku.id_kategori 
    JOIN tbl_subkategori ON tbl_subkategori.id_subkategori  = tbl_buku.subkategori_id GROUP BY tbl_subkategori.id_subkategori;");
  }

  public function get_book_spk_centeroid($list_id_subkategori)
  {
    return $this->db->query("SELECT tbl_subkategori.id_subkategori, tbl_kategori.nama_kategori, tbl_subkategori.nama_subkategori, sum(tbl_buku.jml) as stok, IFNULL(sum((SELECT sum(tbl_pinjam.jml) FROM tbl_pinjam WHERE tbl_pinjam.buku_id = tbl_buku.buku_id)),0) as peminjam, (SELECT count(*) from tbl_pencarian WHERE tbl_pencarian.subkategori_id = tbl_buku.subkategori_id) as pencarian
    FROM tbl_buku
    JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku.id_kategori 
    JOIN tbl_subkategori ON tbl_subkategori.id_subkategori  = tbl_buku.subkategori_id GROUP BY tbl_subkategori.id_subkategori HAVING tbl_subkategori IN ($list_id_subkategori);");
  }

  public function get_book_spk_centeroid_where_year($list_id_subkategori, $year)
  {
    return $this->db->query("SELECT tbl_subkategori.id_subkategori, tbl_kategori.nama_kategori, tbl_subkategori.nama_subkategori, sum(tbl_buku.jml) as stok, IFNULL(sum((SELECT sum(tbl_pinjam.jml) FROM tbl_pinjam WHERE tbl_pinjam.buku_id = tbl_buku.buku_id AND YEAR(tbl_pinjam.tgl_pinjam) = $year)),0) as peminjam, (SELECT count(*) from tbl_pencarian WHERE tbl_pencarian.subkategori_id = tbl_buku.subkategori_id AND YEAR(tbl_pencarian.tgl_pencarian) = $year) as pencarian
    FROM tbl_buku
    JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku.id_kategori 
    JOIN tbl_subkategori ON tbl_subkategori.id_subkategori  = tbl_buku.subkategori_id GROUP BY tbl_subkategori.id_subkategori HAVING tbl_subkategori IN ($list_id_subkategori);");
  }

  public function get_book_spk_centeroid_from_year($list_id_subkategori, $year)
  {
    return $this->db->query("SELECT tbl_subkategori.id_subkategori, tbl_kategori.nama_kategori, tbl_subkategori.nama_subkategori, sum(tbl_buku.jml) as stok, IFNULL(sum((SELECT sum(tbl_pinjam.jml) FROM tbl_pinjam WHERE tbl_pinjam.buku_id = tbl_buku.buku_id AND YEAR(tbl_pinjam.tgl_pinjam) >= $year)),0) as peminjam, (SELECT count(*) from tbl_pencarian WHERE tbl_pencarian.subkategori_id = tbl_buku.subkategori_id AND YEAR(tbl_pencarian.tgl_pencarian) >= $year) as pencarian
    FROM tbl_buku
    JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku.id_kategori 
    JOIN tbl_subkategori ON tbl_subkategori.id_subkategori  = tbl_buku.subkategori_id GROUP BY tbl_subkategori.id_subkategori HAVING tbl_subkategori IN ($list_id_subkategori);");
  }

  public function get_one_result_cluster($id_subkategori)
  {
    return $this->db->query("SELECT tbl_buku.*, tbl_buku.jml as stok, IFNULL((SELECT sum(tbl_pinjam.jml) FROM tbl_pinjam WHERE tbl_pinjam.buku_id = tbl_buku.buku_id),0) as peminjam, (SELECT count(*) from tbl_pencarian WHERE tbl_pencarian.subkategori_id = tbl_buku.subkategori_id) as pencarian
    FROM tbl_buku
    JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku.id_kategori 
    JOIN tbl_subkategori ON tbl_subkategori.id_subkategori  = tbl_buku.subkategori_id 
    WHERE tbl_subkategori.id_subkategori = $id_subkategori
    ORDER BY stok ASC LIMIT 1;");
  }
}
