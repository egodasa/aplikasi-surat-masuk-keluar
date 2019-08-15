<!DOCTYPE html>
<html>
<head>
	<title>Laporan Surat Masuk</title>
      <style>
            .tabel_laporan {
                  border: 1px solid black;
                  margin: 0 auto;
                  border-collapse: collapse;
                  font-size: 12px;
            }
            .tabel_laporan th, .tabel_laporan td {
                  border: 1px solid black;
                  border-collapse: collapse;
                  padding: 5px 10px;
            } 
            .tabel_laporan th {
                  background-color: #E0E0E0;
            }
      </style>
</head>
</br>
</br>
<table align="center">
      <tr>
        <td><img src="{{ base_url() }}assets/images/logo-padang.png" width="65"  height="75"></td>
        <td align="center"><span style="font-size:12px">PEMERINTAH KOTA PADANG</span></br>
        <span style="font-size:22px; font-weight: bold">DINAS KEBUDAYAAN PROVINSI SUMATERA BARAT</span></br>
        <span style="font-size:10px">Jl. Samudera, Belakang Tangsi, Kec. Padang Barat, Kota Padang, Sumatera Barat</span></br>
        <span style="font-size:10px">Email:disbudsumbar@gmail.com</span></br>
        <td><img src="{{ base_url() }}assets/images/logo-disbud.png" width="65"  height="75"></td>
      </tr>  
      <tr>
            <td style="border-bottom: 3px solid black;" colspan="3"></td>
      </tr>  
</table>

</br>
</br>
<body>
      <h2 align="center"><b><?=$judul?></b></h2>
      <table class="tabel_laporan">
      	<tr>
      		<th>No</th>
      		<th>Nomor Surat Masuk</th>
      		<th>Bidang Tujuan</th>
      		<th>Tanggal Surat Masuk</th>
      		<th>Asal Surat</th>
      		<th>Judul Surat</th>
      	</tr>
       @foreach($data_list as $nomor => $data)
          <tr>
            <td>{{ ($nomor+1) }}</td>
            <td>{{ $data['nomorsm'] }}</td>
            <td>{{ $data['bidang'] }}</td>
            <td>{{ TanggalIndo($data['tglsurat']) }}</td>
            <td>{{ $data['asalsurat'] }}</td>
            <td>{{ $data['judulsurat'] }}</td>
          </tr>
        @endforeach
      </table>
</body>
</html>
