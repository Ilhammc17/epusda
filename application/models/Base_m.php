<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Base_m extends CI_Model
{

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   * 		http://example.com/index.php/welcome
   *	- or -
   * 		http://example.com/index.php/welcome/index
   *	- or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see https://codeigniter.com/user_guide/general/urls.html
   */
  public $table;
  var $column_order = array('' => ''); //set column field database for datatable orderable
  var $column_search = array('' => ''); //set column field database for datatable searchable 
  var $order = array('' => ''); // default order

  public function create($data)
  {
    return $this->db->insert($this->table, $data);
  }

  public function create_batch($data)
  {
    return $this->db->insert_batch($this->table, $data);
  }

  public function read()
  {
    return $this->db->get($this->table);
  }

  public function read_where($where)
  {
    return $this->db->get_where($this->table, $where);
  }

  public function read_where_paginate($where, $limit, $offset)
  {
    $this->db->from($this->table);
    $this->db->where($where);
    $this->db->limit($limit);
    $this->db->offset($offset);
    return $this->db->get();
  }

  public function update($data, $where)
  {
    return $this->db->update($this->table, $data, $where);
  }

  public function delete($where)
  {
    return $this->db->delete($this->table, $where);
  }

  public function _core_datatables_query()
  {
    $this->db->from($this->table);
  }

  public function get_table_name()
  {
    return $this->table;
  }

  private function _get_datatables_query()
  {

    $this->_core_datatables_query();

    $i = 0;

    foreach ($this->column_search as $item) // loop column 
    {
      if ($_POST['search']['value']) // if datatable send POST for search
      {

        if ($i === 0) // first loop
        {
          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($this->column_search) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $i++;
    }

    if (isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  function get_datatables()
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }
}
