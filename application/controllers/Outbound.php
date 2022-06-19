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
    $itm = $this->db->select("i.*, s.code")
      ->where("spb", $id)
      ->join("request r", "r.id=i.req_id", "left")
      ->join("item_stock s", "s.stock_id=i.stock_id", "left")
      ->get("request_item i")
      ->result_array();
    foreach ($itm as $key => $value) {
      $lot = $this->db->where("stock_id", $value['stock_id'])->order_by("lot_id", "asc")->get("item_lot")->result_array();
      $itm[$key]['lot'] = $lot;
    }

    echo json_encode($itm);
  }

  public function new_inp()
  {
    $this->db->trans_begin();

    $itm = [];
    $dat = $this->input->post();
    $inp = [
      'stb'       => $dat['stb'],
      'stb_date'  => $dat['stbdate'],
      'division'  => $dat['div'],
      'spb'       => $dat['spb'],
      'status_id' => 21,
      'status'    => "Menunggu Persetujuan"
    ];

    $out = $this->Outbound_mod->insert($inp);

    foreach ($dat['stock_id'] as $key => $value) {

      $gi = $this->Mst_mod->getStock($dat['stock_id'][$key])->row_array();

      $itm[$key]['outbound_id'] = $out;
      $itm[$key]['stock_id']    = $dat['stock_id'][$key];
      $itm[$key]['code']        = $gi['code'];
      $itm[$key]['name']        = $gi['nm'];
      $itm[$key]['description'] = $gi['dsc'];
      $itm[$key]['qty']         = $dat['qty'][$key];
      $itm[$key]['length']      = $dat['length'][$key];
      $itm[$key]['width']       = $dat['width'][$key];
      $itm[$key]['lot']         = implode(",", $dat['lot'][$dat['stock_id'][$key]]);
    }

    $this->Outbound_mod->insertItem($itm);

    if ($this->db->trans_status() !== FALSE) {
      $this->db->trans_commit();
      $msg = "Berhasi";
    } else {
      $this->db->trans_rollback();
      $msg = "Gagal";
    }
    echo "<script>alert('$msg menginput data'); location.href='" . site_url('outbound') . "';</script>";
  }


  public function view($id)
  {
    $de['out'] = $this->Outbound_mod->get($id)->row_array();
    $de['itm'] = $this->Outbound_mod->getItem("", $id)->result_array();
    foreach ($de['itm'] as $key => $value) {
      $lot = [];
      $l = explode(",", $value['lot']);
      foreach ($l as $k => $v) {
        $lot[] = $this->Mst_mod->getLot($v)->row()->lot;
      }

      $de['itm'][$key]['lot'] = implode(", ", $lot);
    }

    $this->template("outbound/outboundvw_vw", "Barang Keluar", $de);
  }

  public function process($id)
  {
    $de['out'] = $this->Outbound_mod->get($id)->row_array();
    $de['itm'] = $this->Outbound_mod->getItem("", $id)->result_array();
    foreach ($de['itm'] as $key => $value) {
      $lot = [];
      $l = explode(",", $value['lot']);
      foreach ($l as $k => $v) {
        $lot[] = $this->Mst_mod->getLot($v)->row()->lot;
      }

      $de['itm'][$key]['lot'] = implode(", ", $lot);
    }
    $this->template("outbound/outboundprc_vw", "Barang Keluar", $de);
  }


  public function prc_inp()
  {
    $this->db->trans_begin();

    $p = $this->session->userdata('position');
    $id = $this->input->post('id');

    if ($p == "Kabag Produksi") {
      $data['status_id'] = 22;
      $data['status'] = "Selesai";

      $itm = $this->Outbound_mod->getItem("", $id)->result_array();
      $arr = [];

      foreach ($itm as $key => $value) {

        $arr = explode(",", $value['lot']);
        $lq = $value['qty'];

        $this->db->order_by("lot_id", "asc");
        $this->db->where_in('lot_id', $arr);
        $lot = $this->Mst_mod->getLot()->result_array();

        foreach ($lot as $k => $v) {
          $lq -= $v['qty'];
          echo '<pre>';
          var_dump($lq);
          if ($lq >= 0) {
            $min = 0;
          } else {
            $min = abs($lq);
          }
          $upd = $this->db->where('lot_id', $v['lot_id'])->update("item_lot", ['qty' => $min]);
        }
      }
    }

    if (isset($data)) {
      $this->Outbound_mod->update($id, $data);
    }

    if ($this->db->trans_status() !== FALSE) {
      $this->db->trans_commit();
      $msg = "Berhasi";
    } else {
      $this->db->trans_rollback();
      $msg = "Gagal";
    }
    echo "<script>alert('$msg memproses data'); location.href='" . site_url('outbound') . "';</script>";
  }
}
