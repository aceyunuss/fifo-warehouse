<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Spk extends Core_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model(['Spk_mod', 'Item_mod']);
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
    $data['item'] = $this->Item_mod->getItem()->result_array();

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

    foreach ($dat['used'] as $key => $value) {
      if (!empty($value)) {
        $itm = $this->Item_mod->getItem($key)->row_array();
        $inp['item_name'] = $itm['name'];
        $inp['description'] = $itm['description'];
        $inp['width'] = $itm['width'];
        $inp['length'] = $itm['length'];
        $inp['qty'] = $dat['needed'][$key];
        $inp['item_code'] = $itm['code'];
        $inp['supplier'] = $itm['supp_name'];
      }
    }

    $spk = $this->Spk_mod->insert($inp);

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
    $this->template("spk/spkvw_vw", "Surat Perintah Kerja", $de);
  }

  public function process($id)
  {
    $de['spk'] = $this->Spk_mod->get($id)->row_array();
    $this->template("spk/spkprc_vw", "Surat Perintah Kerja", $de);
  }


  public function prc_inp()
  {
    $this->db->trans_begin();

    $p = $this->session->userdata('position');
    $id = $this->input->post('id');

    if ($p == "Kabag Produksi") {
      $data['status_id'] = 62;
      $data['status'] = "Selesai";
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
