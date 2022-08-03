<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Spk extends Core_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model('Spk_mod');
    if ($this->session->userdata('status') != 'granted') {
      $this->session->sess_destroy();
      redirect('auth');
    }
  }


  public function index()
  {
    $this->db->where('status !=', "Selesai");
    $data['list'] = $this->Spk_mod->get()->result_array();

    $this->db->where('status', "Selesai");
    $data['hist'] = $this->Spk_mod->get()->result_array();
    $this->template("spk/spklist_vw", "Perintah Kerja", $data);
  }

  public function create()
  {
    $this->load->model("Req_mod");
    $data['spk'] = $this->Spk_mod->getNum();
    $data['cat'] = $this->Mst_mod->getCat();

    $this->template("spk/create_vw", "Surat Perintah Kerja", $data);
  }

  
  public function get_stock()
  {
    $cat = $this->input->post('cat');
    $this->db->where('cat', $cat);
    $stock = $this->Mst_mod->getStock()->result_array();
    echo json_encode($stock);
  }

  public function get_spk()
  {
    $id = $this->input->post('spk');
    $itm = $this->db->select("i.*, s.code")
      ->where("spk", $id)
      ->join("request r", "r.id=i.req_id", "left")
      ->join("item_stock s", "s.stock_id=i.stock_id", "left")
      ->get("request_item i")
      ->result_array();
    foreach ($itm as $key => $value) {
      $lot = $this->db->where(["stock_id" => $value['stock_id'], "qty >" => 0])->order_by("lot_id", "asc")->get("item_lot")->result_array();

      $lt = 0;
      foreach ($lot as $k => $v) {
        if ($lt < $value['qty']) {
          $itm[$key]['lot'][] = $v;
        }
        $lt += $v['qty'];
      }
    }

    echo json_encode($itm);
  }

  public function new_inp()
  {
    $this->db->trans_begin();

    $itm = [];
    $dat = $this->input->post();
    $inp = [
      'spk'       => $dat['spk'],
      'spk_date'  => $dat['spkdate'],
      'category'  => $dat['cat'],
      'status_id' => 61,
      'status'    => "Menunggu Persetujuan"
    ];

    $out = $this->Spk_mod->insert($inp);

    // foreach ($dat['stock_id'] as $key => $value) {

    //   $gi = $this->Mst_mod->getStock($dat['stock_id'][$key])->row_array();

    //   $itm[$key]['spk_id'] = $out;
    //   $itm[$key]['stock_id']    = $dat['stock_id'][$key];
    //   $itm[$key]['code']        = $gi['code'];
    //   $itm[$key]['name']        = $gi['nm'];
    //   $itm[$key]['description'] = $gi['dsc'];
    //   $itm[$key]['qty']         = $dat['qty'][$key];
    //   $itm[$key]['length']      = $dat['length'][$key];
    //   $itm[$key]['width']       = $dat['width'][$key];
    //   $itm[$key]['lot']         = substr($dat['lot'][$key], 0, -1);
    // }

    // $this->Spk_mod->insertItem($itm);

    if ($this->db->trans_status() !== FALSE) {
      $this->db->trans_commit();
      $msg = "Berhasi";
    } else {
      $this->db->trans_rollback();
      $msg = "Gagal";
    }
    echo "<script>alert('$msg menginput data'); location.href='" . site_url() . "';</script>";
  }


  public function view($id)
  {
    $de['spk'] = $this->Spk_mod->get($id)->row_array();
    $de['itm'] = [];//$this->Spk_mod->getItem("", $id)->result_array();
    // foreach ($de['itm'] as $key => $value) {
    //   $lot = [];
    //   $l = explode(",", $value['lot']);
    //   foreach ($l as $k => $v) {
    //     $lot[] = $this->Mst_mod->getLot($v)->row()->lot;
    //   }

    //   $de['itm'][$key]['lot'] = implode(", ", $lot);
    // }
    $te = ($this->session->userdata('position') == "Admin Gudang") ? " Surat Perintah Kerja"  : " Terima Barang";
    $this->template("spk/spkvw_vw", $te, $de);
  }

  public function process($id)
  {
    $de['out'] = $this->Spk_mod->get($id)->row_array();
    $de['itm'] = $this->Spk_mod->getItem("", $id)->result_array();
    foreach ($de['itm'] as $key => $value) {
      $lot = [];
      $l = explode(",", $value['lot']);
      foreach ($l as $k => $v) {
        $lot[] = $this->Mst_mod->getLot($v)->row()->lot;
      }

      $de['itm'][$key]['lot'] = implode(", ", $lot);
    }
    $this->template("spk/spkprc_vw", "Serah Terima Barang", $de);
  }


  public function prc_inp()
  {
    $this->db->trans_begin();

    $p = $this->session->userdata('position');
    $id = $this->input->post('id');

    if ($p == "Kabag Produksi") {
      $data['status_id'] = 22;
      $data['status'] = "Selesai";

      $itm = $this->Spk_mod->getItem("", $id)->result_array();
      $arr = [];

      foreach ($itm as $key => $value) {

        $arr = explode(",", $value['lot']);
        $lq = $value['qty'];

        $this->db->order_by("lot_id", "asc");
        $this->db->where_in('lot_id', $arr);
        $lot = $this->Mst_mod->getLot()->result_array();

        foreach ($lot as $k => $v) {
          $lq -= $v['qty'];
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
      $this->Spk_mod->update($id, $data);
    }

    if ($this->db->trans_status() !== FALSE) {
      $this->db->trans_commit();
      $msg = "Berhasi";
    } else {
      $this->db->trans_rollback();
      $msg = "Gagal";
    }
    echo "<script>alert('$msg memproses data'); location.href='" . site_url() . "';</script>";
  }
}
