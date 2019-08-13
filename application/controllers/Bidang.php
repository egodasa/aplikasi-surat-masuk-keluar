<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Bidang extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelBidang", "bidang");
  }
  //  Method untuk menampilkan data
	public function daftar()
	{
    $this->_dts['data_list'] = $this->bidang->data();  // Proses pengambilan data dari database
		$this->view('admin.bidang.daftar', $this->_dts); // Oper data dari database ke view
	}
  
  // Method untuk menampilkan form tambah data
  public function tambah()
  {
    $this->view('admin.bidang.tambah'); // Langsung tampilkan view tambah data
  }
  
  // Method untuk memproses penambahan data
  // Method diakses dalam metode POST
  public function prosesTambah()
  {
    $this->bidang->tambah($this->input->post(NULL, TRUE));
    header("Location: ".site_url("admin/bidang")); // Arahkan kembali user ke halaman daftar
  }
  
  // Method untuk menampilkan form edit
  public function edit()
  {
    $this->_dts['detail'] = $this->bidang->data($this->input->get('id')); // Ambil data yang akan diedit berdasarkan ID
    $this->view('admin.bidang.edit', $this->_dts); // Oper data ke view
  }
  
  // Method untuk memproses data yang akan diedit
  public function prosesEdit()
  {
    $this->bidang->edit($this->input->post("id"), $this->input->post(NULL, TRUE));
    header("Location: ".site_url("admin/bidang")); // Arahkan user kembali ke halaman daftar
  }
  
  // Method untuk menghapus data
  public function prosesHapus()
  {
    $this->bidang->hapus($this->input->get('id')); // Proses hapus data
    header("Location: ".site_url("admin/bidang")); // // Arahkan user kembali ke halaman daftar
  }
}
