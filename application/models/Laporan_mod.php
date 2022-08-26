<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_mod extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function getInbound($yr = "", $mt = "")
  {
    if (!empty($yr) && !empty($mt)) {
      $this->db->where("year(bpb_date)", $yr);
      $this->db->where("month(bpb_date)", $mt);
    }
    return $this->db
      ->select("inbound.id, bpb, supp_name, bpb_date, note, (select y.cat from inbound_item x left join item y on x.description=y.description where x.inbound_id=inbound.id limit 1 ) as cat")
      ->join("supplier", "supplier.id=inbound.supp_id")
      ->get("inbound");
  }

  public function getOutbound($yr = "", $mt = "")
  {
    if (!empty($yr) && !empty($mt)) {
      $this->db->where("year(stb_date)", $yr);
      $this->db->where("month(stb_date)", $mt);
    }
    return $this->db
      ->select("id, stb, stb_date, (select x.code from outbound_item x where x.outbound_id=outbound.id limit 1 ) as code")
      ->get("outbound");
  }
}
