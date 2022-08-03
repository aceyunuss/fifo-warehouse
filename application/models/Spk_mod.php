<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Spk_mod extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function insert($data)
  {
    $this->db->insert("spk", $data);

    return $this->db->insert_id();
  }


  public function get($id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    return $this->db->get("spk");
  }


  public function update($id, $data)
  {
    $this->db->where("id", $id)->update("spk", $data);
    return $this->db->affected_rows();
  }

  
  public function getNum()
  {
    $num = $this->get()->num_rows();
    $num++;
    $alp = range('A', 'Z');
    $mt = (int)date('m') - 1;
    $ur = str_repeat(0, 3 - strlen($num)) . $num;

    return "SPK-PD-" . $alp[$mt] . "-" . $ur;
  }
  
  public function insertItem($item)
  {
    $this->db->insert_batch("spk_item", $item);
    return $this->db->affected_rows();
  }

  public function getItem($id = "", $spk_id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    if (!empty($spk_id)) {
      $this->db->where("spk_id", $spk_id);
    }
    return $this->db->get("spk_item");
  }


}
