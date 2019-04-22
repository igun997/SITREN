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
    <h3 align="center">Laporan Rekening Per Nasabah </h3>
    <h3 align="center">Periode [{{date("d-m-Y",strtotime($req->input("start")))}} - {{date("d-m-Y",strtotime($req->input("end")))}}]</h3>
      @foreach($row as $k => $v)
      <h4>Kode Nasabah [{{$v->id_santri}}]</h4>
      <p>Nama Lengkap : {{$v->santri->nama_lengkap}}</p>
      <p>Kamar : {{getkamar($v->id_santri)->kamar->nama_kamar}}</p>
      <p>Kelas : {{getkelas($v->id_santri)->kelas->nama_kelas}}</p>
      <p>Alamat : {{$v->alamat_lengkap_ayah}}</p>
      <p>Total Simpanan : Rp.{{number_format((\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"masuk"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"keluar"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"biaya_admin"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"biaya_transfer"])->sum("jumlah")))}}</p>
      <table >
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Transaksi</th>
              <th>Jenis</th>
              <th>Jumlah</th>
              <th>Keterangan</th>
              <th>Operator</th>
              <th>Dibuat</th>
              <th>Diubah</th>
            </tr>
          </thead>
          <tbody>
            @foreach((\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri])->whereBetween("created_at",[$req->input("start"),$req->input("end")]))->get() as $ks => $vs)
            <tr>
              <td>{{$ks+1}}</td>
              <td>{{$vs->id_transaksi}}</td>
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
        @endforeach
  </body>
</html>
