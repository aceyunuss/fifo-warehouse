<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inbound_mod extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function insert($data)
  {
    $this->db->insert("inbound", $data);

    return $this->db->insert_id();
  }


  public function get($id = "")
  {
    $this->db->select("inbound.*, supp_name");
    if (!empty($id)) {
      $this->db->where("inbound.id", $id);
    }
    $this->db->join("supplier", "supplier.id=inbound.supp_id", "left");
    return $this->db->get("inbound");
  }


  public function update($id, $data)
  {
    $this->db->where("id", $id)->update("inbound", $data);
    return $this->db->affected_rows();
  }

  public function getNum()
  {
    $num = $this->get()->num_rows();
    $num++;
    $alp = range('A', 'Z');
    $mt = (int)date('m') - 1;
    $ur = str_repeat(0, 3 - strlen($num)) . $num;

    return "BPB-MOS-WH-" . $alp[$mt] . "-" . $ur;
  }

  public function insertItem($item)
  {
    $this->db->insert_batch("inbound_item", $item);
    return $this->db->affected_rows();
  }


  public function getItem($id = "", $inbound_id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    if (!empty($inbound_id)) {
      $this->db->where("inbound_id", $inbound_id);
    }
    return $this->db->get("inbound_item");
  }
}
