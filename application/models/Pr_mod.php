<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pr_mod extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function insert($data)
  {
    $this->db->insert("pr", $data);

    return $this->db->insert_id();
  }


  public function get($id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    return $this->db->get("pr");
  }


  public function update($id, $data)
  {
    $this->db->where("id", $id)->update("pr", $data);
    return $this->db->affected_rows();
  }

  
  public function getNum()
  {
    $num = $this->get()->num_rows();
    $num++;
    $alp = range('A', 'Z');
    $mt = (int)date('m') - 1;
    $ur = str_repeat(0, 3 - strlen($num)) . $num;

    return "PR-PPIC-MOS-" . $alp[$mt] . "-" . $ur;
  }
  
  public function insertItem($item)
  {
    $this->db->insert_batch("pr_item", $item);
    return $this->db->affected_rows();
  }

  public function getItem($id = "", $pr_id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    if (!empty($pr_id)) {
      $this->db->where("pr_id", $pr_id);
    }
    return $this->db->get("pr_item");
  }


}
