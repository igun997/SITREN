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
            <a href="{{url('bmt/transaksi/setor')}}" class="btn btn-success">
              <i class="fa fa-plus"></i>
            </a>
            <a href="{{url('bmt/transaksi/tarik')}}" class="btn btn-danger">
              <i class="fa fa-minus"></i>
            </a>
        </div>
      </div>
      <div class="box-body">
        <table class="table" id="main">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Transaksi</th>
              <th>Nama Nasabah</th>
              <th>Jenis</th>
              <th>Jumlah</th>
              <th>Keterangan</th>
              <th>Operator</th>
              <th>Dibuat</th>
              <th>Diubah</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $k => $v)
            <tr>
              <td>{{$k+1}}</td>
              <td>{{$v->id_transaksi}}</td>
              <td>{{$v->santri->nama_lengkap}}</td>
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
              <td>
                <a href="{{url("bmt/transaksi/cetak/".$v->id_transaksi)}}" class="btn btn-success"><i class="fa fa-print"></i></a>
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
