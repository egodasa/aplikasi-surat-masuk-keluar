@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Surat Keluar')
@section('sidebar_title', 'Surat Keluar')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', 'Surat Keluar')

@section('content')
  <button type="button" onclick="showModalTambah()" class="btn btn-primary">Tambah Data</button>
  <div class="table-responsive">
    <div style="overflow:auto; max-height:650px; margin:0px 0 0px 0;">
      <table class="table table-bordered table-stripped">
        <tr>
          <th>No</th>
          <th>No Surat</th>
          <th>Bidang</th>
          <th>Tgl Surat</th>
          <th>Judul Surat</th>
          <th>Tujuan</th>
          <th>Perihal Surat</th>
          <th>Alamat Surat</th>
          <th>Catatan</th>
          <th>File Surat</th>
          <th>Aksi</th>
        </tr>
        @foreach($data_list as $nomor => $data)
          <tr>
            <td>{{ ($nomor+1) }}</td>
            <td>{{ $data['nomorsk'] }}</td>
            <td>{{ $data['bidang'] }}</td>
            <td>{{ TanggalIndo($data['tglsurat']) }}</td>
            <td>{{ $data['judulsurat'] }}</td>
            <td>{{ $data['tujuan'] }}</td>
            <td>{{ $data['perihal'] }}</td>
            <td>{{ $data['alamat'] }}</td>
            <td>{{ $data['catatan'] }}</td>
            <td><a href="{{ base_url() }}assets/images/{{ $data['filesurat'] }}">Unduh File</td>
            <td>
              <button type="button" onclick="showModalEdit({{ $nomor }})" class="btn btn-success">Edit</button>
              <button type="button" onclick="showConfirmationDelete('<?=site_url("kabid/suratkeluar/hapus?id=".$data['id'])?>')" class="btn btn-danger">Hapus</button>
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
  
  <script>
    var data = <?=json_encode($data_list)?>;
    
    function resetModal()
    {
      elId("form_modal").action = "";
      elName("id")[0].value = "";
      elName("nomorsk")[0].value = "";
      elName("id_bidang")[0].value = "";
      elName("tglsurat")[0].value = "";
      elName("judulsurat")[0].value = "";
      elName("tujuan")[0].value = "";
      elName("perihal")[0].value = "";
      elName("alamat")[0].value = "";
      elName("catatan")[0].value = "";
      elId("filesurat").innerHTML = "";
    }
    
    function closeModal()
    {
      resetModal();
      hideModal("#modal");
    }
    
    function showModalTambah()
    {
      resetModal();
      elId("judul_modal").innerHTML = "Tambah Data Baru";
      elId("form_modal").action = "{{ site_url('kabid/suratkeluar/tambah') }}";
      showModal("#modal");
    }
    
    function showModalEdit(id)
    {
      resetModal();
      elId("judul_modal").innerHTML = "Edit Data";
      var detail = data[id]; 
      elId("form_modal").action = "{{ site_url('kabid/suratkeluar/edit') }}";
      elName("id")[0].value = detail.id;
      elName("nomorsk")[0].value = detail.nomorsk;
      elName("id_bidang")[0].value = detail.id_bidang;
      elName("tglsurat")[0].value = detail.tglsurat;
      elName("judulsurat")[0].value = detail.judulsurat;
      elName("tujuan")[0].value = detail.tujuan;
      elName("perihal")[0].value = detail.perihal;
      elName("alamat")[0].value = detail.alamat;
      elName("catatan")[0].value = detail.catatan;
      
      if(detail.filesurat != "")
      {
        elId("filesurat").innerHTML = "<small>*Upload file baru untuk mengganti file lama.</small> <br> <img src='{{ base_url().'assets/images/' }}" + detail.filesurat + "' width='300' height='300' />"
      }
      
      showModal("#modal");
    }
  </script>
  
  <div class="modal fade hide-modal" id="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="judul_modal">Judul Modal</h4>
        </div>
        <div class="modal-body">
          <form id="form_modal" method="POST" action="{{ site_url('kabid/suratkeluar/tambah') }}" enctype='multipart/form-data'>
            <input type="hidden" name="id">
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nomorsk', 'class' => 'form-control', 'max' => 50, 'label' => 'Nomor Surat Keluar']])	
            @include('components.form.select', ['_data' => ['name' => 'id_bidang', 'class' => 'form-control', 'label' => 'Bidang', 'val' => 'id', 'caption' => 'bidang', 'options' => $bidang]])	
            @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tglsurat', 'class' => 'form-control', 'max' => 50, 'label' => 'Tanggal Surat']])
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'judulsurat', 'class' => 'form-control', 'max' => 100, 'label' => 'Judul Surat']])	
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'tujuan', 'class' => 'form-control', 'max' => 100, 'label' => 'Tujuan']])
            @include('components.form.textarea', ['_data' => ['name' => 'perihal', 'class' => 'form-control', 'label' => 'Perihal Surat']])	
            @include('components.form.textarea', ['_data' => ['name' => 'alamat', 'class' => 'form-control', 'label' => 'Alamat Surat']])	
            @include('components.form.textarea', ['_data' => ['name' => 'catatan', 'class' => 'form-control', 'label' => 'Catatan']])
            
            <div class="form-group">
              <label>File Surat</label>
              <br>
              <p id="filesurat"></p>
              <input type="file" name="filesurat" class="form-control" />
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="closeModal()">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection
