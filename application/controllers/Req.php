<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Req extends Core_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model(['Req_mod']);
    if ($this->session->userdata('status') != 'granted') {
      $this->session->sess_destroy();
      redirect('auth');
    }
  }


  public function index()
  {
    $this->db->where('status !=', "Selesai");
    $data['logs'] = $this->Req_mod->get()->result_array();

    $this->db->where("status", "Selesai");
    $data['req'] = $this->Req_mod->get()->result_array();

    $this->template("req/reqlist_vw", "Permintaan Barang", $data);
  }


  public function create()
  {
    $data['spb'] = $this->Req_mod->getNum();
    $data['cat'] = $this->Mst_mod->getCat();
    $this->template("req/create_vw", "Surat Permintaan Barang", $data);
  }

  public function get_stock()
  {
    $cat = $this->input->post('cat');
    $this->db->where('cat', $cat);
    $stock = $this->Mst_mod->getStock()->result_array();
    echo json_encode($stock);
  }


  public function new_inp()
  {
    $this->db->trans_begin();

    $itm = [];
    $dat = $this->input->post();
    $inp = [
      'spb'       => $dat['spb'],
      'spb_date'  => $dat['spbdate'],
      'div'       => $dat['div'],
      'spk'       => $dat['spk'],
      // 'category'  => $dat['cat'][0],
      'status_id' => 11,
      'status'    => "Menunggu Persetujuan"
    ];

    $in = $this->Req_mod->insert($inp);

    $this->load->model('Spk_mod');

    $this->db->where('spk', $dat['spk']);
    $gi = $this->Spk_mod->get()->row_array();

    $itm[0]['req_id']      = $in;
    // $itm[0]['stock_id']     = $dat['stock_id'][$key];
    $itm[0]['name']        = $gi['item_name'];
    $itm[0]['description'] = $gi['description'];
    $itm[0]['qty']         = $gi['qty'];
    $itm[0]['length']      = $gi['length'];
    $itm[0]['width']       = $gi['width'];

    // foreach ($dat['stock_id'] as $key => $value) {
    //   $gi = $this->Mst_mod->getStock($dat['stock_id'][$key])->row_array();

    //   $itm[$key]['req_id']      = $in;
    //   $itm[$key]['stock_id']     = $dat['stock_id'][$key];
    //   $itm[$key]['name']        = $gi['nm'];
    //   $itm[$key]['description'] = $gi['dsc'];
    //   $itm[$key]['category']    = $dat['cat'][$key];
    //   $itm[$key]['qty']         = $dat['qty'][$key];
    //   $itm[$key]['length']      = $dat['length'][$key];
    //   $itm[$key]['width']       = $dat['width'][$key];
    // }
// echo '<pre>';
// var_dump($itm);
// die();
    $this->Req_mod->insertItem($itm);

    if ($this->db->trans_status() !== FALSE) {
      $this->db->trans_commit();
      $msg = "Berhasil";
    } else {
      $this->db->trans_rollback();
      $msg = "Gagal";
    }
    echo "<script>alert('$msg menginput data'); location.href='" . site_url() . "';</script>";
  }


  public function view($id)
  {
    $de['req'] = $this->Req_mod->get($id)->row_array();
    $de['itm'] = $this->Req_mod->getItem("", $id)->result_array();
    $te = ($this->session->userdata('position') == "Kabag Produksi") ? "Permintaan Barang"  : "Surat Permintaan Barang";
    $this->template("req/reqvw_vw", $te, $de);
  }

  public function process($id)
  {
    $de['req'] = $this->Req_mod->get($id)->row_array();
    $de['itm'] = $this->Req_mod->getItem("", $id)->result_array();
    $this->template("req/reqprc_vw", "Surat Permintaan Barang", $de);
  }


  public function prc_inp()
  {
    $this->db->trans_begin();

    $p = $this->session->userdata('position');
    $id = $this->input->post('id');

    if ($p == "Admin Gudang") {
      $data['status_id'] = 12;
      $data['status'] = "Selesai";
    }
    if (isset($data)) {
      $this->Req_mod->update($id, $data);
    }

    if ($this->db->trans_status() !== FALSE) {
      $this->db->trans_commit();
      $msg = "Berhasil";
    } else {
      $this->db->trans_rollback();
      $msg = "Gagal";
    }
    echo "<script>alert('$msg memproses data'); location.href='" . site_url() . "';</script>";
  }


  public function get_spk()
  {
    $this->load->model("Spk_mod");
    $spk = $this->input->post('spk');
    $this->db->where(['spk' => $spk,  'status_id' => 62]);
    $spk = $this->Spk_mod->get()->result_array();
    echo json_encode($spk);
  }
}
