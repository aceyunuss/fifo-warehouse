<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inbound extends Core_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model(['Inbound_mod']);
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
    $data['bpb'] = $this->Inbound_mod->getNum();
    $data['supp'] = $this->Mst_mod->getSupp()->result_array();
    $data['item'] = $this->Mst_mod->getItem()->result_array();
    $data['cat'] = $this->Mst_mod->getCat();
    $this->template("inbound/create_vw", "Bukti Penerimaan Barang", $data);
  }

  public function new_inp()
  {
    $this->db->trans_begin();

    $itm = [];
    $dat = $this->input->post();
    $inp = [
      'supp_id' => $dat['supp'],
      'do_date' => $dat['dodate'],
      'po'      => $dat['po'],
      'bpb'     => $dat['bpb'],
      'bpb_date' => $dat['bpbdate'],
      'note'    => $dat['note']
    ];

    $in = $this->Inbound_mod->insert($inp);

    foreach ($dat['item_id'] as $key => $value) {
      $gi = $this->Mst_mod->getItem($dat['item_id'][$key])->row_array();

      $itm[$key]['inbound_id']  = $in;
      $itm[$key]['item_id']     = $dat['item_id'][$key];
      $itm[$key]['name']        = $gi['name'];
      $itm[$key]['description'] = $gi['description'];
      $itm[$key]['category']    = $dat['cat'][$key];
      $itm[$key]['qty']         = $dat['qty'][$key];
      $itm[$key]['length']      = $dat['length'][$key];
      $itm[$key]['width']       = $dat['width'][$key];
    }

    $this->Inbound_mod->insertItem($itm);

    if ($this->db->trans_status() !== FALSE) {
      $this->db->trans_commit();
      $msg = "Berhasi";
    } else {
      $this->db->trans_rollback();
      $msg = "Gagal";
    }
    echo "<script>alert('$msg menginput data'); location.href='" . site_url('inbound') . "';</script>";
  }


  public function view($id)
  {
    $de['inb'] = $this->Inbound_mod->get($id)->row_array();
    $de['itm'] = $this->Inbound_mod->getItem("", $id)->result_array();
    $this->template("inbound/inboundvw_vw", "Bukti Penerimaan Barang", $de);
  }
}
