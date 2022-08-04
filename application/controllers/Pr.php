<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pr extends Core_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model('Pr_mod');
    if ($this->session->userdata('status') != 'granted') {
      $this->session->sess_destroy();
      redirect('auth');
    }
  }


  public function index()
  {
    $this->db->where('status !=', "Selesai");
    $data['list'] = $this->Pr_mod->get()->result_array();

    $this->db->where('status', "Selesai");
    $data['hist'] = $this->Pr_mod->get()->result_array();
    $this->template("pr/prlist_vw", "Permintaan Pembelian", $data);
  }

  public function create()
  {
    $this->load->model("Req_mod");
    $data['pr'] = $this->Pr_mod->getNum();
    $data['cat'] = $this->Mst_mod->getCat();

    $this->template("pr/create_vw", "Permintaan Pembelian", $data);
  }


  public function get_pr()
  {
    $id = $this->input->post('pr');
    $itm = $this->db->select("i.*, s.code")
      ->where("pr", $id)
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
    $this->load->model("Spk_mod");
    $itm = [];
    $dat = $this->input->post();

    $inp = [
      'pr'        => $dat['pr'],
      'pr_date'   => $dat['prdate'],
      'spk_date'  => $dat['spkdate'],
      'category'  => $dat['cat'],
      'status_id' => 71,
      'status'    => "Menunggu Persetujuan"
    ];

    $pr = $this->Pr_mod->insert($inp);

    foreach ($dat['used'] as $key => $value) {

      $gi = $this->Spk_mod->get($key)->row_array();

      $itm[$key]['pr_id']       = $pr;
      $itm[$key]['spk']       = $gi['spk'];
      $itm[$key]['supplier'] = $gi['supplier'];
      $itm[$key]['description'] = $gi['description'];
      $itm[$key]['item_name'] = $gi['item_name'];
      $itm[$key]['width'] = $gi['width'];
      $itm[$key]['length'] = $gi['length'];
      $itm[$key]['qty'] = $gi['qty'];
    }

    $this->Pr_mod->insertItem($itm);

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
    $de['pr'] = $this->Pr_mod->get($id)->row_array();
    $de['itm'] = $this->Pr_mod->getItem("", $id)->result_array();

    $this->template("pr/prvw_vw", "Permintaan Pembelian", $de);
  }

  public function process($id)
  {
    $de['pr'] = $this->Pr_mod->get($id)->row_array();
    $de['itm'] = $this->Pr_mod->getItem("", $id)->result_array();

    $this->template("pr/prprc_vw", "Permintaan Pembelian", $de);
  }


  public function prc_inp()
  {
    $this->db->trans_begin();

    $p = $this->session->userdata('position');
    $id = $this->input->post('id');

    if ($p == "Purchase") {
      $data['status_id'] = 72;
      $data['status'] = "Selesai";
    }

    if (isset($data)) {
      $this->Pr_mod->update($id, $data);
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


  public function get_spk()
  {
    $this->load->model("Spk_mod");
    $cat = $this->input->post('cat');
    $date = $this->input->post('spkdate');
    $this->db->where(['category' => $cat, 'spk_date' => $date, 'status_id' => 62]);
    $spk = $this->Spk_mod->get()->result_array();
    echo json_encode($spk);
  }
}
