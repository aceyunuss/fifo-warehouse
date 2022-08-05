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

    return $this->db->insert_id();
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
  
  public function insertItem($item)
  {
    $this->db->insert_batch("outbound_item", $item);
    return $this->db->affected_rows();
  }

  public function getItem($id = "", $outbound_id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    if (!empty($outbound_id)) {
      $this->db->where("outbound_id", $outbound_id);
    }
    return $this->db->get("outbound_item");
  }

  public function updateItem($id)
  {
    $itm = $this->getItem("", $id)->result_array();
    foreach ($itm as $key => $value) {
      $this->db->where(['description' => $value['description'], 'name' => $value['name'], 'length' => $value['length'], 'width' => $value['width']]);
      $i = $this->db->select("act")->get("item")->row_array();

      $this->db->where(['description' => $value['description'], 'name' => $value['name'], 'length' => $value['length'], 'width' => $value['width']]);
      $up = [
        'qty' => $i['act'] - $value['qty'],
        'act' => $i['act'] - $value['qty'],
      ];
      $this->db->update("item", $up);
    }
  }

}
