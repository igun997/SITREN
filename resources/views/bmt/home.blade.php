@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>Dashboard [{{auth()->user()->name}}]</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Data Nasabah</span>
          <span class="info-box-number">{{\Sitren\SantriModel::all()->count()}}</span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Uang Keluar</span>
          <span class="info-box-number">{{number_format(\Sitren\TransaksiModel::where(["jenis"=>"keluar"])->sum('jumlah'))}}</span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Uang Masuk</span>
          <span class="info-box-number">{{number_format(\Sitren\TransaksiModel::where(["jenis"=>"masuk"])->sum('jumlah'))}}</span>
        </div>
      </div>
    </div>
</div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="box">
        <div class="box-header">
          <div class="box-title">
            Alat Administrasi
          </div>
        </div>
        <div class="box-body">
          <div class="col-md-6 col-md-offset-3">
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $key => $value)
                <p>{{$value}}</p>
                @endforeach
            </div>
            @endif
            @if(\Session::has("msg"))
            <div class="alert alert-success">{{session("msg")}}</div>
            @endif
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <a href="{{url("bmt/trigger")}}" class="btn btn-block btn-primary">Eksekusi Biaya Administrasi</a>
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
