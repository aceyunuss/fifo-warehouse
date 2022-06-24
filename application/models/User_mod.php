<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_mod extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function insert($data)
  {
    $this->db->insert("user", $data);

    return $this->db->affected_rows();
  }


  public function loginUser($username, $password)
  {
    $this->db->where(['username' => $username, 'password' => $password]);
    return $this->db->get("user");
  }

  public function get($id = "")
  {
    if (!empty($id)) {
      $this->db->where("id", $id);
    }
    return $this->db->get("user");
  }


  public function delete($id)
  {
    $this->db->where("id", $id)->delete("user");
    return $this->db->affected_rows();
  }

  public function update($id, $data)
  {
    $this->db->where("id", $id)->update("user", $data);
    return $this->db->affected_rows();
  }


  public function getRole($role)
  {
    $this->db->where('role', $role);
    return $this->get();
  }
}
