<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url("public/css/struk.css")}}">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class="col-xs-12">
        <h3 align="center">Surat Ijin Keluar Pondok</h3>
        <hr>
        <h4>Data Santri</h4>
        <p>Nama Lengkap : {{$ijin->santri->nama_lengkap}}</p>
        <p>Kamar : {{getkamar($ijin->id_santri)->kamar->nama_kamar}}</p>
        <p>Kelas : {{getkelas($ijin->id_santri)->kelas->nama_kelas}}</p>
        <h4>Data Perijinan</h4>
        <p>Tujuan ijin : {{$ijin->tujuan_ijin}}</p>
        <p>Waktu Ijin : {{date("d-m-Y H:i:s",strtotime($ijin->waktu_start))}} - {{date("d-m-Y H:i:s",strtotime($ijin->waktu_end))}}</p>
        @if($ijin->waktu_keluar != null)
        <p>Waktu Keluar Pondok : {{date("d-m-Y H:i:s",strtotime($ijin->waktu_keluar))}}</p>
        @endif
        @if($ijin->waktu_kembali != null)
        <p>Waktu Kembali Pondok : {{date("d-m-Y H:i:s",strtotime($ijin->waktu_kembali))}}</p>
        @endif
        <hr>
      </div>
      <div class="col-xs-6 col-xs-offset-3">
          {!!str_replace('<?xml version="1.0" encoding="UTF-8"?>',"",QrCode::size(250)->generate($ijin->id_ijin))!!}
          <p align="center">{{$ijin->id_ijin}}</p>
      </div>
    </div>
  </body>
</html>
