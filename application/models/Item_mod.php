<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Item_mod extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }


  public function getStock($id = "")
  {
    $this->db->select("item_stock.*, (select sum(qty) from item_lot where item_lot.stock_id=item_stock.stock_id) as qty");
    if (!empty($id)) {
      $this->db->where("stock_id", $id);
    }
    return $this->db->get("item_stock");
  }


  public function getLot($id = "")
  {
    if (!empty($id)) {
      $this->db->where("stock_id", $id);
    }
    return $this->db->get("item_lot");
  }


  public function getSTockLot($id = "")
  {
    if (!empty($id)) {
      $this->db->where("stock_id", $id);
    }
    $this->db->join("item_stock", "item_stock.stock_id=item_lot.stock_id", "left");
    // $this->db->join("supplier", "supplier.id=item_stock.supplier_id", "left");
    return $this->db->get("item_lot");
  }


  public function updateItem($id, $data)
  {
    return $this->db->where("id", $id)->update("item", $data);
  }


  public function getItem($id = "")
  {
    $this->db->select("item.*, supp_name");
    if (!empty($id)) {
      $this->db->where("item.id", $id);
    }
    $this->db->join("supplier", "supplier.id=item.supplier_id", "left");
    return $this->db->get("item");
  }


  public function updateLot($id, $data)
  {
    $this->db->where('lot_id', $id)->update("item_lot", $data);
    return $this->db->affected_rows();
  }
}
