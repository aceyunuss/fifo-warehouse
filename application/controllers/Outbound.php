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


    $this->db->where("status", "Selesai");
    $data['out'] = $this->Outbound_mod->get()->result_array();

    $this->template("outbound/outboundlist_vw", "Barang Keluar", $data);
  }

  public function create()
  {
    $this->load->model("Req_mod");
    $data['stb'] = $this->Outbound_mod->getNum();
    $stb = $this->Outbound_mod->get()->result_array();
    if (!empty($stb)) {
      $sl = array_column($stb, "spb");
      $this->db->where_not_in("spb", $sl);
    }
    $spb = $this->Req_mod->get()->result_array();
    $data['spb'] = array_column($spb, "spb");

    $this->template("outbound/create_vw", "Serah Terima Barang", $data);
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
      'stb'       => $dat['stb'],
      'stb_date'  => $dat['stbdate'],
      'division'  => $dat['div'],
      'spb'       => $dat['spb'],
      'status_id' => 21,
      'status'    => "Menunggu Persetujuan"
    ];

    $out = $this->Outbound_mod->insert($inp);

    $this->load->model('Req_mod');

    $this->db->where(['spb' => $dat['spb']]);
    $this->db->select("request.spb, request_item.*");
    $this->db->join("request", "request.id=request_item.req_id", "left");
    $gi = $this->Req_mod->getItem()->row_array();

    $itm[0]['outbound_id']      = $out;
    // $itm[0]['stock_id']     = $dat['stock_id'][$key];
    $itm[0]['name']        = $gi['name'];
    $itm[0]['description'] = $gi['description'];
    $itm[0]['qty']         = $gi['qty'];
    $itm[0]['length']      = $gi['length'];
    $itm[0]['width']       = $gi['width'];
    $itm[0]['lot']         = $dat['lot'][0];
    $itm[0]['code']        = $dat['item_code'][0];

    // foreach ($dat['stock_id'] as $key => $value) {

    //   $gi = $this->Mst_mod->getStock($dat['stock_id'][$key])->row_array();

    //   $itm[$key]['outbound_id'] = $out;
    //   $itm[$key]['stock_id']    = $dat['stock_id'][$key];
    //   $itm[$key]['code']        = $gi['code'];
    //   $itm[$key]['name']        = $gi['nm'];
    //   $itm[$key]['description'] = $gi['dsc'];
    //   $itm[$key]['qty']         = $dat['qty'][$key];
    //   $itm[$key]['length']      = $dat['length'][$key];
    //   $itm[$key]['width']       = $dat['width'][$key];
    //   $itm[$key]['lot']         = substr($dat['lot'][$key], 0, -1);
    // }

    $this->Outbound_mod->insertItem($itm);

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
    $de['out'] = $this->Outbound_mod->get($id)->row_array();
    $de['itm'] = $this->Outbound_mod->getItem("", $id)->result_array();
    // foreach ($de['itm'] as $key => $value) {
    //   $lot = [];
    //   $l = explode(",", $value['lot']);
    //   foreach ($l as $k => $v) {
    //     $lot[] = $this->Mst_mod->getLot($v)->row()->lot;
    //   }

    //   $de['itm'][$key]['lot'] = implode(", ", $lot);
    // }
    $te = ($this->session->userdata('position') == "Admin Gudang") ? " Barang Keluar"  : " Terima Barang";
    $this->template("outbound/outboundvw_vw", $te, $de);
  }

  public function process($id)
  {
    $de['out'] = $this->Outbound_mod->get($id)->row_array();
    $de['itm'] = $this->Outbound_mod->getItem("", $id)->result_array();
    // foreach ($de['itm'] as $key => $value) {
    //   $lot = [];
    //   $l = explode(",", $value['lot']);
    //   foreach ($l as $k => $v) {
    //     $lot[] = $this->Mst_mod->getLot($v)->row()->lot;
    //   }

    //   $de['itm'][$key]['lot'] = implode(", ", $lot);
    // }
    $this->template("outbound/outboundprc_vw", "Serah Terima Barang", $de);
  }


  public function prc_inp()
  {
    $this->db->trans_begin();

    $p = $this->session->userdata('position');
    $id = $this->input->post('id');

    if ($p == "Kabag Produksi") {
      $data['status_id'] = 22;
      $data['status'] = "Selesai";

      $itm = $this->Outbound_mod->updateItem($id);

      // $itm = $this->Outbound_mod->getItem("", $id)->result_array();
      // $arr = [];

      // foreach ($itm as $key => $value) {

      //   $arr = explode(",", $value['lot']);
      //   $lq = $value['qty'];

      //   $this->db->order_by("lot_id", "asc");
      //   $this->db->where_in('lot_id', $arr);
      //   $lot = $this->Mst_mod->getLot()->result_array();

      //   foreach ($lot as $k => $v) {
      //     $lq -= $v['qty'];
      //     if ($lq >= 0) {
      //       $min = 0;
      //     } else {
      //       $min = abs($lq);
      //     }
      //     $upd = $this->db->where('lot_id', $v['lot_id'])->update("item_lot", ['qty' => $min]);
      //   }
      // }
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
    echo "<script>alert('$msg memproses data'); location.href='" . site_url() . "';</script>";
  }


  public function get_spbb()
  {
    $this->load->model("Req_mod");
    $spb = $this->input->post('spb');
    $this->db->where(['spb' => $spb, 'status_id' => 12]);

    $this->db->select("request.spb, request_item.*");
    $this->db->join("request", "request.id=request_item.req_id", "left");
    $item = $this->Req_mod->getItem()->result_array();

    foreach ($item as $key => $value) {
      $lot = $this->db
        ->select("item.code, item_lot.*")
        ->where(['description' => $value['description'], 'length' => $value['length'], 'width' => $value['width']])
        ->join("item", "item.id=item_lot.stock_id")
        ->get("item_lot")
        ->result_array();
      $ln = [];
      $dt = [];
      $tq = 0;
      foreach ($lot as $k => $v) {

        if ($value['qty'] >= $tq) {
          $ln[] = $v['lot'];
          $dt[] = $v['incoming'];
        }

        $tq = $tq + $v['qty'];
      }

      $strlot = !empty($ln) ? (implode(",", $ln)) : "";
      $strdt = !empty($dt) ? (implode(",", $dt)) : "";

      $item[$key]['item_code'] = $lot[0]['code'];
      $item[$key]['lot'] = $strlot;
      $item[$key]['lot_date'] = $strdt;
    }
    echo json_encode($item);
  }
}
