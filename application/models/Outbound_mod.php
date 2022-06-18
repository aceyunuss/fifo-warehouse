<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Outbound_mod extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function insert($data)
  {
    $this->db->insert("outbound", $data);

    return $this->db->affected_rows();
  }


  public function get($id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    return $this->db->get("outbound");
  }


  public function update($id, $data)
  {
    $this->db->where("id", $id)->update("outbound", $data);
    return $this->db->affected_rows();
  }

  
  public function getNum()
  {
    $num = $this->get()->num_rows();
    $num++;
    $alp = range('A', 'Z');
    $mt = (int)date('m') - 1;
    $ur = str_repeat(0, 3 - strlen($num)) . $num;

    return "STB-MOS-WH-" . $alp[$mt] . "-" . $ur;
  }

}
