<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelSuratMasuk extends MY_Model {
  // Nama Tabel
  private $table = "suratmasuk";      // nama tabelnya
  private $primaryKey = "id"; // primary keynya
  
  
  //  Method untuk menampilkan data
  // kalau idnya tidak diatur alias kosong data() , maka ambil semua data
  // kalau idnya diatur data("P0001") maka data P0001 yang akan diambil
	public function data($id = null)
	{
    if($id != null)
    {
      return $this->db->get($this->table, "*", [$this->primaryKey => $id]);
    }
    else
    {
      return $this->db->query("SELECT a.*, b.bidang FROM suratmasuk a JOIN bidang b ON a.id_bidang = b.id")->fetchAll(PDO::FETCH_ASSOC);
    }
	}
  
  // method untuk menambah data
  public function tambah($data)
  {
    $data_tmp = [
      "nomorsm" => $data["nomorsm"],
      "id_bidang" => $data["id_bidang"],
      "tglsurat" => $data["tglsurat"],
      "tglditerima" => $data["tglditerima"],
      "judulsurat" => $data["judulsurat"],
      "asalsurat" => $data["asalsurat"],
      "email" => $data["email"],
      "perihalsurat" => $data["perihalsurat"],
      "alamatsurat" => $data["alamatsurat"],
      "kodepos" => $data["kodepos"],
      "website" => $data["website"],
      "ket" => $data["ket"]
    ];
    if(isset($data['filesurat']) || !empty($data['filesurat']))
    {
      $data_tmp["filesurat"] = $data["filesurat"];
    }
    $this->db->insert($this->table, $data_tmp);
    
    return true;
  }
  
  // method untuk edit data
  public function edit($id, $data)
  {
    $data_tmp = [
      "nomorsm" => $data["nomorsm"],
      "id_bidang" => $data["id_bidang"],
      "tglsurat" => $data["tglsurat"],
      "tglditerima" => $data["tglditerima"],
      "judulsurat" => $data["judulsurat"],
      "asalsurat" => $data["asalsurat"],
      "email" => $data["email"],
      "perihalsurat" => $data["perihalsurat"],
      "alamatsurat" => $data["alamatsurat"],
      "kodepos" => $data["kodepos"],
      "website" => $data["website"],
      "ket" => $data["ket"]
    ];
    if(isset($data['filesurat']) || !empty($data['filesurat']))
    {
      $data_tmp["filesurat"] = $data["filesurat"];
    }
    $this->db->update($this->table, $data_tmp,[
      $this->primaryKey => $id
    ]);
    return true;
  }
  
  // method untuk hapus data
  public function hapus($id)
  {
    $this->db->delete($this->table, [ $this->primaryKey => $id]);
    return true;
  }
  
  public function dataDisposisi()
	{
    return $this->db->query("SELECT a.*, b.bidang FROM suratmasuk a JOIN bidang b ON a.id_bidang = b.id WHERE a.status = 'Belum Di disposisi'")->fetchAll(PDO::FETCH_ASSOC);
	}
  
  public function prosesDisposisi($id, $data)
  {
    $this->db->update($this->table, [
      "ket" => $data['ket'],
      "status" => $data['status'],
      "isidisposisi" => $data['isidisposisi'],
      "tgldisposisi" => $data['tgldisposisi']
    ],[
      $this->primaryKey => $id
    ]);
    return true;
  }
  
  public function dataStatistikSuratMasuk()
  {
    return $this->db->query("
      SELECT 
      (SELECT COUNT(id) FROM suratmasuk WHERE status = 'Belum Di Disposisi') AS belum,
      (SELECT COUNT(id) FROM suratmasuk WHERE status = 'acc') AS acc,
      (SELECT COUNT(id) FROM suratmasuk WHERE status = 'ditolak') AS ditolak;
    ")->fetch(PDO::FETCH_ASSOC);
  }
 
}
