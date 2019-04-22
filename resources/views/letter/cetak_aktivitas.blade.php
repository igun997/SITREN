<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk</title>
    @include("letter.style")

  </head>
  <body>
    <h3 align="center">Laporan Aktivitas Rekening </h3>
    <h3 align="center">Periode [{{date("d-m-Y",strtotime($req->input("start")))}} - {{date("d-m-Y",strtotime($req->input("end")))}}]</h3>
      <table >
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Transaksi</th>
              <th>Nasabah</th>
              <th>Jenis</th>
              <th>Jumlah</th>
              <th>Keterangan</th>
              <th>Operator</th>
              <th>Dibuat</th>
              <th>Diubah</th>
            </tr>
          </thead>
          <tbody>
            @foreach((\Sitren\TransaksiModel::orderBy("created_at","desc")->whereBetween("created_at",[$req->input("start"),$req->input("end")]))->get() as $ks => $vs)
            <tr>
              <td>{{$ks+1}}</td>
              <td>{{$vs->id_transaksi}}</td>
              <td>{{$vs->santri->nama_lengkap}}</td>
              @if($vs->jenis == "masuk")
              <td style="color:green">Dana Masuk</td>
              @elseif($vs->jenis == "keluar")
              <td style="color:red">Dana Keluar</td>
              @elseif($vs->jenis == "biaya_admin")
              <td style="color:red">Biaya Admin</td>
              @elseif($vs->jenis == "biaya_transfer")
              <td style="color:red">Biaya Transfer</td>
              @endif
              <td>{{number_format($vs->jumlah)}}</td>
              <td>{{$vs->keterangan}}</td>
              <td>{{$vs->pengurus->pegawai->nama_pegawai}}</td>
              <td>{{date("d-m-Y H:i:s",strtotime($vs->created_at))}}</td>
              <td>{{date("d-m-Y H:i:s",strtotime($vs->updated_at))}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
  </body>
</html>
