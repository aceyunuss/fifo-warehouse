<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Po_mod extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function insert($data)
  {
    $this->db->insert("po", $data);

    return $this->db->insert_id();
  }


  public function get($id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    return $this->db->get("po");
  }


  public function update($id, $data)
  {
    $this->db->where("id", $id)->update("po", $data);
    return $this->db->affected_rows();
  }

  
  public function getNum()
  {
    $num = $this->get()->num_rows();
    $num++;
    $alp = range('A', 'Z');
    $mt = (int)date('m') - 1;
    $ur = str_repeat(0, 3 - strlen($num)) . $num;

    return "PO-MOS-" . $alp[$mt] . "-" . $ur;
  }
  
  public function insertItem($item)
  {
    $this->db->insert_batch("po_item", $item);
    return $this->db->affected_rows();
  }

  public function getItem($id = "", $po_id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    if (!empty($po_id)) {
      $this->db->where("po_id", $po_id);
    }
    return $this->db->get("po_item");
  }


  public function updateItem($id, $data)
  {
    $this->db->where("id", $id)->update("po_item", $data);
    return $this->db->affected_rows();
  }

  

}
