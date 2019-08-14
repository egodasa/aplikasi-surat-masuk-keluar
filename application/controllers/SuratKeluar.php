<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratKeluar extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelSuratKeluar", "suratkeluar");
    $this->load->model("ModelBidang", "bidang");
  }
  //  Method untuk menampilkan data
	public function daftar()
	{
    $this->_dts['bidang'] = $this->bidang->data();  // Proses pengambilan data dari database
    $this->_dts['data_list'] = $this->suratkeluar->data();  // Proses pengambilan data dari database
		$this->view('kabid.suratkeluar.daftar', $this->_dts); // Oper data dari database ke view
	}
	
	public function lihatSuratKeluar()
	{
		$this->_dts['data_list'] = $this->suratkeluar->data();  // Proses pengambilan data dari database
		$this->view('kepaladinas.suratkeluar.daftar', $this->_dts); // Oper data dari database ke view
	}
  
	public function daftarDisposisi()
	{
    $this->_dts['data_list'] = $this->suratkeluar->dataDisposisi();  // Proses pengambilan data dari database
		$this->view('kepaladinas.disposisi.daftar', $this->_dts); // Oper data dari database ke view
	}
  
  // Method untuk menampilkan form tambah data
  public function tambah()
  {
    $this->view('kabid.suratkeluar.tambah'); // Langsung tampilkan view tambah data
  }
  
  // Method untuk memproses penambahan data
  // Method diakses dalam metode POST
  public function prosesTambah()
  {
    $data = $this->input->post(NULL, TRUE);
    if(file_exists($_FILES['filesurat']['tmp_name']) || is_uploaded_file($_FILES['filesurat']['tmp_name']))
    {
      $data['filesurat'] = fileUpload($_FILES["filesurat"], "./assets/images/");
    }
    else
    {
      $data['filesurat'] = null;
    }
    $this->suratkeluar->tambah($data);
    header("Location: ".site_url("kabid/suratkeluar")); // Arahkan kembali user ke halaman daftar
  }
  
  // Method untuk menampilkan form edit
  public function edit()
  {
    $this->_dts['detail'] = $this->suratkeluar->data($this->input->get('id')); // Ambil data yang akan diedit berdasarkan ID
    $this->view('kabid.suratkeluar.edit', $this->_dts); // Oper data ke view
  }
  
  // Method untuk memproses data yang akan diedit
  public function prosesEdit()
  {
    $data = $this->input->post(NULL, TRUE);
    if(file_exists($_FILES['filesurat']['tmp_name']) || is_uploaded_file($_FILES['filesurat']['tmp_name']))
    {
      $data['filesurat'] = fileUpload($_FILES["filesurat"], "./assets/images/");
    }
    else
    {
      $data['filesurat'] = null;
    }
    $this->suratkeluar->edit($this->input->post("id"), $data);
    header("Location: ".site_url("kabid/suratkeluar")); // Arahkan user kembali ke halaman daftar
  }
  
}
