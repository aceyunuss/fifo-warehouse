<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Req_mod extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function insert($data)
  {
    $this->db->insert("request", $data);

    return $this->db->insert_id();
  }


  public function get($id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    return $this->db->get("request");
  }


  public function update($id, $data)
  {
    $this->db->where("id", $id)->update("request", $data);
    return $this->db->affected_rows();
  }


  public function getNum()
  {
    $num = $this->get()->num_rows();
    $num++;
    $alp = range('A', 'Z');
    $mt = (int)date('m') - 1;
    $ur = str_repeat(0, 3 - strlen($num)) . $num;

    return "SPB-MOS-PD-" . $alp[$mt] . "-" . $ur;
  }

  
  public function insertItem($item)
  {
    $this->db->insert_batch("request_item", $item);
    return $this->db->affected_rows();
  }
  
  
  public function getItem($id = "", $req_id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    if (!empty($req_id)) {
      $this->db->where("req_id", $req_id);
    }
    return $this->db->get("request_item");
  }

}
