<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inbound_mod extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function insert($data)
  {
    $this->db->insert("inbound", $data);

    return $this->db->insert_id();
  }


  public function get($id = "")
  {
    $this->db->select("inbound.*, supp_name");
    if (!empty($id)) {
      $this->db->where("inbound.id", $id);
    }
    $this->db->join("supplier", "supplier.id=inbound.supp_id", "left");
    return $this->db->get("inbound");
  }


  public function update($id, $data)
  {
    $this->db->where("id", $id)->update("inbound", $data);
    return $this->db->affected_rows();
  }

  public function getNum()
  {
    $num = $this->get()->num_rows();
    $num++;
    $alp = range('A', 'Z');
    $mt = (int)date('m') - 1;
    $ur = str_repeat(0, 3 - strlen($num)) . $num;

    return "BPB-MOS-WH-" . $alp[$mt] . "-" . $ur;
  }

  public function insertItem($item)
  {
    $this->db->insert_batch("inbound_item", $item);
    return $this->db->affected_rows();
  }


  public function getItem($id = "", $inbound_id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    if (!empty($inbound_id)) {
      $this->db->where("inbound_id", $inbound_id);
    }
    return $this->db->get("inbound_item");
  }


  private  function avail($id, $length, $width)
  {
    return $this->db
      ->select("stock_id")
      ->where(['item_id' => $id, 'lg' => $length, 'wd' => $width])
      ->get("item_stock")->row_array();
  }


  private function loted($stock_id, $lot)
  {
    return $this->db
      ->select("lot_id, qty")
      ->where(['stock_id' => $stock_id, 'lot' => $lot])
      ->get("item_lot")
      ->row_array();
  }



  public function updateItem($id)
  {
    $itm = $this->getItem("", $id)->result_array();
    foreach ($itm as $key => $value) {
      $this->db->where(['description' => $value['description'], 'name' => $value['name'], 'length' => $value['length'], 'width' => $value['width']]);
      $i = $this->db->select("act")->get("item")->row_array();

      $this->db->where(['description' => $value['description'], 'name' => $value['name'], 'length' => $value['length'], 'width' => $value['width']]);
      $up = [
        'qty' => $i['act'] + $value['qty'],
        'act' => $i['act'] + $value['qty'],
      ];
      $this->db->update("item", $up);
    }
  }


  public function generateCode($id)
  {
    $itm = $this->getItem("", $id)->result_array();

    $supp = $this->db->select("code, supp_name")->where("inbound.id", $id)->join("supplier", "supp_id=supplier.id", "left")->get("inbound")->row_array();

    foreach ($itm as $key => $value) {
      $av =  $this->db
        ->select("id, code, lot, qty, act, cat")
        ->where(['width' => $value['width'], 'length' => $value['length'], 'description' => $value['description']])
        ->get("item")->row_array();

      $n = $this->db->where("code !=", NULL)->get("item")->num_rows();
      ++$n;
      $ur = str_repeat(0, 3 - strlen($n)) . $n;

      if (empty($av['code'])) {
        $upd['code'] = $value['category'] . "-" . $supp['code'] . "-" . $ur;
      }

      switch ($av['cat']) {
        case 'RML':
          $f = "A";
          break;
        case 'RMP':
          $f = "B";
          break;
        case 'DT':
          $f = "C";
          break;
      }

      $lid =  $f . date('Ymd');

      $upd['lot'] = empty($av['lot']) ? $lid : $av['lot'] . ", " . $lid;

      $upd['qty'] = $av['act'] + $value['qty'];
      $upd['act'] = $av['act'] + $value['qty'];

      $this->db->where('id', $av['id'])->update("item", $upd);

      $loted = $this->loted($av['id'], $lid);

      if (is_null($loted)) {

        $lot = [
          'stock_id'  => $av['id'],
          'lot'       => $lid,
          'qty'       => $value['qty'],
          'incoming'  => $value['incoming']
        ];
        $this->db->insert("item_lot", $lot);
      } else {
        $upd['qty'] = $loted['qty'] + $value['qty'];
        $this->db->where('lot_id', $loted['lot_id'])->update("item_lot", $upd);
      }
    }
  }

  public function insertLot($id)
  {
    $itm = $this->getItem("", $id)->result_array();

    $supp = $this->db->select("code, supp_name")->where("inbound.id", $id)->join("supplier", "supp_id=supplier.id", "left")->get("inbound")->row_array();

    foreach ($itm as $key => $value) {
      $av = $this->avail($value['item_id'], $value['length'], $value['width']);
      $n = $this->db->get("item_stock")->num_rows();
      ++$n;
      $ur = str_repeat(0, 3 - strlen($n)) . $n;

      if (is_null($av)) {
        $st = [
          'item_id' => $value['item_id'],
          'nm'      => $value['name'],
          'dsc'     => $value['description'],
          'lg'      => $value['length'],
          'wd'      => $value['width'],
          'cat'     => $value['category'],
          'supp'    => $supp['supp_name'],
          'code'    => $value['category'] . "-" . $supp['code'] . "-" . $ur
        ];

        $this->db->insert("item_stock", $st);
        $sid = $this->db->insert_id();
      } else {
        $sid = $av['stock_id'];
      }

      switch ($value['category']) {
        case 'RML':
          $f = "A";
          break;
        case 'RMP':
          $f = "B";
          break;
        case 'DT':
          $f = "C";
          break;
      }

      $lid =  $f . date('Ymd');

      $loted = $this->loted($sid, $lid);

      if (is_null($loted)) {

        $lot = [
          'stock_id'  => $sid,
          'lot'       => $lid,
          'qty'       => $value['qty'],
          'incoming'  => $value['incoming']
        ];
        $this->db->insert("item_lot", $lot);
      } else {
        $upd['qty'] = $loted['qty'] + $value['qty'];
        $this->db->where('lot_id', $loted['lot_id'])->update("item_lot", $upd);
      }
    }
  }
}
