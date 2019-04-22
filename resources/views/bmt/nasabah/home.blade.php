@extends('adminlte::page')

@section('title', $title)

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="box-title">
          {{$title}}
        </div>
      </div>
      <div class="box-body">
        <table class="table" id="main">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Nasabah</th>
              <th>Kelas</th>
              <th>Kamar</th>
              <th>Jumlah Sisa Tabungan</th>
              <th>Jumlah Tabungan Masuk</th>
              <th>Jumlah Tabungan Keluar</th>
              <th>Dibuat</th>
              <th>Diubah</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $k => $v)
            <tr>
              <td>{{$k+1}}</td>
              <td>{{$v->santri->nama_lengkap}}</td>
              <td>{{\Sitren\AssignKelas::where(["id_santri"=>$v->id_santri])->first()->kelas->nama_kelas}}</td>
              <td>{{\Sitren\AssignKamar::where(["id_santri"=>$v->id_santri])->first()->kamar->nama_kamar}}</td>
              <td>Rp.{{number_format((\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"masuk"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"keluar"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"biaya_admin"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"biaya_transfer"])->sum("jumlah")))}}</td>
              <td>Rp.{{number_format((\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"masuk"])->sum("jumlah")))}}</td>
              <td>Rp.{{number_format((\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"keluar"])->sum("jumlah"))+(\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"biaya_admin"])->sum("jumlah"))+(\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"biaya_transfer"])->sum("jumlah")))}}</td>
              <td>{{date("d-m-Y H:i:s",strtotime($v->created_at))}}</td>
              <td>{{date("d-m-Y H:i:s",strtotime($v->updated_at))}}</td>
              <td>
                <a href="{{url("bmt/nasabah/view/".$v->id_santri)}}" class="btn btn-success"><i class="fa fa-search"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $("#main").DataTable({

    });
  });
</script>
@stop
