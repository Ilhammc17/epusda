<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PetugasModel extends CI_Model {

  public $id_login;
  public $nama;
  public $user;
  public $pass;
  public $telepon;
  public $email;
  
  public function save()
  {
    $this->db->insert('tbl_login', $this);
  }

  public function find($id_petugas)
  {
    return $this->db->get_where('tbl_login', ['id_login' => $id_petugas])->row_array();
  }

  public function update()
  {
    $this->db->update('tbl_login', $this, ['id_login' => $this->id_login]);
  }

  public function destroy()
  {
    $this->db->delete('tbl_login', ['id_login' => $this->id_login]);
  }
}
