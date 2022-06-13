<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mst_mod extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }


  public function getSupp($id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    return $this->db->get("supplier");
  }

  public function getCust($id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    return $this->db->get("customer");
  }

  public function getItem($id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    return $this->db->get("item");
  }

  public function getCat()
  {
    return ['RML', 'RMP', 'DT'];
  }
  
}
