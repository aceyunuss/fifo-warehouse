<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends Core_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(['User_mod']);
    $this->load->library('email');
  }

  public function index()
  {
    if ($this->session->userdata('status') == 'granted') {
      $this->load->model(['User_mod', 'Item_mod', 'Inbound_mod', 'Outbound_mod']);

      $data['todo'] = $this->Mst_mod->getTodo()->result_array();
      $data['supp'] = $this->Mst_mod->getSupp()->num_rows();
      $data['item'] = $this->Item_mod->getStock()->num_rows();
      $data['inb'] = $this->Inbound_mod->get()->num_rows();
      $data['out'] = $this->Outbound_mod->get()->num_rows();

      $this->template('dashboard_vw', "Dashboard", $data);
    } else {
      $this->session->sess_destroy();
      $data['title'] = "Project Monitoring";
      $this->load->view("login");
    }
  }

  public function login()
  {

    if (empty($this->input->post('username')) || empty($this->input->post('password'))) {
      $this->session->set_userdata('err_login_form', 'Username dan password harus diisi.');
      redirect('auth');
    } else {
      $username = $this->input->post('username');
      $pass = md5($this->input->post('password'));

      $user = $this->User_mod->loginUser($username, $pass)->row_array();

      if (is_null($user) || empty($user)) {
        echo "<script>alert('Username atau password tidak sesuai'); location.href='" . site_url('auth') . "';</script>";
      } else {
        $us = [
          'user_id' => $user['id'],
          'name'    => $user['complete_name'],
          'status'  => 'granted',
          'position' => $user['position']
        ];
        $this->session->set_userdata($us);
        redirect('dashboard');
      }
    }
  }


  public function logout()
  {
    $this->session->sess_destroy();
    redirect('auth');
  }
}
