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
      <h3 align="center">Data Tabungan Santri</h3>
      <hr>
      <h4>Data Santri</h4>
      <p>Nama Lengkap : {{$row->santri->nama_lengkap}}</p>
      <p>Kamar : {{getkamar($row->id_santri)->kamar->nama_kamar}}</p>
      <p>Kelas : {{getkelas($row->id_santri)->kelas->nama_kelas}}</p>
      <p>Alamat : {{$row->alamat_lengkap_ayah}}</p>
      <p>Total Simpanan : Rp.{{number_format((\Sitren\TransaksiModel::where(["id_santri"=>$row->id_santri,"jenis"=>"masuk"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$row->id_santri,"jenis"=>"keluar"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$row->id_santri,"jenis"=>"biaya_admin"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$row->id_santri,"jenis"=>"biaya_transfer"])->sum("jumlah")))}}</p>
      <hr>
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
            @foreach($list as $k => $v)
            <tr>
              <td>{{$k+1}}</td>
              <td>{{$v->id_transaksi}}</td>
              @if($v->jenis == "masuk")
              <td style="color:green">Dana Masuk</td>
              @elseif($v->jenis == "keluar")
              <td style="color:red">Dana Keluar</td>
              @elseif($v->jenis == "biaya_admin")
              <td style="color:red">Biaya Admin</td>
              @elseif($v->jenis == "biaya_transfer")
              <td style="color:red">Biaya Transfer</td>
              @endif
              <td>{{number_format($v->jumlah)}}</td>
              <td>{{$v->keterangan}}</td>
              <td>{{$v->pengurus->pegawai->nama_pegawai}}</td>
              <td>{{date("d-m-Y H:i:s",strtotime($v->created_at))}}</td>
              <td>{{date("d-m-Y H:i:s",strtotime($v->updated_at))}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
  </body>
</html>
