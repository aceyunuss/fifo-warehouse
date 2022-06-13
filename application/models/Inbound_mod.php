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

    return $this->db->affected_rows();
  }


  public function get($id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    return $this->db->get("inbound");
  }


  public function update($id, $data)
  {
    $this->db->where("id", $id)->update("inbound", $data);
    return $this->db->affected_rows();
  }
}
