<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Po extends Core_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model('Po_mod');
    if ($this->session->userdata('status') != 'granted') {
      $this->session->sess_destroy();
      redirect('auth');
    }
  }


  public function index()
  {
    $this->db->where('status !=', "Selesai");
    $data['list'] = $this->Po_mod->get()->result_array();

    $this->db->where('status', "Selesai");
    $data['hist'] = $this->Po_mod->get()->result_array();
    $this->template("po/polist_vw", "Pesanan Pembelian", $data);
  }

  public function create()
  {
    $this->load->model("Pr_mod");
    $data['po'] = $this->Po_mod->getNum();
    $data['cat'] = $this->Mst_mod->getCat();

    $po = $this->Po_mod->get()->result_array();
    if (!empty($po)) {
      $sl = array_column($po, "pr");
      $this->db->where_not_in("pr", $sl);
    }
    $this->db->where('status', 'Selesai');
    $pr = $this->Pr_mod->get()->result_array();
    $data['pr'] = array_column($pr, "pr");
    
    $this->template("po/create_vw", "Pesanan Pembelian", $data);
  }


  public function new_inp()
  {
    $this->db->trans_begin();
    $this->load->model("Pr_mod");

    $itm = [];
    $dat = $this->input->post();
    $inp = [
      'po'       => $dat['po'],
      'po_date'  => $dat['podate'],
      'pr'       => $dat['pr'],
      'status_id' => 81,
      'status'    => "Menunggu Persetujuan"
    ];

    $po = $this->Po_mod->insert($inp);


    $this->db->where(['pr' => $dat['pr']]);
    $this->db->select("pr.pr, pr_item.*");
    $this->db->join("pr", "pr.id=pr_item.pr_id", "left");
    $pr_itm = $this->Pr_mod->getItem()->result_array();

    foreach ($pr_itm as $key => $value) {

      $itm[$key]['po_id'] = $po;
      $itm[$key]['pr']       = $value['pr'];
      $itm[$key]['supplier'] = $value['supplier'];
      $itm[$key]['description'] = $value['description'];
      $itm[$key]['item_name'] = $value['item_name'];
      $itm[$key]['width'] = $value['width'];
      $itm[$key]['length'] = $value['length'];
      $itm[$key]['qty'] = $value['qty'];
    }

    $this->Po_mod->insertItem($itm);

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
    $de['po'] = $this->Po_mod->get($id)->row_array();
    $de['itm'] = $this->Po_mod->getItem("", $id)->result_array();
    $this->template("po/povw_vw", "Penerimaan Barang", $de);
  }

  public function process($id)
  {
    $de['po'] = $this->Po_mod->get($id)->row_array();
    $de['itm'] = $this->Po_mod->getItem("", $id)->result_array();
    $this->template("po/poprc_vw", "Penerimaan Barang", $de);
  }


  public function prc_inp()
  {
    $this->db->trans_begin();


    $p = $this->session->userdata('position');
    $id = $this->input->post('id');
    $post = $this->input->post();


    if ($p == "Admin Gudang") {
      $data['status_id'] = 82;
      $data['status'] = "Selesai";
    }

    if (isset($data)) {
      $this->Po_mod->update($id, $data);
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


  public function get_pr()
  {
    $this->load->model("Pr_mod");
    $pr = $this->input->post('pr');
    $this->db->where(['pr' => $pr]);

    // $pr = $this->Pr_mod->get()->row_array();
    $this->db->select("pr.pr, pr_item.*");
    $this->db->join("pr", "pr.id=pr_item.pr_id", "left");
    $item = $this->Pr_mod->getItem()->result_array();
    echo json_encode($item);
  }
}
