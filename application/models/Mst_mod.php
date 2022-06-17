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

  public function getTodo()
  {
    $ro = $this->session->userdata('position');
    switch ($ro) {
      case 'PPIC':
        $st = "2";
        break;

      case 'Purchase':
        $st = "1";
        break;

      case 'Admin Gudang':
        $st = "11";
        break;

      default:
        $st = "66";
        break;
    }
    $this->db->where('status_id', $st);
    return $this->db->get('todo_v');
  }
}
