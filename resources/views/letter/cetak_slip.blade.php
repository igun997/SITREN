<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    @include("letter.style")
    <style type="text/css">
    </style>
  </head>
  <body>
    <h3 align="center">Slip Transaksi</h3>
    <hr>
    <p><b>Kode Transaksi : </b>{{$data->id_transaksi}}</p>
    @if($data->jenis == "masuk")
    <p><b>Jenis Transaksi : </b>Dana Masuk</p>
    @elseif($data->jenis == "keluar")
    <p><b>Jenis Transaksi : </b>Dana Keluar</p>
    @elseif($data->jenis == "biaya_admin")
    <p><b>Jenis Transaksi : </b>Biaya Admin</p>
    @elseif($data->jenis == "biaya_transfer")
    <p><b>Jenis Transaksi : </b>Biaya Transfer</p>
    @endif
    <p><b>Jumlah : </b>Rp. {{number_format($data->jumlah)}}</p>
    <p><b>Keterangan : </b>{{$data->keterangan}}</p>
    <hr>

      <p align="center">Petugas</p>
      <br>
      <br>
      <br>
      <p align="center">{{$data->pengurus->pegawai->nama_pegawai}}</p>

  </body>
</html>
