<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends Core_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(['User_mod']);

    if ($this->session->userdata('status') != 'granted') {
      $this->session->sess_destroy();
      redirect('auth');
    }
  }


  public function index()
  {
    $data['userlist'] = $this->User_mod->get()->result_array();
    $this->template("user/userlist_vw", "User Access", $data);
  }


  public function newuser()
  {
    $data['pos'] = ['Admin Gudang', 'PPIC', 'Purchase', 'Kabag Produksi'];
    $this->template("user/newuser_vw", "Tambah User Baru", $data);
  }


  public function new_inp()
  {
    $post = $this->input->post();

    $getuser = [
      'complete_name' => $post['name'],
      'position'      => $post['pos'],
      'birth'         => $post['birthplace'],
      'phone'         => $post['phone'],
      'username'      => $post['username'],
      'birthdate'     => $post['birthdate'],
      'password'      => md5($post['password']),
    ];

    $this->db->trans_begin();

    $this->User_mod->insert($getuser);

    if ($this->db->trans_status() !== FALSE) {
      $this->db->trans_commit();
      echo "<script>alert('Berhasil menambah user baru'); location.href='" . site_url('user') . "';</script>";
    } else {
      $this->db->trans_rollback();
      echo "<script>alert('Gagal menambah user baru'); location.href='" . site_url('user/newuser') . "';</script>";
    }
  }


  public function deleteuser($id)
  {

    $this->User_mod->delete($id);

    if ($this->db->trans_status() !== FALSE) {
      $this->db->trans_commit();
      $st = "Berhasil";
    } else {
      $this->db->trans_rollback();
      $st = "Gagal";
    }

    echo "<script>alert('$st menghapus user'); location.href='" . site_url('user') . "';</script>";
  }


  public function edituser($id)
  {
    $data['user'] = $this->User_mod->get($id)->row_array();
    $data['pos'] = ['Admin Gudang', 'PPIC', 'Purchase', 'Kabag Produksi'];
    $this->template("user/edituser_vw", "Ubah User", $data);
  }


  public function edit_inp()
  {
    $post = $this->input->post();

    $getuser = [
      'complete_name' => $post['name'],
      'position'      => $post['pos'],
      'birth'         => $post['birthplace'],
      'phone'         => $post['phone'],
      'username'      => $post['username'],
      'birthdate'     => $post['birthdate'],
    ];

    if (!empty($post['password'])) {
      $getuser['password'] = md5($post['password']);
    }

    $this->db->trans_begin();

    $this->User_mod->update($post['id'], $getuser);

    if ($this->db->trans_status() !== FALSE) {
      $this->db->trans_commit();
      echo "<script>alert('Berhasil mengubah data user'); location.href='" . site_url('user') . "';</script>";
    } else {
      $this->db->trans_rollback();
      echo "<script>alert('Gagal mengubah date user'); location.href='" . site_url('user/edituser/' . $post['id']) . "';</script>";
    }
  }


}
