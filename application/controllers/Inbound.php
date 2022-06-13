<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inbound extends Core_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model('Inbound_mod');
    if ($this->session->userdata('status') != 'granted') {
      $this->session->sess_destroy();
      redirect('auth');
    }
  }


  public function index()
  {
    $data['logs'] = $this->Inbound_mod->get()->result_array();
    $this->template("inbound/inboundlist_vw", "Barang Masuk", $data);
  }


  public function create()
  {
    $data['logs'] = $this->Inbound_mod->get()->result_array();
    $this->template("inbound/create_vw", "Barang Masuk", $data);
  }
}
