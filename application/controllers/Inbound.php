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
    $this->db->where('status !=', "Selesai");
    $data['logs'] = $this->Inbound_mod->get()->result_array();


    $this->db->where("status", "Selesai");
    $data['in'] = $this->Inbound_mod->get()->result_array();
    $this->template("inbound/inboundlist_vw", "Barang Masuk", $data);
  }


  public function create()
  {
    $this->load->model("Po_mod");
    $data['bpb'] = $this->Inbound_mod->getNum();
    $data['supp'] = $this->Mst_mod->getSupp()->result_array();
    $data['item'] = $this->Mst_mod->getItem()->result_array();
    $data['cat'] = $this->Mst_mod->getCat();

    $spb = $this->Inbound_mod->get()->result_array();
    if (!empty($spb)) {
      $sl = array_column($spb, "po");
      $this->db->where_not_in("po", $sl);
    }
    $this->db->where('status', 'Selesai');
    $po = $this->Po_mod->get()->result_array();
    $data['po'] = array_column($po, "po");

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
      'do'      => $dat['do'],
      'bpb'     => $dat['bpb'],
      'bpb_date' => $dat['bpbdate'],
      'note'    => $dat['note'],
      'status_id' => 1,
      'status'  => "Menunggu Persetujuan"
    ];

    if (!empty($_FILES['pict']['name'])) {
      $this->session->set_userdata("dir_upload", "inbound");
      $upload = $this->upld("pict");
      $inp['pict'] = $upload;
    }

    $in = $this->Inbound_mod->insert($inp);
    $this->load->model('Po_mod');
    foreach ($dat['acc'] as $key => $value) {
      $gi = $this->Po_mod->getItem($key)->row_array();

      // $itm[$key]['item_id']     = $dat['item_id'][$key];
      $itm[$key]['inbound_id']  = $in;
      $itm[$key]['name']        = $gi['item_name'];
      $itm[$key]['description'] = $gi['description'];
      // $itm[$key]['category']    = $dat['cat'][$key];
      $itm[$key]['qty']         = $gi['qty'];
      $itm[$key]['width']       = $gi['width'];
      $itm[$key]['length']      = $gi['length'];
      $itm[$key]['incoming']    = date('Y-m-d H:i:s');
    }

    // foreach ($dat['item_id'] as $key => $value) {
    //   $gi = $this->Mst_mod->getItem($dat['item_id'][$key])->row_array();

    //   $itm[$key]['inbound_id']  = $in;
    //   $itm[$key]['item_id']     = $dat['item_id'][$key];
    //   $itm[$key]['name']        = $gi['name'];
    //   $itm[$key]['description'] = $gi['description'];
    //   $itm[$key]['category']    = $dat['cat'][$key];
    //   $itm[$key]['qty']         = $dat['qty'][$key];
    //   $itm[$key]['length']      = $dat['length'][$key];
    //   $itm[$key]['width']       = $dat['width'][$key];
    //   $itm[$key]['incoming']    = $dat['time'][$key];
    // }

    $this->Inbound_mod->insertItem($itm);

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
    $de['inb'] = $this->Inbound_mod->get($id)->row_array();
    $de['itm'] = $this->Inbound_mod->getItem("", $id)->result_array();
    $te = ($this->session->userdata('position') == "Admin Gudang") ? " Barang Masuk" : " Bukti Penerimaan Barang";
    $this->template("inbound/inboundvw_vw", $te, $de);
  }


  public function process($id)
  {
    $de['inb'] = $this->Inbound_mod->get($id)->row_array();
    $de['itm'] = $this->Inbound_mod->getItem("", $id)->result_array();
    $this->template("inbound/inboundprc_vw", "Bukti Penerimaan Barang", $de);
  }



  public function prc_inp()
  {
    $this->db->trans_begin();

    $p = $this->session->userdata('position');
    $id = $this->input->post('id');

    if ($p == "Purchase") {
      $data['status_id'] = 2;
    }
    if ($p == "PPIC") {
      $data['status_id'] = 3;
      $data['status'] = "Selesai";

      // $this->Inbound_mod->updateItem($id);
      $this->Inbound_mod->generateCode($id);
      // die;
      // $this->Inbound_mod->insertLot($id);
    }

    if (isset($data)) {
      $this->Inbound_mod->update($id, $data);
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


  public function get_item()
  {
    $cat = $this->input->post('cat');
    $this->db->where('cat', $cat);
    $re['item'] = $this->Mst_mod->getItem()->result_array();

    switch ($cat) {
      case 'RML':
        $l = [20, 25, 30];
        $p = [5000, 10000];
        break;
      case 'RMP':
        $l = [20, 25, 30];
        $p = [5000, 10000];
        break;
      case 'DT':
        $l = [20, 25, 30];
        $p = [5000, 10000];
        break;
    }

    $re['sz'] = ['le' => $p, 'wi' => $l];

    echo json_encode($re);
  }


  public function get_po()
  {
    $this->load->model("Po_mod");
    $po = $this->input->post('po');
    $this->db->where(['po' => $po, 'status_id' => 82]);

    $this->db->select("po.po, po_item.*");
    $this->db->join("po", "po.id=po_item.po_id", "left");
    $item = $this->Po_mod->getItem()->result_array();

    echo json_encode($item);
  }
}
