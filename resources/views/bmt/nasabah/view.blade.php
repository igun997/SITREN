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
        <div class="pull-right">
            <a href="{{url('bmt/nasabah/print/'.$data->id_santri)}}" class="btn btn-success">
              <i class="fa fa-print"></i>
            </a>
        </div>
      </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Kode Transaksi</label>
            <input type="text" disabled class="form-control" value="{{$data->id_transaksi}}">
          </div>
          <div class="form-group">
            <label>Nama Nasabah</label>
            <input type="text" disabled class="form-control" value="{{$data->santri->nama_lengkap}}">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" disabled rows="8" cols="80">{{$data->keterangan}}</textarea>
          </div>
          <div class="form-group">
            <label>Kamar / Kelas</label>
            <input type="text" disabled class="form-control" value="{{\Sitren\AssignKamar::where(["id_santri"=>$data->id_santri])->first()->kamar->nama_kamar}} / {{\Sitren\AssignKelas::where(["id_santri"=>$data->id_santri])->first()->kelas->nama_kelas}}">
          </div>
          <div class="form-group">
            <label>Sisa Simpanan</label>
            <input type="text" disabled class="form-control" value="Rp.{{number_format((\Sitren\TransaksiModel::where(["id_santri"=>$data->id_santri,"jenis"=>"masuk"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$data->id_santri,"jenis"=>"keluar"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$data->id_santri,"jenis"=>"biaya_admin"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$data->id_santri,"jenis"=>"biaya_transfer"])->sum("jumlah")))}}">
          </div>
        </div>
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table" id="main">
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
                @foreach($loop as $k => $v)
                <tr>
                  <td>{{$k+1}}</td>
                  <td>{{$v->id_transaksi}}</td>
                  @if($v->jenis == "masuk")
                  <td class="bg-green">Dana Masuk</td>
                  @elseif($v->jenis == "keluar")
                  <td class="bg-red">Dana Keluar</td>
                  @elseif($v->jenis == "biaya_admin")
                  <td class="bg-red">Biaya Admin</td>
                  @elseif($v->jenis == "biaya_transfer")
                  <td class="bg-red">Biaya Transfer</td>
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
          </div>
        </div>
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
