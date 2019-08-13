@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Beranda')
@section('sidebar_title', 'Beranda')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', '')

@section('content')
  <h1>Selamat Datang!</h1>
  <div class="row">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
    <div class="icon"><i class="fa fa-caret-square-o-right"></i>
    </div>
    <div class="count">{{ $belum }}</div>
    <h3>Surat Masuk</h3>
    <p>Belum Di Disposisi</p>
    </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
    <div class="icon"><i class="fa fa-comments-o"></i>
    </div>
    <div class="count">{{ $acc }}</div>
    <h3>Surat Masuk</h3>
    <p>Diacc</p>
    </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
    <div class="icon"><i class="fa fa-sort-amount-desc"></i>
    </div>
    <div class="count">{{ $ditolak }}</div>
    <h3>Surat Masuk</h3>
    <p>Ditolak</p>
    </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
    <div class="icon"><i class="fa fa-check-square-o"></i>
    </div>
    <div class="count">{{ $keluar }}</div>
    <h3>Surat Keluar</h3>
    <p>Diterbikan</p>
    </div>
    </div>
    </div>
@endsection
