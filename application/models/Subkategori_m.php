
<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Subkategori_m extends Base_m
{
  public $table = "tbl_subkategori";

  public function get_three()
  {
    return $this->db->query("select GROUP_CONCAT(tbl_subkategori.id_subkategori SEPARATOR ', ') as id_subkategori FROM (select * FROM tbl_subkategori limit 3) as tbl_subkategori; ");
  }
}
