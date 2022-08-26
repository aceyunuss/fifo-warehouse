<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends Core_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model('Laporan_mod');
    if ($this->session->userdata('status') != 'granted') {
      $this->session->sess_destroy();
      redirect('auth');
    }
  }


  public function index()
  {
    $data['logs'] = $this->Laporan_mod->getInbound()->result_array();
    $data['type'] = "in";
    $this->template("laporan/all_vw", "Laporan", $data);
  }

  public function alias($type, $date)
  {

    $ex = explode("-", $date);

    if ($type == "in") {
      $data['logs'] = $this->Laporan_mod->getInbound($ex[0], $ex[1])->result_array();
    } else {
      $data['logs'] = $this->Laporan_mod->getOutbound($ex[0], $ex[1])->result_array();
    }
    $data['type'] = $type;
    $this->template("laporan/all_vw", "Laporan", $data);
  }
}
