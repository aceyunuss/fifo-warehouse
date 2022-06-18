<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Outbound extends Core_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model('Outbound_mod');
    if ($this->session->userdata('status') != 'granted') {
      $this->session->sess_destroy();
      redirect('auth');
    }
  }


  public function index()
  {
    $this->db->where('status !=', "Selesai");
    $data['logs'] = $this->Outbound_mod->get()->result_array();
    $this->template("outbound/outboundlist_vw", "Barang Keluar", $data);
  }

  public function create()
  {
    $data['stb'] = $this->Outbound_mod->getNum();
    $this->template("outbound/create_vw", "Barang Keluar", $data);
  }


  public function get_spb()
  {
    $id = $this->input->post('spb');
    $itm = $this->db->select("i.*")
      ->where("spb", $id)
      ->join("request r", "r.id=i.req_id")
      ->get("request_item i")
      ->result_array();

    echo json_encode($itm);
  }
}
