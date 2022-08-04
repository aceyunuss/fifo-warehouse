<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Item extends Core_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(['Item_mod']);

    if ($this->session->userdata('status') != 'granted') {
      $this->session->sess_destroy();
      redirect('auth');
    }
  }


  public function index()
  {
    $data['item'] = $this->Item_mod->getItem()->result_array();
    $this->template("item/itemlist_vw", "Stok Barang", $data);
  }


  public function update($id)
  {
    $data['itm'] = $this->Item_mod->getStock($id)->row_array();
    $data['lot'] = $this->Item_mod->getLot($id)->result_array();
    $this->template("item/update_vw", "Stok Barang", $data);
  }

  public function upd_inp()
  {
    $it = $this->input->post('qty');

    $this->db->trans_begin();

    foreach ($it as $key => $value) {
      $this->Item_mod->updateLot($key, ['qty' => $value]);
    }

    if ($this->db->trans_status() !== FALSE) {
      $this->db->trans_commit();
      $msg = "Berhasi";
    } else {
      $this->db->trans_rollback();
      $msg = "Gagal";
    }
    echo "<script>alert('$msg mengupdate stok'); location.href='" . site_url('item') . "';</script>";
  }


  public function get_item()
  {
    $cat = $this->input->post('cat');
    $this->db->where('cat', $cat);
    $item = $this->Item_mod->getItem()->result_array();
    echo json_encode($item);
  }
}
