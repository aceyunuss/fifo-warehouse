<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends Core_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model([
      'Item_mod', 'Inbound_mod',
      'Outbound_mod',
      'Req_mod'
    ]);

    if ($this->session->userdata('status') != 'granted') {
      $this->session->sess_destroy();
      redirect('auth');
    }
  }


  public function index()
  {
    $pos = $this->session->userdata('position');

    switch ($pos) {
      case 'Admin Gudang':
        $m = ['in', 'out', 'itm'];
        break;
      case 'PPIC':
        $m = ['in'];
        break;
      case 'Purchase':
        $m = ['in'];
        break;
      case 'Kabag Produksi':
        $m = ['req', 'out'];
        break;
    }

    $data['menu'] = $m;

    $this->db->where("status", "Selesai");
    $data['in'] = $this->Inbound_mod->get()->result_array();

    $this->db->where("status", "Selesai");
    $data['out'] = $this->Outbound_mod->get()->result_array();

    $this->db->where("status", "Selesai");
    $data['req'] = $this->Req_mod->get()->result_array();

    $data['item'] = $this->Item_mod->getStock()->result_array();
    $this->template("report/reportlist_vw", "Laporan", $data);
  }


  public function update($id)
  {
    $data['itm'] = $this->Item_mod->getStock($id)->row_array();
    $data['lot'] = $this->Item_mod->getLot($id)->result_array();
    $this->template("item/update_vw", "Stok Barang", $data);
  }
}
