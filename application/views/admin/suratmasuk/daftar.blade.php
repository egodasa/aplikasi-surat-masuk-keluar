@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Surat Masuk')
@section('sidebar_title', 'Surat Masuk')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', 'Surat Masuk')

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
          <th>Tgl Diterima</th>
          <th>Judul Surat</th>
          <th>Asal Surat</th>
          <th>Email</th>
          <th>Perihal Surat</th>
          <th>Alamat Surat</th>
          <th>Kode Pos</th>
          <th>Website</th>
          <th>File Surat</th>
          <th>Aksi</th>
        </tr>
        @foreach($data_list as $nomor => $data)
          <tr>
            <td>{{ ($nomor+1) }}</td>
            <td>{{ $data['nomorsm'] }}</td>
            <td>{{ $data['bidang'] }}</td>
            <td>{{ TanggalIndo($data['tglsurat']) }}</td>
            <td>{{ TanggalIndo($data['tglditerima']) }}</td>
            <td>{{ $data['judulsurat'] }}</td>
            <td>{{ $data['asalsurat'] }}</td>
            <td>{{ $data['email'] }}</td>
            <td>{{ $data['perihalsurat'] }}</td>
            <td>{{ $data['alamatsurat'] }}</td>
            <td>{{ $data['kodepos'] }}</td>
            <td>{{ $data['website'] }}</td>
            <td><a href="{{ base_url() }}assets/images/{{ $data['filesurat'] }}">Unduh File</td>
            <td>
              <button type="button" onclick="showModalEdit({{ $nomor }})" class="btn btn-success">Edit</button>
              <button type="button" onclick="showConfirmationDelete('<?=site_url("admin/suratmasuk/hapus?id=".$data['id'])?>')" class="btn btn-danger">Hapus</button>
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
      elName("nomorsm")[0].value = "";
      elName("id_bidang")[0].value = "";
      elName("tglsurat")[0].value = "";
      elName("tglditerima")[0].value = "";
      elName("judulsurat")[0].value = "";
      elName("asalsurat")[0].value = "";
      elName("email")[0].value = "";
      elName("perihalsurat")[0].value = "";
      elName("alamatsurat")[0].value = "";
      elName("kodepos")[0].value = "";
      elName("website")[0].value = "";
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
      elId("form_modal").action = "{{ site_url('admin/suratmasuk/tambah') }}";
      showModal("#modal");
    }
    
    function showModalEdit(id)
    {
      resetModal();
      elId("judul_modal").innerHTML = "Edit Data";
      var detail = data[id]; 
      elId("form_modal").action = "{{ site_url('admin/suratmasuk/edit') }}";
      elName("id")[0].value = detail.id;
      elName("nomorsm")[0].value = detail.nomorsm;
      elName("id_bidang")[0].value = detail.id_bidang;
      elName("tglsurat")[0].value = detail.tglsurat;
      elName("tglditerima")[0].value = detail.tglditerima;
      elName("judulsurat")[0].value = detail.judulsurat;
      elName("asalsurat")[0].value = detail.asalsurat;
      elName("email")[0].value = detail.email;
      elName("perihalsurat")[0].value = detail.perihalsurat;
      elName("alamatsurat")[0].value = detail.alamatsurat;
      elName("kodepos")[0].value = detail.kodepos;
      elName("website")[0].value = detail.website;
      
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
          <form id="form_modal" method="POST" action="{{ site_url('admin/suratmasuk/tambah') }}" enctype='multipart/form-data'>
            <input type="hidden" name="id">
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nomorsm', 'class' => 'form-control', 'max' => 50, 'label' => 'Nomor Surat Masuk']])	
            @include('components.form.select', ['_data' => ['name' => 'id_bidang', 'class' => 'form-control', 'label' => 'Bidang', 'val' => 'id', 'caption' => 'bidang', 'options' => $bidang]])	
            @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tglsurat', 'class' => 'form-control', 'max' => 50, 'label' => 'Tanggal Surat']])
            @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tglditerima', 'class' => 'form-control', 'max' => 50, 'label' => 'Tanggal Diterima']])
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'judulsurat', 'class' => 'form-control', 'max' => 100, 'label' => 'Judul Surat']])	
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'asalsurat', 'class' => 'form-control', 'max' => 100, 'label' => 'Asal Surat']])	
            @include('components.form.input', ['_data' => ['type' => 'email', 'name' => 'email', 'class' => 'form-control', 'max' => 100, 'label' => 'Email']])	
            @include('components.form.textarea', ['_data' => ['name' => 'perihalsurat', 'class' => 'form-control', 'label' => 'Perihal Surat']])	
            @include('components.form.textarea', ['_data' => ['name' => 'alamatsurat', 'class' => 'form-control', 'label' => 'Alamat Surat']])	
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'kodepos', 'class' => 'form-control', 'max' => 10, 'label' => 'Kode Pos']])	
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'website', 'class' => 'form-control', 'max' => 100, 'label' => 'Website']])	
            
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
